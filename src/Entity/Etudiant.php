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
    #[ORM\Column (name: 'NCE', type: 'integer')]
    private ?int $id = null;

    #[ORM\Column(type: 'string',length: 255)]
    private ?string $Nom = null;

    #[ORM\Column(type: 'string', length: 255)]
    private ?string $Prenom = null;

    #[ORM\OneToMany(mappedBy: 'etudiant', targetEntity: Soutenance::class)]
    private Collection $soutenances; 
    
    public function __construct()
    {
        $this->soutenances = new ArrayCollection();
    }
    
    public function getSoutenances(): Collection
    {
        return $this->soutenances;
    }
    
    public function addSoutenance(Soutenance $soutenance): self
    {
        if (!$this->soutenances->contains($soutenance)) {
            $this->soutenances[] = $soutenance;
            $soutenance->setEtudiant($this);
        }
    
        return $this;
    }
    
    public function removeSoutenance(Soutenance $soutenance): self
    {
        if ($this->soutenances->removeElement($soutenance)) {
            if ($soutenance->getEtudiant() === $this) {
                $soutenance->setEtudiant(null);
            }
        }
    
        return $this;
    }

    public function getId(): ?int
    {
        return $this->id;
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
