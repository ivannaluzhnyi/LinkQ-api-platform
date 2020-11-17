<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Entity\Traits\Timestampable;
use App\Repository\UserRepository;
use DateTimeInterface;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;
use Gedmo\Mapping\Annotation as Gedmo;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ApiResource(attributes={
 *     "normalization_context"={"groups"={"read"}}
 * })
 * @ORM\Entity(repositoryClass=UserRepository::class)
 * @ORM\Table(name="account")
 */
class User implements UserInterface
{
    use Timestampable;

    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @Groups({"read"})
     */
    private ?int $id;

    /**
     * @ORM\Column(type="boolean")
     * @Groups({"read"})
     */
    private bool $is_active;

    /**
     * @ORM\Column(type="string", length=180, unique=true)
     * @Groups({"read"})
     */
    private ?string $email;

    /**
     * @ORM\Column(type="json")
     */
    private array $roles = [];

    /**
     * @var string The hashed password
     * @ORM\Column(type="string")
     */
    private string $password;

    /**
     * @var string
     */
    private string $plainPassword;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Groups({"read"})
     */
    private ?string $firstname;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Groups({"read"})
     */
    private ?string $lastname;

    /**
     * @ORM\Column(type="date", nullable=true)
     * @Groups({"read"})
     */
    private ?DateTimeInterface $birthdate;

    /**
     * @ORM\OneToMany(targetEntity=Application::class, mappedBy="buyer", orphanRemoval=true)
     * @Groups({"read"})
     */
    private $applications;

    /**
     * @ORM\Column(type="float", nullable=true)
     * @Groups({"read"})
     */
    private $salary;

    /**
     * @ORM\OneToMany(targetEntity=Guarantor::class, mappedBy="UserRelated", orphanRemoval=true)
     * @Groups({"read"})
     */
    private $guarantor;

    /**
     * @ORM\OneToMany(targetEntity=Property::class, mappedBy="UserRelated")
     * @Groups({"read"})
     */
    private $property;

    public function __construct()
    {
        $this->applications = new ArrayCollection();
        $this->guarantor = new ArrayCollection();
        $this->property = new ArrayCollection();
    }

    /**
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return string|null
     */
    public function getEmail(): ?string
    {
        return $this->email;
    }

    /**
     * @param string $email
     * @return $this
     */
    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUsername(): string
    {
        return (string) $this->email;
    }

    /**
     * @see UserInterface
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    /**
     * @param array $roles
     * @return $this
     */
    public function setRoles(array $roles): self
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function getPassword(): string
    {
        return (string) $this->password;
    }

    /**
     * @param string $password
     * @return $this
     */
    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function getSalt()
    {
        // not needed when using the "bcrypt" algorithm in security.yaml
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials()
    {
        // If you store any temporary, sensitive data on the user, clear it here
    }

    /**
     * @return string
     */
    public function getPlainPassword(): string
    {
        return $this->plainPassword;
    }

    /**
     * @param string $plainPassword
     */
    public function setPlainPassword(string $plainPassword): void
    {
        $this->plainPassword = $plainPassword;
    }

    /**
     * @return string|null
     */
    public function getFirstname(): ?string
    {
        return $this->firstname;
    }

    /**
     * @param string|null $firstname
     * @return $this
     */
    public function setFirstname(?string $firstname): self
    {
        $this->firstname = $firstname;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getLastname(): ?string
    {
        return $this->lastname;
    }

    /**
     * @param string|null $lastname
     * @return $this
     */
    public function setLastname(?string $lastname): self
    {
        $this->lastname = $lastname;

        return $this;
    }

    /**
     * @return DateTimeInterface|null
     */
    public function getBirthdate(): ?DateTimeInterface
    {
        return $this->birthdate;
    }

    /**
     * @param DateTimeInterface|null $birthdate
     * @return $this
     */
    public function setBirthdate(?DateTimeInterface $birthdate): self
    {
        $this->birthdate = $birthdate;

        return $this;
    }

    /**
     * @return bool|null
     */
    public function getIsActive(): ?bool
    {
        return $this->is_active;
    }

    /**
     * @param bool $is_active
     * @return $this
     */
    public function setIsActive(bool $is_active): self
    {
        $this->is_active = $is_active;

        return $this;
    }

    /**
     * @return Collection|Application[]
     */
    public function getApplications(): Collection
    {
        return $this->applications;
    }

    public function addApplication(Application $application): self
    {
        if (!$this->applications->contains($application)) {
            $this->applications[] = $application;
            $application->setBuyer($this);
        }

        return $this;
    }

    public function removeApplication(Application $application): self
    {
        if ($this->applications->contains($application)) {
            $this->applications->removeElement($application);
            // set the owning side to null (unless already changed)
            if ($application->getBuyer() === $this) {
                $application->setBuyer(null);
            }
        }

        return $this;
    }

    public function getSalary(): ?float
    {
        return $this->salary;
    }

    public function setSalary(?float $salary): self
    {
        $this->salary = $salary;

        return $this;
    }

    /**
     * @return Collection|Guarantor[]
     */
    public function getGuarantor(): Collection
    {
        return $this->guarantor;
    }

    public function addGuarantor(Guarantor $guarantor): self
    {
        if (!$this->guarantor->contains($guarantor)) {
            $this->guarantor[] = $guarantor;
            $guarantor->setUserRelated($this);
        }

        return $this;
    }

    public function removeGuarantor(Guarantor $guarantor): self
    {
        if ($this->guarantor->contains($guarantor)) {
            $this->guarantor->removeElement($guarantor);
            // set the owning side to null (unless already changed)
            if ($guarantor->getUserRelated() === $this) {
                $guarantor->setUserRelated(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Property[]
     */
    public function getProperty(): Collection
    {
        return $this->property;
    }

    public function addProperty(Property $property): self
    {
        if (!$this->property->contains($property)) {
            $this->property[] = $property;
            $property->setUserRelated($this);
        }

        return $this;
    }

    public function removeProperty(Property $property): self
    {
        if ($this->property->contains($property)) {
            $this->property->removeElement($property);
            // set the owning side to null (unless already changed)
            if ($property->getUserRelated() === $this) {
                $property->setUserRelated(null);
            }
        }

        return $this;
    }
}
