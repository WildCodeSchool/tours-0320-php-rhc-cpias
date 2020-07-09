<?php

namespace App\Entity;

use App\Repository\StrainRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * @ORM\Entity(repositoryClass=StrainRepository::class)
 * @UniqueEntity(fields={"creno", "datePrelevement"}, message="Cet identifiant CRENO existe déjà pour cette date")
 */
class Strain
{
    const MICRO_ORGANISM = [
        'STA AUR-Staphylococcus aureus' => 'STA AUR-Staphylococcus aureus',
        'STA EPI-Staphylococcus epidermidis'=> 'STA EPI-Staphylococcus epidermidis',
        'STA HAE-Staphylococcus haemolyticus' => 'STA HAE-Staphylococcus haemolyticus',
        'STA CAP-Staphylococcus capitis' => 'STA CAP-Staphylococcus capitis',
        'STA AUT-Staph. à coagulase négative : autre espèce identifiée' =>
            'STA AUT-Staph. à coagulase négative : autre espèce identifiée',
        'STA NSP-Staph. à coagulase négative non spécifié' => 'STA NSP-Staph. à coagulase négative non spécifié',
        'STR PNE-Streptococcus pneumoniae (pneumocoque)' => 'STR PNE-Streptococcus pneumoniae (pneumocoque)',
        'STR AGA-Streptococcus agalactiae (B)' => 'STR AGA-Streptococcus agalactiae (B)',
        'STR PYO-Streptococcus pyogenes (A)' => 'STR PYO-Streptococcus pyogenes (A)',
        'STR HCG-Streptocoques hémolytiques : autres (C, G)' => 'STR HCG-Streptocoques hémolytiques : autres (C, G)',
        'STR NGR-Streptocoques (viridans) non groupables' => 'STR NGR-Streptocoques (viridans) non groupables',
        'STR AUT-Streptocoques autres' => 'STR AUT-Streptocoques autres',
        'ENC FAE-Enterococcus faecalis' => 'ENC FAE-Enterococcus faecalis',
        'ENC FAI-Enterococcus faecium' => 'ENC FAI-Enterococcus faecium',
        'ENC AUT-Enterococcus autres' => 'ENC AUT-Enterococcus autres',
        'ENC NSP-Enterococcus non spécifié' => 'ENC NSP-Enterococcus non spécifié',
        'CGP AUT-Cocci Gram + : autres' => 'CGP AUT-Cocci Gram + : autres',
        'MOR SPP-Moraxella' => 'MOR SPP-Moraxella',
        'NEI MEN-Neisseria meningitidis' => 'NEI MEN-Neisseria meningitidis',
        'NEI AUT-Neisseria autres' => 'NEI AUT-Neisseria autres',
        'CGN AUT-Cocci Gram - : autres' => 'CGN AUT-Cocci Gram - : autres',
        'COR SPP-Corynebacterium' => 'COR SPP-Corynebacterium',
        'BAC CER-Bacillus cereus' => 'BAC CER-Bacillus cereus',
        'BAC SPP-Bacillus autres' => 'BAC SPP-Bacillus autres',
        'LAC SPP-Lactobacillus' => 'LAC SPP-Lactobacillus',
        'LIS MON-Listeria monocytogenes' => 'LIS MON-Listeria monocytogenes',
        'BGP AUT-Bacilles Gram + : autres' => 'BGP AUT-Bacilles Gram + : autres',
        'CIT FRE-Citrobacter freundii' => 'CIT FRE-Citrobacter freundii',
        'CIT KOS-Citrobacter koseri (ex. diversus)' => 'CIT KOS-Citrobacter koseri (ex. diversus)',
        'CIT AUT-Citrobacter autres' => 'CIT AUT-Citrobacter autres',
        'ENT AER-Enterobacter aerogenes' => 'ENT AER-Enterobacter aerogenes',
        'ENT CLO-Enterobacter cloacae' => 'ENT CLO-Enterobacter cloacae',
        'ENT AUT-Enterobacter autres' => 'ENT AUT-Enterobacter autres',
        'ESC COL-Escherichia coli' => 'ESC COL-Escherichia coli',
        'HAF SPP-Hafnia' => 'HAF SPP-Hafnia',
        'KLE OXY-Klebsiella oxytoca' => 'KLE OXY-Klebsiella oxytoca',
        'KLE PNE-Klebsiella pneumoniae' => 'KLE PNE-Klebsiella pneumoniae',
        'KLE AUT-Klebsiella autres' => 'KLE AUT-Klebsiella autres',
        'MOG SPP-Morganella' => 'MOG SPP-Morganella',
        'PRT MIR-Proteus mirabilis' => 'PRT MIR-Proteus mirabilis',
        'PRT AUT-Proteus autres' => 'PRT AUT-Proteus autres',
        'PRV SPP-Providencia' => 'PRV SPP-Providencia',
        'SAL TYP-Salmonella Typhi ou Paratyphi' => 'SAL TYP-Salmonella Typhi ou Paratyphi',
        'SAL AUT-Salmonella autre' => 'SAL AUT-Salmonella autre',
        'SER SPP-Serratia' => 'SER SPP-Serratia',
        'SHI SPP-Shigella' => 'SHI SPP-Shigella',
        'ETB AUT-Entérobactéries : autres' => 'ETB AUT-Entérobactéries : autres',
        'ACH SPP-Achromobacter' => 'ACH SPP-Achromobacter',
        'ACI BAU-Acinetobacter baumannii' => 'ACI BAU-Acinetobacter baumannii',
        'ACI AUT-Acinetobacter autres' => 'ACI AUT-Acinetobacter autres',
        'AEM SPP-Aeromonas' => 'AEM SPP-Aeromonas',
        'AGR SPP-Agrobacterium' => 'AGR SPP-Agrobacterium',
        'ALC SPP-Alcaligenes' => 'ALC SPP-Alcaligenes',
        'BUR CEP-Burkholderia cepacia' => 'BUR CEP-Burkholderia cepacia',
        'CAM SPP-Campylobacter' => 'CAM SPP-Campylobacter',
        'FLA SPP-Flavobacterium' => 'FLA SPP-Flavobacterium',
        'GAR SPP-Gardnerella' => 'GAR SPP-Gardnerella',
        'HAE SPP-Haemophilus' => 'HAE SPP-Haemophilus',
        'HEL PYL-Helicobacter pylori' => 'HEL PYL-Helicobacter pylori',
        'LEG SPP-Legionella' => 'LEG SPP-Legionella',
        'PAS SPP-Pasteurella' => 'PAS SPP-Pasteurella',
        'PSE AER-Pseudomonas aeruginosa' => 'PSE AER-Pseudomonas aeruginosa',
        'PSE AUT-Pseudomonas autres et apparentés' => 'PSE AUT-Pseudomonas autres et apparentés',
        'STE MAL-Stenotrophomonas maltophilia' => 'STE MAL-Stenotrophomonas maltophilia',
        'BGN AUT-Bacille Gram- non entérobactérie autres' => 'BGN AUT-Bacille Gram- non entérobactérie autres',
        'BAT FRA-Bacteroïdes fragilis' => 'BAT FRA-Bacteroïdes fragilis',
        'BAT AUT-Bacteroïdes autres' => 'BAT AUT-Bacteroïdes autres',
        'CLO DIF-Clostridium difficile' => 'CLO DIF-Clostridium difficile',
        'CLO AUT-Clostridium autres' => 'CLO AUT-Clostridium autres',
        'PRE SPP-Prevotella' => 'PRE SPP-Prevotella',
        'PRO SPP-Propionibacterium' => 'PRO SPP-Propionibacterium',
        'ANA AUT-Anaérobies : autres' => 'ANA AUT-Anaérobies : autres',
        'ACT SPP-Actinomyces' => 'ACT SPP-Actinomyces',
        'CHL SPP-Chlamydia' => 'CHL SPP-Chlamydia',
        'MYC ATY-Mycobactérie atypique' => 'MYC ATY-Mycobactérie atypique',
        'MYC TUB-Mycobacterium complex tuberculosis' => 'MYC TUB-Mycobacterium complex tuberculosis',
        'MYP SPP-Mycoplasma' => 'MYP SPP-Mycoplasma',
        'NOC SPP-Nocardia' => 'NOC SPP-Nocardia',
        'BCT AUT-Bactéries autres' => 'BCT AUT-Bactéries autres',
        'CAN ALB-Candida albicans' => 'CAN ALB-Candida albicans',
        'CAN AUR-Candida auris' => 'CAN AUR-Candida auris',
        'CAN GLA-Candida glabrata' => 'CAN GLA-Candida glabrata',
        'CAN KRU-Candida krusei' => 'CAN KRU-Candida krusei',
        'CAN PAR-Candida parapsilosis' => 'CAN PAR-Candida parapsilosis',
        'CAN TRO-Candida tropicalis' => 'CAN TRO-Candida tropicalis',
        'CAN AUT-Candida autres' => 'CAN AUT-Candida autres',
        'ASP FUM-Aspergillus fumigatus' => 'ASP FUM-Aspergillus fumigatus',
        'ASP AUT-Aspergillus autres' => 'ASP AUT-Aspergillus autres',
        'LEV AUT-Levures autres' => 'LEV AUT-Levures autres',
        'FIL AUT-Filaments autres' => 'FIL AUT-Filaments autres',
        'PAR AUT-Parasites autres' => 'PAR AUT-Parasites autres',
        'VIR ADV-Adenovirus' => 'VIR ADV-Adenovirus',
        'VIR CMV-CMV (cytomégalovirus)' => 'VIR CMV-CMV (cytomégalovirus)',
        'VIR ENT-Enterovirus (polio, coxsackie, echo)' => 'VIR ENT-Enterovirus (polio, coxsackie, echo)',
        'VIR INF-Grippe (influenzae)' => 'VIR INF-Grippe (influenzae)',
        'VIR HAV-Hépatite virale A' => 'VIR HAV-Hépatite virale A',
        'VIR HBV-Hépatite virale B' => 'VIR HBV-Hépatite virale B',
        'VIR HCV-Hépatite virale C' => 'VIR HCV-Hépatite virale C',
        'VIR ROT-Rotavirus' => 'VIR ROT-Rotavirus',
        'VIR VIH-VIH (virus de l\'immunodéficience humaine)' => 'VIR VIH-VIH (virus de l\'immunodéficience humaine)',
        'VIR HSV-Herpès simplex Virus' => 'VIR HSV-Herpès simplex Virus',
        'VIR VZV-Varicello-zonateux Virus' => 'VIR VZV-Varicello-zonateux Virus',
        'VIR VRS-VRS (virus respiratoire syncitial)' => 'VIR VRS-VRS (virus respiratoire syncitial)',
        'VIR AUT-Virus autres' => 'VIR AUT-Virus autres',
        'NON IDE-Micro-organisme non identifié ou non retrouvé' =>
            'NON IDE-Micro-organisme non identifié ou non retrouvé',
        'NON EFF-Examen non effectué' => 'NON EFF-Examen non effectué',
        'EXA STE-Examen stérile' => 'EXA STE-Examen stérile'
    ];

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

    /**
     * @ORM\ManyToOne(targetEntity=Finess::class, inversedBy="strains")
     * @ORM\JoinColumn(nullable=false)
     * @Assert\NotBlank(message="Veuillez renseigner un numéro finess")
     */
    private $finess;

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

    public function getFiness(): ?Finess
    {
        return $this->finess;
    }

    public function setFiness(?Finess $finess): self
    {
        $this->finess = $finess;

        return $this;
    }
}
