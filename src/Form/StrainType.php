<?php

namespace App\Form;

use App\Entity\Finess;
use App\Entity\Strain;
use Doctrine\DBAL\Types\TextType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;

class StrainType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('creno', IntegerType::class)
            ->add('finess', EntityType::class, [
                    'class' => Finess::class,
                    'choice_label' => 'etablissement',
                    'expanded' => false,
                    'multiple' => false,
                    'by_reference' => false
                ])
            ->add('datePrelevement', DateType::class, [
                'widget' => 'single_text',
            ])
            ->add('typePrelevement', ChoiceType::class, [
                'choices' => [
                    'Hémoculture' => 'Hémoculture',
                    'Urine' => 'Urine',
                    'ECBU' => 'ECBU'
                ]
            ])
            ->add('microOrganisme', ChoiceType::class, [
                'choices' => Strain::MICRO_ORGANISM
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
