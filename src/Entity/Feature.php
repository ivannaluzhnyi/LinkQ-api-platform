<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\FeatureRepository;
use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Core\Annotation\ApiFilter;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\RangeFilter;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\SearchFilter;
use Symfony\Component\Serializer\Annotation\Groups;
use ApiPlatform\Core\Serializer\Filter\GroupFilter;

/**
 *  @ApiResource(
 *     collectionOperations={
 *          "get"={"normalization_context"={"groups"={"feature_get_full"}}},
 *          "post"={"normalization_context"={"groups"={"feature_get"}}},
 *     },
 *     itemOperations={
 *          "get"={"normalization_context"={"groups"={"feature_get"}}},
 *          "patch"={"normalization_context"={"groups"={"feature_get"}}},
 *          "put"={"normalization_context"={"groups"={"feature_get"}}},
 *          "delete"={"normalization_context"={"groups"={"feature_get"}}},
 *     }
 * )
 * @ApiFilter(RangeFilter::class, properties={"rooms","size","bedrooms","bathrooms","garages"})
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
 *      "overrideDefaultGroups": true,
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
    private int $id;

    /**
     * @ORM\Column(type="integer")
     * @Groups({"property_get_full", "feature_get_full", "address_get_full", "feature_get", "user_get_full"})
     */
    private int $size;

    /**
     * @ORM\Column(type="integer")
     * @Groups({"property_get_full", "feature_get_full", "address_get_full", "feature_get", "user_get_full"})
     */
    private int $rooms;

    /**
     * @ORM\Column(type="integer")
     * @Groups({"property_get_full", "feature_get_full", "address_get_full", "feature_get", "user_get_full"})
     */
    private int $bedrooms;

    /**
     * @ORM\Column(type="integer")
     * @Groups({"property_get_full", "feature_get_full", "address_get_full", "feature_get", "user_get_full"})
     */
    private int $bathrooms;

    /**
     * @ORM\Column(type="integer")
     * @Groups({"property_get_full", "feature_get_full", "address_get_full", "feature_get", "user_get_full"})
     */
    private int $garages;

    /**
     * @ORM\OneToOne(targetEntity=Property::class, mappedBy="features", cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=true)
     * @Groups({"feature_get_full", "feature_get"})
     */
    private Property $property;

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return int
     */
    public function getSize(): int
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
     * @return int
     */
    public function getRooms(): int
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
     * @return int
     */
    public function getBedrooms(): int
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
     * @return int
     */
    public function getBathrooms(): int
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
     * @return int
     */
    public function getGarages(): int
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
     * @return Property
     */
    public function getProperty(): Property
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
