<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\AddressRepository;
use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Core\Annotation\ApiFilter;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\SearchFilter;
use Symfony\Component\Serializer\Annotation\Groups;
use ApiPlatform\Core\Serializer\Filter\GroupFilter;

/**
 * @ApiResource(
 *     normalizationContext={"groups"={"address_get"}},
 * )
 * @ApiFilter(
 *     SearchFilter::class,
 *     properties={
 *      "zipcode": "exact",
 *      "city": "exact",
 *      "country": "exact",
 *      "street": "partial"
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
 * @ORM\Entity(repositoryClass=AddressRepository::class)
 */
class Address
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @Groups({"user_get_full", "property_get_full", "address_get", "address_get_full", "feature_get_full"})
     */
    private int $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"user_get_full", "property_get_full", "address_get", "address_get_full", "feature_get_full"})
     */
    private string $street;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"user_get_full", "property_get_full", "address_get", "address_get_full", "feature_get_full"})
     */
    private string $zipcode;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"user_get_full", "property_get_full", "address_get", "address_get_full", "feature_get_full"})
     */
    private string $city;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"user_get_full", "property_get_full", "address_get", "address_get_full", "feature_get_full"})
     */
    private string $country;

    /**
     * @ORM\Column(type="integer", nullable=true)
     * @Groups({"user_get_full", "property_get_full", "address_get", "address_get_full", "feature_get_full"})
     */
    private ?int $floor;

    /**
     * @ORM\Column(type="integer", nullable=true)
     * @Groups({"user_get_full", "property_get_full", "address_get", "address_get_full", "feature_get_full"})
     */
    private ?int $room;

    /**
     * @ORM\OneToOne(targetEntity=Property::class, mappedBy="address", cascade={"persist", "remove"})
     * @Groups({"address_get_full", "address_get"})
     * @ORM\JoinColumn(nullable=false)
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
     * @return string
     */
    public function getStreet(): string
    {
        return $this->street;
    }

    /**
     * @param string $street
     * @return $this
     */
    public function setStreet(string $street): self
    {
        $this->street = $street;

        return $this;
    }

    /**
     * @return string
     */
    public function getZipcode(): string
    {
        return $this->zipcode;
    }

    /**
     * @param string $zipcode
     * @return $this
     */
    public function setZipcode(string $zipcode): self
    {
        $this->zipcode = $zipcode;

        return $this;
    }

    /**
     * @return string
     */
    public function getCity(): string
    {
        return $this->city;
    }

    /**
     * @param string $city
     * @return $this
     */
    public function setCity(string $city): self
    {
        $this->city = $city;

        return $this;
    }

    /**
     * @return string
     */
    public function getCountry(): string
    {
        return $this->country;
    }

    /**
     * @param string $country
     * @return $this
     */
    public function setCountry(string $country): self
    {
        $this->country = $country;

        return $this;
    }

    /**
     * @return int|null
     */
    public function getFloor(): ?int
    {
        return $this->floor;
    }

    /**
     * @param int|null $floor
     * @return $this
     */
    public function setFloor(?int $floor): self
    {
        $this->floor = $floor;

        return $this;
    }

    /**
     * @return int|null
     */
    public function getRoom(): ?int
    {
        return $this->room;
    }

    /**
     * @param int|null $room
     * @return $this
     */
    public function setRoom(?int $room): self
    {
        $this->room = $room;

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
