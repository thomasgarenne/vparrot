<?php

namespace App\Form;

use App\Entity\Brands;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;


class BrandsType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            /* Pour ajout manuel des constructeurs, délaissé pour utilisation API
            ->add('name', TextType::class, [
                'required' => true,
                'attr' => [
                    'class' => 'form-control'
                ],
                'label' => 'Nom',
            ])
            */
            ->add('name', ChoiceType::class, [
                'choices' => $options['marques'],
                'placeholder' => 'Sélectionnez un constructeur',
                'attr' => [
                    'class' => 'form-control constructeur-select'
                ],
                'label' => 'Constructeur',
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Brands::class,
            'marques' => []
        ]);
    }
}
