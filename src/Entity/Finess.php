<?php

namespace App\Entity;

use App\Repository\FinessRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=FinessRepository::class)
 */
class Finess
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $etablissement;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $adresse;

    /**
     * @ORM\Column(type="integer")
     */
    private $codePostal;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $ville;

    /**
     * @ORM\Column(type="integer")
     */
    private $finess;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $coordinates;

    /**
     * @ORM\OneToMany(targetEntity=Strain::class, mappedBy="finess", orphanRemoval=true)
     */
    private $strains;

    public function __construct()
    {
        $this->strains = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEtablissement(): ?string
    {
        return $this->etablissement;
    }

    public function setEtablissement(string $etablissement): self
    {
        $this->etablissement = $etablissement;

        return $this;
    }

    public function getAdresse(): ?string
    {
        return $this->adresse;
    }

    public function setAdresse(string $adresse): self
    {
        $this->adresse = $adresse;

        return $this;
    }

    public function getCodePostal(): ?int
    {
        return $this->codePostal;
    }

    public function setCodePostal(int $codePostal): self
    {
        $this->codePostal = $codePostal;

        return $this;
    }

    public function getVille(): ?string
    {
        return $this->ville;
    }

    public function setVille(string $ville): self
    {
        $this->ville = $ville;

        return $this;
    }

    public function getFiness(): ?int
    {
        return $this->finess;
    }

    public function setFiness(int $finess): self
    {
        $this->finess = $finess;

        return $this;
    }

    public function getCoordinates(): ?string
    {
        return $this->coordinates;
    }

    public function setCoordinates(string $coordinates): self
    {
        $this->coordinates = $coordinates;

        return $this;
    }

    /**
     * @return Collection|Strain[]
     */
    public function getStrains(): Collection
    {
        return $this->strains;
    }

    public function addStrain(Strain $strain): self
    {
        if (!$this->strains->contains($strain)) {
            $this->strains[] = $strain;
            $strain->setFiness($this);
        }

        return $this;
    }

    public function removeStrain(Strain $strain): self
    {
        if ($this->strains->contains($strain)) {
            $this->strains->removeElement($strain);
            // set the owning side to null (unless already changed)
            if ($strain->getFiness() === $this) {
                $strain->setFiness(null);
            }
        }

        return $this;
    }
}
