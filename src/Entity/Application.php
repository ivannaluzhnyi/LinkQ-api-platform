<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\ApplicationRepository;
use Doctrine\ORM\Mapping as ORM;
use App\Entity\Traits\Timestampable;

/**
 * @ApiResource()
 * @ORM\Entity(repositoryClass=ApplicationRepository::class)
 */
class Application
{
    use Timestampable;

    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private int $id;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="applications")
     * @ORM\JoinColumn(nullable=false)
     */
    private User $buyer;

    /**
     * @ORM\ManyToOne(targetEntity=Property::class, inversedBy="applications")
     * @ORM\JoinColumn(nullable=false)
     */
    private Property $property;

    /**
     * @ORM\Column(type="integer")
     */
    private int $offer;

    /**
     * @return int
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return User
     */
    public function getBuyer(): User
    {
        return $this->buyer;
    }

    /**
     * @param User $buyer
     * @return $this
     */
    public function setBuyer(User $buyer): self
    {
        $this->buyer = $buyer;

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

        return $this;
    }

    /**
     * @return int
     */
    public function getOffer(): int
    {
        return $this->offer;
    }

    /**
     * @param int $offer
     * @return $this
     */
    public function setOffer(int $offer): self
    {
        $this->offer = $offer;

        return $this;
    }
}
