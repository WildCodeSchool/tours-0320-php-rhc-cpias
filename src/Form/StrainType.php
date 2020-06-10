<?php

namespace App\Form;

use App\Entity\Strain;
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
                'choices' => [
                    'Staphylococcus aureus' => 'STA AUR',
                    'Escherichia coli' => 'ESC COL',
                    'Klebsiella pneumoniae' => 'KLE PNE'
                ]
            ])
            ->add('resistance', ChoiceType::class, [
                'choices' => [
                    'OXA-48' => 'OXA-48',
                    'NDM-1' => 'NDM-1',
                    'KPC-3' => 'KPC-3'
                ]
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
