<?php

namespace App\Form;

use App\Entity\AboutSection;
use App\Entity\IconSection;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AboutSectionType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $about = $builder->getData();
        $builder
            ->add('title')
            ->add('description');
            if( $about->getFile() === null ){
                $builder->add('file', FileType::class, [
                    "mapped"    => false
                ]);
            }
            $builder->add("submit", SubmitType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => AboutSection::class,
        ]);
    }
}
