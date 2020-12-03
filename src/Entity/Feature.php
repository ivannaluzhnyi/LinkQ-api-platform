<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\FeatureRepository;
use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Core\Annotation\ApiFilter;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\SearchFilter;
use Symfony\Component\Serializer\Annotation\Groups;
use ApiPlatform\Core\Serializer\Filter\GroupFilter;

/**
 * @ApiResource()
 * @ApiFilter(
 *     SearchFilter::class,
 *     properties={
 *      "size": "exact",
 *      "rooms": "exact",
 *      "bedrooms": "exact",
 *      "bathrooms": "exact",
 *      "garages": "exact"
 *     }
 * )
 * @ApiFilter(
 *     GroupFilter::class,
 *     arguments={
 *      "parameterName": "groups",
 *      "overrideDefaultGroups": false,
 *      "whitelist": NULL
 *     }
 * )
 * @ORM\Entity(repositoryClass=FeatureRepository::class)
 */
class Feature
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @Groups({"property_get_full", "feature_get_full", "address_get_full", "feature_get", "user_get_full"})
     */
    private ?int $id;

    /**
     * @ORM\Column(type="integer")
     * @Groups({"property_get_full", "feature_get_full", "address_get_full", "feature_get", "user_get_full"})
     */
    private ?int $size;

    /**
     * @ORM\Column(type="integer")
     * @Groups({"property_get_full", "feature_get_full", "address_get_full", "feature_get", "user_get_full"})
     */
    private ?int $rooms;

    /**
     * @ORM\Column(type="integer")
     * @Groups({"property_get_full", "feature_get_full", "address_get_full", "feature_get", "user_get_full"})
     */
    private ?int $bedrooms;

    /**
     * @ORM\Column(type="integer")
     * @Groups({"property_get_full", "feature_get_full", "address_get_full", "feature_get", "user_get_full"})
     */
    private ?int $bathrooms;

    /**
     * @ORM\Column(type="integer")
     * @Groups({"property_get_full", "feature_get_full", "address_get_full", "feature_get", "user_get_full"})
     */
    private ?int $garages;

    /**
     * @ORM\OneToOne(targetEntity=Property::class, mappedBy="features", cascade={"persist", "remove"})
     * @Groups({"feature_get_full", "feature_get"})
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
     * @param int|null $size
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
     * @param int|null $rooms
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
     * @param int|null $bedrooms
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
     * @param int|null $bathrooms
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
     * @param int|null $garages
     * @return $this
     */
    public function setGarages(int $garages): self
    {
        $this->garages = $garages;

        return $this;
    }

    /**
     * @return Property
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
