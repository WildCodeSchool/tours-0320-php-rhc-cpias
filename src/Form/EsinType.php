<?php

namespace App\Form;

use App\Model\Upload;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Validator\Constraints\File;

class EsinType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('UploadedFile', FileType::class, [
                'label' => 'Fichier CSV',
                'constraints' => [
                    new File([
                        'mimeTypes' =>[
                            'text/csv',
                        ],
                        'mimeTypesMessage' => 'Ce n\'est pas un fichier CSV',
                    ])
                ],

            ])
            
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Upload::class,
        ]);
    }
}
