<?php

namespace App\Form;

use App\Entity\Finess;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class FinessType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('etablissement', TextType::class, [
                'label' => 'Nom de l\'etablissement'
            ])
            
            ->add('adresse', TextType::class, [
                'label' => 'Adresse'
            ])

            ->add('codePostale', TextType::class, [
                'label' => 'Code postale'
            ])

            ->add('ville', TextType::class, [
                'label' => 'Ville'
            ])

            ->add('finess', TextType::class, [
                'label' => 'Numero Finess'
            ])

            ->add('coordinates', TextType::class, [
                'label' => 'Coordonnées GPS'
            ])


        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Finess::class,
        ]);
    }
}
