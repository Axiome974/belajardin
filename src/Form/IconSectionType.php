<?php

namespace App\Form;

use App\Entity\IconSection;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class IconSectionType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('title')
            ->add('description')
            ->add('icon', ChoiceType::class,[
                "label"     => "Icone",
                "choices"   => [
                    "Carton"    => "bx bx-box",
                    "Papier"    => "bx bx-receipt"
                ],
                "attr"      => [
                    "data-controller" => "update-icon",
                    "class"           => "col-5"
                ]
            ])
            ->add("submit", SubmitType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => IconSection::class,
        ]);
    }
}
