<?php

namespace App\Entity;

use App\Repository\StrainRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * @ORM\Entity(repositoryClass=StrainRepository::class)
 * @UniqueEntity(fields={"creno", "datePrelevement"}, message="Cet identifiant CRENO existe déjà")
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
     * @Assert\NotBlank(message="Veuillez renseigner un identifiant CRENO")
     * @Assert\NotNull
     * @Assert\Positive(message="L'identifiant CRENO doit être un nombre entier positif")
     */
    private $creno;

    /**
     * @ORM\Column(type="date")
     * @Assert\NotBlank(message="Veuillez renseigner une date de prélèvement")
     * @Assert\Date
     */
    private $datePrelevement;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank(message="Veuillez renseigner un type de prélèvement")
     */
    private $typePrelevement;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank(message="Veuillez renseigner un micro-organisme")
     */
    private $microOrganisme;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank(message="Veuillez renseigner un type de résistance")
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
