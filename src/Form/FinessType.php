<?php

namespace App\Form;

use App\Entity\Finess;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class FinessType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('etablissement', TextType::class)
            ->add('adresse', TextType::class)
            ->add('codePostal', IntegerType::Class)
            ->add('ville', TextType::class)
            ->add('finess', TextType::class)
            ->add('coordinates', TextType::class, [
                'required'=>false
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
