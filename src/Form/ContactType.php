<?php

namespace App\Form;

use App\Entity\Contact;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\NotNull;

class ContactType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('title', TextType::class, [
                'label' => 'Titre de la rubrique',
                'constraints' => [
                    new NotNull()
                ]
            ])
            ->add('description', TextareaType::class, [
                'label' => 'Description de la rubrique',
                'constraints' => [
                    new NotNull()
                ]
            ])

            ->add('address', TextType::class, [
                'label' => 'Adresse',
                'constraints' => [
                    new NotNull()
                ]
            ])
            ->add('phone', TextType::class, [
                'label' => 'Téléphone',
                'constraints' => [
                    new NotNull()
                ]
            ])
            ->add('email', EmailType::class, [
                'label' => 'Email',
                'constraints' => [
                    new NotNull()
                ]
            ])
            ->add('facebook', EmailType::class, [
                'label' => 'Facebook',
                'constraints' => [
                    new NotNull()
                ]
            ])
            ->add('instagram', EmailType::class, [
                'label' => 'Instagram',
                'constraints' => [
                    new NotNull()
                ]
            ])
            ->add('linkedin', EmailType::class, [
                'label' => 'Linkedin',
                'constraints' => [
                    new NotNull()
                ]
            ])
            ->add('twitter', EmailType::class, [
                'label' => 'Twitter',
                'constraints' => [
                    new NotNull()
                ]
            ])
            ->add('submit', SubmitType::class, [
                'label'     => 'Enregistrer'
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Contact::class,
        ]);
    }
}
