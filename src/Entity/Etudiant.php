<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use App\Repository\EtudiantRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: EtudiantRepository::class)]
class Etudiant
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $NCE = null;

    #[ORM\Column(length: 255)]
    private ?string $Nom = null;

    #[ORM\Column(length: 255)]
    private ?string $Prenom = null;

    // Relation ManyToMany avec Soutenance
    #[ORM\OneToOne(inversedBy: 'etudiant', targetEntity: Soutenance::class)]
    #[ORM\JoinColumn(name: 'soutenance_numjury', referencedColumnName: 'numjury',nullable: false)]
    private Soutenance $soutenance;

    // Constructeur pour initialiser la Collection
    public function __construct()
    {
        $this->soutenances = new ArrayCollection();
    }

    // Getters et Setters
    public function getNCE(): ?int
    {
        return $this->NCE;
    }


    public function getNom(): ?string
    {
        return $this->Nom;
    }

    public function setNom(string $Nom): static
    {
        $this->Nom = $Nom;

        return $this;
    }

    public function getPrenom(): ?string
    {
        return $this->Prenom;
    }

    public function setPrenom(string $Prenom): static
    {
        $this->Prenom = $Prenom;

        return $this;
    }
    // Getter pour la Soutenance
    public function getSoutenance(): Soutenance
    {
        return $this->soutenance;
    }

    // Setter pour la Soutenance
    public function setSoutenance(Soutenance $soutenance): self
    {
        $this->soutenance = $soutenance;
        return $this;
    }

}
