<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use App\Repository\EnseignantRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: EnseignantRepository::class)]
class Enseignant
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $Matricule = null;

    #[ORM\Column(length: 255)]
    private ?string $Nom = null;

    #[ORM\Column(length: 255)]
    private ?string $Prenom = null;


    #[ORM\OneToMany(targetEntity: Soutenance::class, mappedBy: "enseignant")]
    private Collection $soutenances;

    // Constructeur pour initialiser la Collection
    public function __construct()
    {
        $this->soutenances = new ArrayCollection();
    }

    // Getter pour soutenances
    public function getSoutenances(): Collection
    {
        return $this->soutenances;
    }

    // Méthode pour ajouter une soutenance
    public function addSoutenance(Soutenance $soutenance): static
    {
        if (!$this->soutenances->contains($soutenance)) {
            $this->soutenances->add($soutenance);
            $soutenance->setEnseignant($this);
        }

        return $this;
    }

    // Méthode pour supprimer une soutenance
    public function removeSoutenance(Soutenance $soutenance): static
    {
        if ($this->soutenances->removeElement($soutenance)) {
            // Effacer le lien côté Soutenance
            if ($soutenance->getEnseignant() === $this) {
                $soutenance->setEnseignant(null);
            }
        }

        return $this;
    }


    public function getMatricule(): ?int
    {
        return $this->Matricule;
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
}
