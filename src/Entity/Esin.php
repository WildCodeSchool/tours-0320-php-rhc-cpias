<?php

namespace App\Entity;

use App\Repository\EsinRepository;
use Doctrine\ORM\Mapping as ORM;
use \DateTime;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=EsinRepository::class)
 */
class Esin
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer")
     * @Assert\NotBlank()
     * @Assert\Positive
     */
    private $identifiantDeLaFiche;

    /**
     * @ORM\Column(type="date")
     * @Assert\NotBlank()
     * @Assert\Date
     */
    private $emissionDeLaFiche;

    /**
     * @ORM\Column(type="date")
     * @Assert\Date
     */
    private $dateDerniereModif;

    /**
     * @ORM\Column(type="integer")
     * @Assert\NotBlank()
     * @Assert\Positive
     */
    private $codeFinessEtab;

    /**
     * @ORM\Column(type="date")
     * @Assert\NotBlank()
     * @Assert\Date
     */
    private $episodePrecedent;

    /**
     * @ORM\Column(type="integer")
     * @Assert\NotBlank()
     * @Assert\Positive
     */
    private $envoiAuCnr;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank()
     * @Assert\Length(max="255",
     * maxMessage="{{ value }} est trop long, il ne devrait pas dépasser {{ limit }} caractères")
     */
    private $nomCnrOuLabo;

    /**
     * @ORM\Column(type="integer")
     * @Assert\NotBlank()
     * @Assert\Positive
     */
    private $nbCas;

    /**
     * @ORM\Column(type="text")
     */
    private $epidemieCasGroupes;

    /**
     * @ORM\Column(type="integer", nullable=true)
     * @Assert\Choice(choices={1,2})
     */
    private $caractereNosocomial;

    /**
     * @ORM\Column(type="integer")
     * @Assert\NotBlank()
     * @Assert\Positive
     */
    private $origineCasImportes;

    /**
     * @ORM\Column(type="integer")
     * @Assert\NotBlank()
     * @Assert\Positive
     */
    private $etabConcernes;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $autresEtabs;

    /**
     * @ORM\Column(type="integer")
     * @Assert\NotBlank()
     * @Assert\Positive
     */
    private $codeMicroOrganisme1;

    /**
     * @ORM\Column(type="integer")
     * @Assert\NotBlank()
     * @Assert\Positive
     */
    private $codeMicroOrganisme2;

    /**
     * @ORM\Column(type="integer")
     * @Assert\NotBlank()
     * @Assert\Positive
     */
    private $codeMicroOrganisme3;

    /**
     * @ORM\Column(type="integer")
     * @Assert\NotBlank()
     * @Assert\Positive
     */
    private $codeSiteUn;

    /**
     * @ORM\Column(type="integer")
     * @Assert\Positive
     */
    private $codeSiteDeux;

    /**
     * @ORM\Column(type="integer")
     * @Assert\Positive
     */
    private $codeSiteTrois;

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

    public function setEmissionString(string $date)
    {
        $day = substr($date, 0, 2);
        $month = substr($date, 3, 2);
        $year = substr($date, 6, 4);
        $this->emissionDeLaFiche = new DateTime($year ."-". $month . "-". $day);
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

    public function setStringDerniereModif(string $date)
    {
        $day = substr($date, 0, 2);
        $month = substr($date, 3, 2);
        $year = substr($date, 6, 4);
        $this->dateDerniereModif = new DateTime($year ."-". $month . "-". $day);
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

    public function setStringEpisode(string $date)
    {
        $day = substr($date, 0, 2);
        $month = substr($date, 3, 2);
        $year = substr($date, 6, 4);
        $this->episodePrecedent = new DateTime($year ."-". $month . "-". $day);
        return $this;
    }

    public function getEnvoiAuCNR(): ?string
    {
        return $this->envoiAuCnr;
    }

    public function setEnvoiAuCNR(?string $envoiAuCnr): self
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

    public function setNbCas(?int $nbCas): self
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

    public function getCaractereNosocomial(): int
    {
        return $this->caractereNosocomial;
    }

    public function setCaractereNosocomial(int $caractereNosocomial): self
    {
        $this->caractereNosocomial = $caractereNosocomial;

        return $this;
    }

    public function getOrigineCasImportes(): ?int
    {
        return $this->origineCasImportes;
    }

    public function setOrigineCasImportes(?int $origineCasImportes): self
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

    public function getCodeMicroOrganisme1(): ?int
    {
        return $this->codeMicroOrganisme1;
    }

    public function setCodeMicroOrganisme1(int $codeMicroOrganisme1): self
    {
        $this->codeMicroOrganisme1 = $codeMicroOrganisme1;

        return $this;
    }

    public function getCodeMicroOrganisme2(): ?int
    {
        return $this->codeMicroOrganisme2;
    }

    public function setCodeMicroOrganisme2(int $codeMicroOrganisme2): self
    {
        $this->codeMicroOrganisme2 = $codeMicroOrganisme2;

        return $this;
    }

    public function getCodeMicroOrganisme3(): ?int
    {
        return $this->codeMicroOrganisme3;
    }

    public function setCodeMicroOrganisme3(int $codeMicroOrganisme3): self
    {
        $this->codeMicroOrganisme3 = $codeMicroOrganisme3;

        return $this;
    }

    public function getCodeSiteUn(): ?int
    {
        return $this->codeSiteUn;
    }

    public function setCodeSiteUn(int $codeSiteUn): self
    {
        $this->codeSiteUn = $codeSiteUn;

        return $this;
    }

    public function getCodeSiteDeux(): ?int
    {
        return $this->codeSiteDeux;
    }

    public function setCodeSiteDeux(int $codeSiteDeux): self
    {
        $this->codeSiteDeux = $codeSiteDeux;

        return $this;
    }

    public function getCodeSiteTrois(): ?int
    {
        return $this->codeSiteTrois;
    }

    public function setCodeSiteTrois(int $codeSiteTrois): self
    {
        $this->codeSiteTrois = $codeSiteTrois;

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
