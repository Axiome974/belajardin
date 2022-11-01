<?php

namespace App\Form;

use App\Entity\VisitorMessage;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\NotBlank;

class VisitorMessageType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', TextType::class, [
                "attr" => [
                    'placeholder' => 'Votre nom'
                ],
                'constraints' => [
                    new NotBlank(null, 'Vous devez saisir un nom.')
                ]
            ])
            ->add('email', TextType::class, [
                'attr' => [
                    'placeholder' => 'Email'
                ],
                'constraints' => [
                    new NotBlank(null, 'Vous devez saisir un email.')
                ]
            ])
            ->add('subject', TextType::class, [
                'attr' => [
                    'placeholder' => 'Sujet de votre message'
                ],
                'constraints' => [
                    new NotBlank(null, 'Vous devez saisir un sujet.')
                ]
            ])
            ->add('message', TextareaType::class, [
                'attr' => [
                    'placeholder' => 'Message'
                ],
                'constraints' => [
                    new NotBlank(null, 'Vous devez saisir un message.')
                ]
            ])
            ->add('submit', SubmitType::class, [
                'label' => 'Envoyer le massage'
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => VisitorMessage::class,
        ]);
    }
}
