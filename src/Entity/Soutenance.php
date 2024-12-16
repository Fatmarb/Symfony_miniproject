<?php

namespace App\Entity;

use App\Repository\SoutenanceRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: SoutenanceRepository::class)]
class Soutenance
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $numjury = null;

    #[ORM\Column(type: Types::DATE_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $date_soutenance = null;

    #[ORM\Column(nullable: true)]
    private ?float $note = null;

    #[ORM\ManyToOne(targetEntity: Enseignant::class, inversedBy: 'soutenances')]
    #[ORM\JoinColumn(name: 'enseignant_id', referencedColumnName: 'Matricule', nullable: false)] // Ensures a Soutenance must have an Enseignant
    private ?Enseignant $enseignant = null;

    // Relation OneToMany avec Etudiant
    #[ORM\OneToMany(mappedBy: 'soutenance', targetEntity: Etudiant::class)]
    private Collection $etudiants;


    public function getNumjury(): ?int
    {
        return $this->numjury;
    }

    public function setNumjury(int $numjury): static
    {
        $this->numjury = $numjury;

        return $this;
    }

    public function getDateSoutenance(): ?\DateTimeInterface
    {
        return $this->date_soutenance;
    }

    public function setDateSoutenance(?\DateTimeInterface $date_soutenance): static
    {
        $this->date_soutenance = $date_soutenance;

        return $this;
    }

    public function getNote(): ?float
    {
        return $this->note;
    }

    public function setNote(?float $note): static
    {
        $this->note = $note;

        return $this;
    }

    // Getter and Setter for enseignant
    public function getEnseignant(): ?Enseignant
    {
        return $this->enseignant;
    }

    public function setEnseignant(?Enseignant $enseignant): self
    {
        $this->enseignant = $enseignant;

        return $this;
    }

    // Getter pour les Etudiants
    public function getEtudiants(): Collection
    {
        return $this->etudiants;
    }

    // Ajouter un étudiant à la soutenance
    public function addEtudiant(Etudiant $etudiant): self
    {
        if (!$this->etudiants->contains($etudiant)) {
            $this->etudiants->add($etudiant);
            $etudiant->setSoutenance($this); // Met à jour le lien côté Etudiant
        }
        return $this;
    }

    // Retirer un étudiant de la soutenance
    public function removeEtudiant(Etudiant $etudiant): self
    {
        if ($this->etudiants->removeElement($etudiant)) {
            if ($etudiant->getSoutenance() === $this) {
                $etudiant->setSoutenance(null);
            }
        }
        return $this;
    }

}
