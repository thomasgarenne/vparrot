<?php

namespace App\Form;

use App\Data\SearchData;
use App\Entity\Brands;
use App\Entity\Models;
use App\Entity\Types;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\ResetType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class SearchType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('brands', EntityType::class, [
                'label' => false,
                'choice_label' => 'name',
                'required' => false,
                'class' => Brands::class,
                'expanded' => true,
                'multiple' => true,
                'attr' => [
                    'placeholder' => 'Constructeurs',
                ]
            ])
            ->add('models', EntityType::class, [
                'label' => false,
                'choice_label' => 'name',
                'required' => false,
                'class' => Models::class,
                'expanded' => true,
                'multiple' => true,
                'attr' => [
                    'placeholder' => 'Modèles'
                ]
            ])
            ->add('types', EntityType::class, [
                'label' => false,
                'choice_label' => 'name',
                'required' => false,
                'class' => Types::class,
                'expanded' => true,
                'multiple' => true,
                'attr' => [
                    'placeholder' => 'Types'
                ]
            ])
            ->add('priceMin', NumberType::class, [
                'label' => false,
                'required' => false,
                'attr' => [
                    'placeholder' => 'Prix min'
                ]
            ])
            ->add('priceMax', NumberType::class, [
                'label' => false,
                'required' => false,
                'attr' => [
                    'placeholder' => 'Prix max'
                ]
            ])
            ->add('kmMin', NumberType::class, [
                'label' => false,
                'required' => false,
                'attr' => [
                    'placeholder' => 'Km min'
                ]
            ])
            ->add('kmMax', NumberType::class, [
                'label' => false,
                'required' => false,
                'attr' => [
                    'placeholder' => 'Km max'
                ]
            ])
            ->add('reset', ResetType::class);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => SearchData::class,
            'method' => 'GET',
            'csrf_protection' => false
        ]);
    }

    public function getBlockPrefix()
    {
        return '';
    }
}
