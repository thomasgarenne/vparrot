<?php

namespace App\Form;

use App\Entity\Cars;
use App\Entity\Models;
use App\Entity\Types;
use DateTime;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Positive;
use Symfony\Component\Validator\Constraints\PositiveOrZero;



class CarsType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $now = new DateTime();
        $format = $now->format('Y');

        $builder
            ->add('price', MoneyType::class, [
                'label' => 'prix',
                'constraints' => new PositiveOrZero([], 'Vous devez entrer un nombre positif')
            ])
            ->add('year', DateType::class, [
                'label' => 'Année de mise en circulation',
                'widget' => 'choice',
                'years' => range($format, 1960),
            ])
            ->add('km', NumberType::class, [
                'constraints' => new PositiveOrZero([], 'Cette valeur devrait être positive')
            ])
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
            ->add('power', NumberType::class, [
                'label' => 'Puissance',
                'constraints' => new Positive([], 'Cette valeur devrait être positive')
            ])
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
            ])/*
            ->add(
                'type',
                EntityType::class,
                [
                    'class' => Types::class,
                    'choice_label' => 'name',
                    'label' => 'Types',
                    'attr' => ['class' => 'form-control'],
                ]
            )*/
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
                'doors',
                ChoiceType::class,
                [
                    'label' => 'Nombre de portes',
                    'choices' => [
                        "1" => "1",
                        "2" => "2",
                        "3" => "3",
                        "4" => "4",
                        "5" => "5",
                        "6 ou plus" => "6 ou plus",
                    ]
                ]
            )
            ->add(
                'seats',
                ChoiceType::class,
                [
                    'label' => 'Nombre de sièges',
                    'choices' => [
                        "1" => "1",
                        "2" => "2",
                        "3" => "3",
                        "4" => "4",
                        "5" => "5",
                        "6 ou plus" => "6 ou plus",
                    ]
                ]
            )
            ->add(
                'description',
                TextareaType::class,
                [
                    'label' => 'Description'
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
