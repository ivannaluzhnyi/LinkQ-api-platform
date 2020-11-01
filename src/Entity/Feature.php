<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\FeatureRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ApiResource()
 * @ORM\Entity(repositoryClass=FeatureRepository::class)
 */
class Feature
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private ?int $id;

    /**
     * @ORM\Column(type="integer")
     */
    private ?int $size;

    /**
     * @ORM\Column(type="integer")
     */
    private ?int $rooms;

    /**
     * @ORM\Column(type="integer")
     */
    private ?int $bedrooms;

    /**
     * @ORM\Column(type="integer")
     */
    private ?int $bathrooms;

    /**
     * @ORM\Column(type="integer")
     */
    private ?int $garages;

    /**
     * @ORM\OneToOne(targetEntity=Property::class, mappedBy="features", cascade={"persist", "remove"})
     */
    private ?Property $property;

    /**
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return int|null
     */
    public function getSize(): ?int
    {
        return $this->size;
    }

    /**
     * @param int $size
     * @return $this
     */
    public function setSize(int $size): self
    {
        $this->size = $size;

        return $this;
    }

    /**
     * @return int|null
     */
    public function getRooms(): ?int
    {
        return $this->rooms;
    }

    /**
     * @param int $rooms
     * @return $this
     */
    public function setRooms(int $rooms): self
    {
        $this->rooms = $rooms;

        return $this;
    }

    /**
     * @return int|null
     */
    public function getBedrooms(): ?int
    {
        return $this->bedrooms;
    }

    /**
     * @param int $bedrooms
     * @return $this
     */
    public function setBedrooms(int $bedrooms): self
    {
        $this->bedrooms = $bedrooms;

        return $this;
    }

    /**
     * @return int|null
     */
    public function getBathrooms(): ?int
    {
        return $this->bathrooms;
    }

    /**
     * @param int $bathrooms
     * @return $this
     */
    public function setBathrooms(int $bathrooms): self
    {
        $this->bathrooms = $bathrooms;

        return $this;
    }

    /**
     * @return int|null
     */
    public function getGarages(): ?int
    {
        return $this->garages;
    }

    /**
     * @param int $garages
     * @return $this
     */
    public function setGarages(int $garages): self
    {
        $this->garages = $garages;

        return $this;
    }

    /**
     * @return Property|null
     */
    public function getProperty(): ?Property
    {
        return $this->property;
    }

    /**
     * @param Property $property
     * @return $this
     */
    public function setProperty(Property $property): self
    {
        $this->property = $property;

        // set the owning side of the relation if necessary
        if ($property->getFeatures() !== $this) {
            $property->setFeatures($this);
        }

        return $this;
    }
}
