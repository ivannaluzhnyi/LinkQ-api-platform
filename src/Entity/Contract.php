<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\ContractRepository;
use Doctrine\ORM\Mapping as ORM;
use App\Entity\Traits\Timestampable;

/**
 * @ApiResource()
 * @ORM\Entity(repositoryClass=ContractRepository::class)
 */
class Contract
{
    use Timestampable;

    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private ?int $id;

    /**
     * @ORM\Column(type="float")
     */
    private ?float $price;

    /**
     * @ORM\OneToOne(targetEntity=Application::class, cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=false)
     */
    private ?Application $application;

    /**
     * @return int
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return float|null
     */
    public function getPrice(): ?float
    {
        return $this->price;
    }

    /**
     * @param float|null $price
     * @return $this
     */
    public function setPrice(float $price): self
    {
        $this->price = $price;

        return $this;
    }

    /**
     * @return Application
     */
    public function getApplication(): ?Application
    {
        return $this->application;
    }

    /**
     * @param Application $application
     * @return $this
     */
    public function setApplication(Application $application): self
    {
        $this->application = $application;

        return $this;
    }
}
