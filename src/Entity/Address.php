<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\AddressRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ApiResource()
 * @ORM\Entity(repositoryClass=AddressRepository::class)
 */
class Address
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
    private ?string $street;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private ?string $zipcode;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private ?string $city;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private ?string $country;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private ?int $floor;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private ?int $room;

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
    public function getStreet(): ?string
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
     * @return string|null
     */
    public function getZipcode(): ?string
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
     * @return string|null
     */
    public function getCity(): ?string
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
     * @return string|null
     */
    public function getCountry(): ?string
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
}
