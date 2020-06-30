<?php

namespace App\Form;

use App\Entity\Strain;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class MapSelectionType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $liste = Strain::MICRO_ORGANISM;
        $vide = ["vide"=>"Laisser vide"];
        $liste = array_merge($vide, $liste);

        $builder->add('microOrganisme', ChoiceType::class, ['choices' => $liste]);
        //$builder->add('resistance');
    }
}
