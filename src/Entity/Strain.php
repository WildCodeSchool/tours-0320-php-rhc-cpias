<?php

namespace App\Entity;

use App\Repository\StrainRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=StrainRepository::class)
 */
class Strain
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
    private $creno;

    /**
     * @ORM\Column(type="date")
     */
    private $datePrelevement;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $typePrelevement;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $microOrganisme;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $resistance;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCreno(): ?string
    {
        return $this->creno;
    }

    public function setCreno(string $creno): self
    {
        $this->creno = $creno;

        return $this;
    }

    public function getDatePrelevement(): ?\DateTimeInterface
    {
        return $this->datePrelevement;
    }

    public function setDatePrelevement(\DateTimeInterface $datePrelevement): self
    {
        $this->datePrelevement = $datePrelevement;

        return $this;
    }

    public function getTypePrelevement(): ?string
    {
        return $this->typePrelevement;
    }

    public function setTypePrelevement(string $typePrelevement): self
    {
        $this->typePrelevement = $typePrelevement;

        return $this;
    }

    public function getMicroOrganisme(): ?string
    {
        return $this->microOrganisme;
    }

    public function setMicroOrganisme(string $microOrganisme): self
    {
        $this->microOrganisme = $microOrganisme;

        return $this;
    }

    public function getResistance(): ?string
    {
        return $this->resistance;
    }

    public function setResistance(string $resistance): self
    {
        $this->resistance = $resistance;

        return $this;
    }
}
