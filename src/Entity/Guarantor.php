<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\GuarantorRepository;
use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Core\Annotation\ApiFilter;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\SearchFilter;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ApiResource()
 * @ApiFilter(SearchFilter::class, properties={"FirstName": "partial", "LastName": "partial"})
 * @ORM\Entity(repositoryClass=GuarantorRepository::class)
 */
class Guarantor
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @Groups({"user_get_full"})
     */
    private int $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"user_get_full"})
     */
    private string $firstName;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"user_get_full"})
     */
    private string $lastName;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"user_get_full"})
     */
    private string $relation;

    /**
     * @ORM\Column(type="integer")
     * @Groups({"user_get_full"})
     */
    private int $salary;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="guarantor")
     * @ORM\JoinColumn(nullable=false)
     */
    private User $userRelated;

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
    public function getFirstName(): string
    {
        return $this->firstName;
    }

    /**
     * @param string $firstName
     * @return $this
     */
    public function setFirstName(string $firstName): self
    {
        $this->firstName = $firstName;

        return $this;
    }

    /**
     * @return string
     */
    public function getLastName(): string
    {
        return $this->lastName;
    }

    /**
     * @param string $lastName
     * @return $this
     */
    public function setLastName(string $lastName): self
    {
        $this->lastName = $lastName;

        return $this;
    }

    /**
     * @return string
     */
    public function getRelation(): string
    {
        return $this->relation;
    }

    /**
     * @param string $relation
     * @return $this
     */
    public function setRelation(string $relation): self
    {
        $this->relation = $relation;

        return $this;
    }

    /**
     * @return int
     */
    public function getSalary(): int
    {
        return $this->salary;
    }

    /**
     * @param int $salary
     * @return $this
     */
    public function setSalary(int $salary): self
    {
        $this->salary = $salary;

        return $this;
    }

    /**
     * @return User
     */
    public function getUserRelated(): User
    {
        return $this->userRelated;
    }

    /**
     * @param User $userRelated
     * @return $this
     */
    public function setUserRelated(User $userRelated): self
    {
        $this->userRelated = $userRelated;

        return $this;
    }
}
