<?php

namespace App\Form;

use App\Entity\Models;
use App\Entity\Brands;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ModelsType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            /* AJOUT MANUEL DES MODELES
            ->add('name', TextType::class, [
                'required' => true,
                'attr' => [
                    'class' => 'form-control'
                ],
                'label' => 'Nom'
                ])
            */
            ->add(
                'brand',
                EntityType::class,
                [
                    'class' => Brands::class,
                    'choice_label' => 'name',
                    'label' => 'Marque',
                    'attr' => ['class' => 'form-control constructeur-select'],
                    'placeholder' => 'Sélectionnez un constructeur',
                ]
            )
            ->add('name', ChoiceType::class, [
                'choices' => $options['modele'],
                'placeholder' => 'Sélectionnez un modèle',
                'required' => true,
                'attr' => [
                    'class' => 'form-control modele-select',
                    'style' => 'display : none',
                ],
                'label' => 'Modèle'
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Models::class,
            'modele' => [],
        ]);
    }
}
