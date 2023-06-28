<?php

namespace App\Form;

use App\Entity\Types;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class TypesType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', ChoiceType::class, [
                'choices' => [
                    '4x4, Suv' => '4x4, Suv',
                    'Berline' => 'Berline',
                    'Break' => 'Break',
                    'Cabriolet' => 'Cabriolet',
                    'Citadine' => 'Citadine',
                    'Coupé' => 'Coupé',
                    'Minibus' => 'Minibus',
                    'Monospace' => 'Monospace',
                    'Pick-up' => 'Pick-up',
                    'Voiture sociéte' => 'Voiture sociéte',
                    'Autre' => 'Autre'
                ]
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Types::class,
        ]);
    }
}
