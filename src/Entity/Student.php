<?php

namespace App\Entity;

use App\Repository\StudentRepository;
use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Core\Annotation\ApiResource;
use Symfony\Component\Validator\Constraints as Assert;


#[ORM\Entity]
#[ApiResource]
/**
 * @ORM\Entity(repositoryClass=StudentRepository::class)
 */
class Student
{
    #[ORM\Id, ORM\Column, ORM\GeneratedValue]
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    #[ORM\Column]
    #[Assert\NotBlank]
    /**
     * @ORM\Column(type="string", length=25)
     */
    private $FirstName;

    #[ORM\Column]
    #[Assert\NotBlank]
    /**
     * @ORM\Column(type="string", length=25)
     */
    private $LastName;

    #[ORM\Column]
    #[Assert\NotBlank]
    /**
     * @ORM\Column(type="string", length=10)
     */
    private $NumEtud;

    #[ORM\OneToMany(targetEntity: Departement::class, mappedBy: 'etudiants', cascade: ['persist'])]
    /**
     * @ORM\ManyToOne(targetEntity=Departement::class, inversedBy="etudiants")
     * @ORM\JoinColumn(nullable=false)
     */
    private $departement;

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

    public function getNumEtud(): ?string
    {
        return $this->NumEtud;
    }

    public function setNumEtud(string $NumEtud): self
    {
        $this->NumEtud = $NumEtud;

        return $this;
    }

    public function getDepartement(): ?Departement
    {
        return $this->departement;
    }

    public function setDepartement(?Departement $departement): self
    {
        $this->departement = $departement;

        return $this;
    }
}
