<?php

namespace App\Entity;

use App\Repository\SignalementEsinRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=SignalementEsinRepository::class)
 */
class SignalementEsin
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer")
     */
    private $identifiantDeLaFiche;

    /**
     * @ORM\Column(type="date")
     */
    private $emissionDeLaFiche;

    /**
     * @ORM\Column(type="date")
     */
    private $dateDerniereModif;

    /**
     * @ORM\Column(type="integer")
     */
    private $codeFinessEtab;

    /**
     * @ORM\Column(type="date")
     */
    private $episodePrecedent;

    /**
     * @ORM\Column(type="boolean")
     */
    private $envoiAuCnr;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $nomCnrOuLabo;

    /**
     * @ORM\Column(type="integer")
     */
    private $nbCas;

    /**
     * @ORM\Column(type="text")
     */
    private $epidemieCasGroupes;

    /**
     * @ORM\Column(type="boolean")
     */
    private $caractereNosocomial;

    /**
     * @ORM\Column(type="integer")
     */
    private $origineCasImportes;

    /**
     * @ORM\Column(type="integer")
     */
    private $etabConcernes;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $autresEtabs;

    /**
     * @ORM\Column(type="integer")
     */
    private $codeMicroOrganisme;

    /**
     * @ORM\Column(type="integer")
     */
    private $codeSite;

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

    public function getIdentifiantDeLaFiche(): ?int
    {
        return $this->identifiantDeLaFiche;
    }

    public function setIdentifiantDeLaFiche(?int $identifiantDeLaFiche): self
    {
        $this->identifiantDeLaFiche = $identifiantDeLaFiche;

        return $this;
    }

    public function getEmissionDeLaFiche(): ?\DateTimeInterface
    {
        return $this->emissionDeLaFiche;
    }

    public function setEmissionDeLaFiche(?\DateTimeInterface $emissionDeLaFiche): self
    {
        $this->emissionDeLaFiche = $emissionDeLaFiche;

        return $this;
    }

    public function getDateDerniereModif(): ?\DateTimeInterface
    {
        return $this->dateDerniereModif;
    }

    public function setDateDerniereModif(?\DateTimeInterface $dateDerniereModif): self
    {
        $this->dateDerniereModif = $dateDerniereModif;

        return $this;
    }

    public function getCodeFinessEtab(): ?int
    {
        return $this->codeFinessEtab;
    }

    public function setCodeFinessEtab(?int $codeFinessEtab): self
    {
        $this->codeFinessEtab = $codeFinessEtab;

        return $this;
    }

    public function getEpisodePrecedent(): ?\DateTimeInterface
    {
        return $this->episodePrecedent;
    }

    public function setEpisodePrecedent(?\DateTimeInterface $episodePrecedent): self
    {
        $this->episodePrecedent = $episodePrecedent;

        return $this;
    }

    public function getEnvoiAuCNR(): ?bool
    {
        return $this->envoiAuCnr;
    }

    public function setEnvoiAuCNR(?bool $envoiAuCnr): self
    {
        $this->envoiAuCnr = $envoiAuCnr;

        return $this;
    }

    public function getNomCnrOuLabo(): ?string
    {
        return $this->nomCnrOuLabo;
    }

    public function setNomCnrOuLabo(?string $nomCnrOuLabo): self
    {
        $this->nomCnrOuLabo = $nomCnrOuLabo;

        return $this;
    }

    public function getNbCas(): ?int
    {
        return $this->nbCas;
    }

    public function setNCAS0(?int $nbCas): self
    {
        $this->nbCas = $nbCas;

        return $this;
    }

    public function getEpidemieCasGroupes(): ?string
    {
        return $this->epidemieCasGroupes;
    }

    public function setEpidemieCasGroupes(?string $epidemieCasGroupes): self
    {
        $this->epidemieCasGroupes = $epidemieCasGroupes;

        return $this;
    }

    public function getCaractereNosocomial(): ?bool
    {
        return $this->caractereNosocomial;
    }

    public function setCaractereNosocomial(?bool $caractereNosocomial): self
    {
        $this->caractereNosocomial = $caractereNosocomial;

        return $this;
    }

    public function getOrigineCasImportes(): ?int
    {
        return $this->origineCasImportes;
    }

    public function setOrigineCasImportes(int $origineCasImportes): self
    {
        $this->origineCasImportes = $origineCasImportes;

        return $this;
    }

    public function getEtabConcernes(): ?int
    {
        return $this->etabConcernes;
    }

    public function setEtabConcernes(int $etabConcernes): self
    {
        $this->etabConcernes = $etabConcernes;

        return $this;
    }

    public function getAutresEtabs(): ?string
    {
        return $this->autresEtabs;
    }

    public function setAutresEtabs(?string $autresEtabs): self
    {
        $this->autresEtabs = $autresEtabs;

        return $this;
    }

    public function getCodeMicroOrganisme(): ?int
    {
        return $this->codeMicroOrganisme;
    }

    public function setCodeMicroOrganisme(int $codeMicroOrganisme): self
    {
        $this->codeMicroOrganisme = $codeMicroOrganisme;

        return $this;
    }

    public function getCodeSite(): ?int
    {
        return $this->codeSite;
    }

    public function setCodeSite(int $codeSite): self
    {
        $this->codeSite = $codeSite;

        return $this;
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