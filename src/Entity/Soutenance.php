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

    // Relation ManyToMany avec Etudiant
    #[ORM\ManyToMany(targetEntity: Etudiant::class, inversedBy: "soutenances")]
    #[ORM\JoinTable(
        name: "soutenances_etudiants",
        joinColumns: [new ORM\JoinColumn(name: "numjury", referencedColumnName: "numjury", nullable: false)],
        inverseJoinColumns: [ new ORM\JoinColumn(name: "NCE", referencedColumnName: "NCE", nullable: false)]
    )]
    private Collection $etudiants;

    public function getId(): ?int
    {
        return $this->id;
    }

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
}
