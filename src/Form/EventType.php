<?php

namespace App\Form;

use App\Entity\Event;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\LanguageType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\UrlType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Tests\Extension\Core\Type\TextTypeTest;
use Symfony\Component\OptionsResolver\OptionsResolver;

class EventType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title', TextType::class, [
                'label' => 'Titre'
            ])
            ->add('pictureFile', FileType::class, [
                'mapped' => false,
                'required' => false,
                'label' => 'Image'
            ])
            ->add('city', TextType::class, [
                'label' => 'Ville'
            ])
            ->add('description', TextareaType::class, [
                'label' => 'Description'
            ])
            ->add('dateStart', DateType::class, [
                'label' => 'Date de début'
            ])
            ->add('dateEnd', DateType::class, [
                'label' => 'Date de fin'
            ])
            ->add('url', UrlType::class, [
                'label' => 'Adresse url'
            ])
            ->add('price', NumberType::class, [
                'label' => 'Prix'
            ])
            ->add('language')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Event::class,
        ]);
    }
}
