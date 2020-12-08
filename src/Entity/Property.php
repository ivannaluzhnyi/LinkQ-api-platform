<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\PropertyRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Core\Annotation\ApiFilter;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\SearchFilter;
use Symfony\Component\Serializer\Annotation\Groups;
use ApiPlatform\Core\Serializer\Filter\GroupFilter;

/**
 * @ApiResource(
 *     normalizationContext={"groups"={"property_get"}},
 * )
 * @ApiFilter(SearchFilter::class, properties={"title": "partial"})
 * @ApiFilter(
 *     GroupFilter::class,
 *     arguments={
 *      "parameterName": "groups",
 *      "overrideDefaultGroups": true,
 *      "whitelist": NULL
 *     }
 * )
 * @ORM\Entity(repositoryClass=PropertyRepository::class)
 */
class Property
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @Groups({"user_get_full", "property_get", "property_get_full", "address_get_full"})
     */
    private int $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"user_get_full", "property_get", "property_get_full", "address_get_full"})
     */
    private string $title;

    /**
     * @ORM\Column(type="text")
     * @Groups({"user_get_full", "property_get", "property_get_full", "address_get_full"})
     */
    private string $description;

    /**
     * @ORM\OneToOne(targetEntity=Address::class, inversedBy="property", cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=false)
     * @Groups({"user_get_full", "property_get", "property_get_full", "feature_get_full"})
     */
    private Address $address;

    /**
     * @ORM\OneToOne(targetEntity=Feature::class, inversedBy="property", cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=false)
     * @Groups({"property_get", "property_get_full", "address_get_full", "user_get_full"})
     */
    private Feature $features;

    /**
     * @ORM\OneToMany(targetEntity=Media::class, mappedBy="property")
     * @Groups({"property_get", "property_get_full", "address_get_full"})
     */
    private Collection $medium;

    /**
     * @ORM\OneToMany(targetEntity=Application::class,
     *     mappedBy="property",
     *     orphanRemoval=true,
     *     cascade={"persist", "remove"}
     * )
     */
    private Collection $applications;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="property")
     * @Groups({"property_get", "property_get_full", "feature_get_full"})
     */
    private ?User $userRelated;

    /**
     * Property constructor.
     */
    public function __construct()
    {
        $this->medium = new ArrayCollection();
        $this->applications = new ArrayCollection();
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * @param string $title
     * @return $this
     */
    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    /**
     * @return string
     */
    public function getDescription(): string
    {
        return $this->description;
    }

    /**
     * @param string $description
     * @return $this
     */
    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    /**
     * @return Address
     */
    public function getAddress(): Address
    {
        return $this->address;
    }

    /**
     * @param Address $address
     * @return $this
     */
    public function setAddress(Address $address): self
    {
        $this->address = $address;

        return $this;
    }

    /**
     * @return Feature
     */
    public function getFeatures(): Feature
    {
        return $this->features;
    }

    /**
     * @param Feature $features
     * @return $this
     */
    public function setFeatures(Feature $features): self
    {
        $this->features = $features;

        return $this;
    }

    /**
     * @return Collection|Media[]
     */
    public function getMedium(): Collection
    {
        return $this->medium;
    }

    /**
     * @param Media $medium
     * @return $this
     */
    public function addMedium(Media $medium): self
    {
        if (!$this->medium->contains($medium)) {
            $this->medium[] = $medium;
            $medium->setProperty($this);
        }

        return $this;
    }

    /**
     * @param Media $medium
     * @return $this
     */
    public function removeMedium(Media $medium): self
    {
        if ($this->medium->contains($medium)) {
            $this->medium->removeElement($medium);
            // set the owning side to null (unless already changed)
            if ($medium->getProperty() === $this) {
                $medium->setProperty(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Application[]
     */
    public function getApplications(): Collection
    {
        return $this->applications;
    }

    /**
     * @param Application $application
     * @return $this
     */
    public function addApplication(Application $application): self
    {
        if (!$this->applications->contains($application)) {
            $this->applications[] = $application;
            $application->setProperty($this);
        }

        return $this;
    }

    /**
     * @param Application $application
     * @return $this
     */
    public function removeApplication(Application $application): self
    {
        if ($this->applications->contains($application)) {
            $this->applications->removeElement($application);
            // set the owning side to null (unless already changed)
            if ($application->getProperty() === $this) {
                $application->setProperty(null);
            }
        }

        return $this;
    }

    /**
     * @return ?User
     */
    public function getUserRelated(): ?User
    {
        return $this->userRelated;
    }

    /**
     * @param User|null $userRelated
     * @return $this
     */
    public function setUserRelated(?User $userRelated): self
    {
        $this->userRelated = $userRelated;

        return $this;
    }
}
