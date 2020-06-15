<?php

namespace App\Entity;

use App\Repository\SignalementEsinRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=SignalementEsinRepository::class)
 */

class EsinSuite
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $investigation;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $hypotheseCause;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $justification;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $praticienHygiene;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getInvestigation(): ?string
    {
        return $this->investigation;
    }

    public function setInvestigation(?string $investigation): self
    {
        $this->investigation = $investigation;

        return $this;
    }

    public function getHypotheseCause(): ?string
    {
        return $this->hypotheseCause;
    }

    public function setHypotheseCause(?string $hypotheseCause): self
    {
        $this->hypotheseCause = $hypotheseCause;

        return $this;
    }

    public function getJustification(): ?string
    {
        return $this->justification;
    }

    public function setJustification(?string $justification): self
    {
        $this->justification = $justification;

        return $this;
    }

    public function getPraticienHygiene(): ?string
    {
        return $this->praticienHygiene;
    }

    public function setPraticienHygiene(?string $praticienHygiene): self
    {
        $this->praticienHygiene = $praticienHygiene;

        return $this;
    }
}
