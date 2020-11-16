<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\PropertyRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ApiResource()
 * @ORM\Entity(repositoryClass=PropertyRepository::class)
 */
class Property
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private ?int $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private ?string $title;

    /**
     * @ORM\Column(type="text")
     */
    private ?string $description;

    /**
     * @ORM\OneToOne(targetEntity=Address::class, cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=false)
     */
    private ?Address $address;

    /**
     * @ORM\OneToOne(targetEntity=Feature::class, inversedBy="property", cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=false)
     */
    private ?Feature $features;

    /**
     * @ORM\OneToMany(targetEntity=Media::class, mappedBy="property")
     */
    private $medium;

    /**
     * Property constructor.
     */
    public function __construct()
    {
        $this->medium = new ArrayCollection();
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
    public function getTitle(): ?string
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
     * @return string|null
     */
    public function getDescription(): ?string
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
     * @return Address|null
     */
    public function getAddress(): ?Address
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
     * @return Feature|null
     */
    public function getFeatures(): ?Feature
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
}
