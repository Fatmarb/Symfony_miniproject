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
    #[ORM\Column (type: 'integer')]
    private ?int $numjury = null;

    #[ORM\Column(type: Types::DATE_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $date_soutenance = null;

    #[ORM\Column( type: 'float', nullable: true)]
    private ?float $note = null;

    #[ORM\ManyToOne(targetEntity: Enseignant::class, inversedBy: 'soutenances')]
    #[ORM\JoinColumn(name: 'enseignant_id', referencedColumnName: 'Matricule', nullable: false)]
    private ?Enseignant $enseignant = null;


    #[ORM\ManyToOne(targetEntity: Etudiant::class, inversedBy: 'soutenances')]
    #[ORM\JoinColumn(name: 'etudiant_id', referencedColumnName: 'NCE', nullable: false)]
    private ?Etudiant $etudiant = null;


    public function getNumjury(): ?int
    {
        return $this->numjury;
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

    public function setNote(?float $note): self
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

    public function getEtudiant(): ?Etudiant
    {
        return $this->etudiant;
    }

    public function setEtudiant(?Etudiant $etudiant): self
    {
        $this->etudiant = $etudiant;

        return $this;
    }
    // Ajouter un étudiant à la soutenance
    public function addEtudiant(Etudiant $etudiant): self
    {
        if (!$this->etudiant->contains($etudiant)) {
            $this->etudiant->add($etudiant);
            $etudiant->setSoutenance($this); // Met à jour le lien côté Etudiant
        }
        return $this;
    }

    // Retirer un étudiant de la soutenance
    public function removeEtudiant(Etudiant $etudiant): self
    {
        if ($this->etudiant->removeElement($etudiant)) {
            if ($etudiant->getSoutenance() === $this) {
                $etudiant->setSoutenance(null);
            }
        }
        return $this;
    }

}
