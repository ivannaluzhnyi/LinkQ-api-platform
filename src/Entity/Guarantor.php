<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\GuarantorRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ApiResource()
 * @ORM\Entity(repositoryClass=GuarantorRepository::class)
 */
class Guarantor
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $FirstName;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $LastName;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $Relation;

    /**
     * @ORM\Column(type="float")
     */
    private $Salary;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="guarantor")
     * @ORM\JoinColumn(nullable=false)
     */
    private $UserRelated;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFirstName(): ?string
    {
        return $this->FirstName;
    }

    public function setFirstName(string $FirstName): self
    {
        $this->FirstName = $FirstName;

        return $this;
    }

    public function getLastName(): ?string
    {
        return $this->LastName;
    }

    public function setLastName(string $LastName): self
    {
        $this->LastName = $LastName;

        return $this;
    }

    public function getRelation(): ?string
    {
        return $this->Relation;
    }

    public function setRelation(string $Relation): self
    {
        $this->Relation = $Relation;

        return $this;
    }

    public function getSalary(): ?float
    {
        return $this->Salary;
    }

    public function setSalary(float $Salary): self
    {
        $this->Salary = $Salary;

        return $this;
    }

    public function getUserRelated(): ?User
    {
        return $this->UserRelated;
    }

    public function setUserRelated(?User $UserRelated): self
    {
        $this->UserRelated = $UserRelated;

        return $this;
    }
}
