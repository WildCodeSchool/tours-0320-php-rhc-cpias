<?php

namespace App\Form;

use App\Entity\Strain;
use App\Model\StrainName;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\OptionsResolver\OptionsResolver;

class MapSelectionType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {

        $builder->add('microOrganisme', ChoiceType::class, [
            'choices' => Strain::MICRO_ORGANISM,
            'placeholder' => 'Laisser vide ou choisir une souche',
            'required' => false
        ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => StrainName::class,
        ]);
    }
}
