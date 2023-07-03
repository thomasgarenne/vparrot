<?php

namespace App\Form;

use App\Entity\Cars;
use App\Entity\Models;
use App\Entity\Types;
use App\Entity\Pictures;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;


class CarsType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('price', NumberType::class, [
                'label' => 'prix',
            ])
            ->add('year', DateType::class, [
                'widget' => 'choice',
            ])
            ->add('km')
            ->add('motor', ChoiceType::class, [
                'choices' => [
                    'Essence' => 'Essence',
                    'Diesel' => 'Diesel',
                    'Hybride' => 'Hybride',
                    'Electrique' => 'Electrique',
                    'GPL' => 'GPL',
                    'Autre' => 'Autre'
                ]
            ])
            ->add('power')
            ->add('color', ChoiceType::class, [
                'choices' => [
                    'blanc' => 'blanc',
                    'noir' => 'noir',
                    'pourpre' => 'pourpre',
                    'rouge' => 'rouge',
                    'orange' => 'orange',
                    'jaune' => 'jaune',
                    'vert' => 'vert',
                    'bleu' => 'bleu',
                    'violet' => 'violet',
                    'crème' => 'crème',
                    'beige' => 'beige',
                    'rose' => 'rose',
                    'kaki' => 'kaki',
                    'brun' => 'brun',
                    'marron' => 'marron',
                    'bordeaux' => 'bordeaux'
                ]
            ])
            ->add(
                'type',
                EntityType::class,
                [
                    'class' => Types::class,
                    'choice_label' => 'name',
                    'label' => 'Types',
                    'attr' => ['class' => 'form-control'],
                ]
            )
            ->add(
                'model',
                EntityType::class,
                [
                    'class' => Models::class,
                    'choice_label' => 'name',
                    'group_by' => function (Models $model) {
                        $brand = $model->getBrand();
                        return $brand->getName();
                    },
                    'label' => 'modèle',
                    'attr' => ['class' => 'form-control'],
                ]
            )
            ->add(
                'pictures',
                FileType::class,
                [
                    'multiple' => true,
                    'mapped' => false,
                    'required' => false
                ]
            );
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Cars::class,
        ]);
    }
}
