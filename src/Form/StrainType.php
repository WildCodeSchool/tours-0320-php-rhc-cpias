<?php

namespace App\Form;

use App\Entity\Strain;
use Doctrine\DBAL\Types\TextType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;

class StrainType extends AbstractType
{
    const MICRO_ORGANISM = [
        'STA AUR-Staphylococcus aureus' => 'STA AUR-Staphylococcus aureus',
        'STA EPI-Staphylococcus epidermidis'=> 'STA EPI-Staphylococcus epidermidis',
        'STA HAE-Staphylococcus haemolyticus' => 'STA HAE-Staphylococcus haemolyticus',
        'STA CAP-Staphylococcus capitis' => 'STA CAP-Staphylococcus capitis',
        'STA AUT-Staph. à coagulase négative : autre espèce identifiée' => 'STA AUT-Staph. à coagulase négative : autre espèce identifiée',
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
        'NON IDE-Micro-organisme non identifié ou non retrouvé' => 'NON IDE-Micro-organisme non identifié ou non retrouvé',
        'NON EFF-Examen non effectué' => 'NON EFF-Examen non effectué',
        'EXA STE-Examen stérile' => 'EXA STE-Examen stérile'
        ];

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('creno', IntegerType::class)
            ->add('datePrelevement', DateType::class, [
                'widget' => 'choice',
            ])
            ->add('typePrelevement', ChoiceType::class, [
                'choices' => [
                    'Hémoculture' => 'Hémoculture',
                    'Urine' => 'Urine',
                    'ECBU' => 'ECBU'
                ]
            ])
            ->add('microOrganisme', ChoiceType::class, [
                'choices' => self::MICRO_ORGANISM
            ])
            ->add('resistance', ChoiceType::class, [
                'choices' => [
                    'OXA-48' => 'OXA-48',
                    'NDM-1' => 'NDM-1',
                    'KPC-3' => 'KPC-3',
                ],
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Strain::class,
        ]);
    }
}
