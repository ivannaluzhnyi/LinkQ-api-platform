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
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="applications")
     * @ORM\JoinColumn(nullable=false)
     */
    private $buyer;

    /**
     * @ORM\ManyToOne(targetEntity=Property::class, inversedBy="applications")
     * @ORM\JoinColumn(nullable=false)
     */
    private $Property;

    /**
     * @ORM\Column(type="float")
     */
    private $offer;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getBuyer(): ?User
    {
        return $this->buyer;
    }

    public function setBuyer(?User $buyer): self
    {
        $this->buyer = $buyer;

        return $this;
    }

    public function getProperty(): ?Property
    {
        return $this->Property;
    }

    public function setProperty(?Property $Property): self
    {
        $this->Property = $Property;

        return $this;
    }

    public function getOffer(): ?float
    {
        return $this->offer;
    }

    public function setOffer(float $offer): self
    {
        $this->offer = $offer;

        return $this;
    }
}
