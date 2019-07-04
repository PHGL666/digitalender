<?php

namespace App\Form;

use App\Entity\City;
use App\Entity\Event;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\UrlType;
use Symfony\Component\Form\FormBuilderInterface;
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
            ])
            ->add('city', EntityType::class, [
                'class' => City::class,
                'label' => 'Ville'
            ])
            ->add('description')
            ->add('dateStart', DateType::class, [
                'label' => 'Date de début'
            ])
            ->add('dateEnd', DateType::class, [
                'label' => 'Date de fin'
            ])
            ->add('url')
            ->add('price')
            ->add('language');
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Event::class,
        ]);
    }
}
