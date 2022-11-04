<?php

namespace App\Form;

use App\Entity\PortfolioPicture;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\File;

class PortfolioPictureType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('title')
            ->add('subtitle')
            ->add('link')
            ->add('picture', FileType::class,[
                'mapped' => false,
                'constraints' => [
                    new File(
                        [
                            'maxSize' => '20M',
                            'maxSizeMessage' =>  'Le fichier dépasse la taille maximale (20mo)']
                    )
                ]
            ])
            ->add('submit', SubmitType::class)

        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => PortfolioPicture::class,
        ]);
    }
}
