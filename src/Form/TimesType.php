<?php

namespace App\Form;

use App\Entity\Times;
use App\Entity\Workshops;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TimeType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraint;

class TimesType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('day', ChoiceType::class, [
                'choices' => [
                    'lundi' => 'lundi',
                    'mardi' => 'mardi',
                    'mercredi' => 'mercredi',
                    'jeudi' => 'jeudi',
                    'vendredi' => 'vendredi',
                    'samedi' => 'samedi',
                    'dimanche' => 'dimanche',
                ],
            ])
            ->add('open_am', TimeType::class, [
                'widget' => 'choice',
                'placeholder' => [
                    'hour' => 'Hour', 'minute' => 'Minute',
                ],
            ])
            ->add('close_am', TimeType::class, [
                'widget' => 'choice',
                'placeholder' => [
                    'hour' => 'Hour', 'minute' => 'Minute',
                ],
            ])
            ->add('open_pm', TimeType::class, [
                'widget' => 'choice',
                'placeholder' => [
                    'hour' => 'Hour', 'minute' => 'Minute',
                ],
            ])
            ->add('close_pm', TimeType::class, [
                'widget' => 'choice',
                'placeholder' => [
                    'hour' => 'Hour', 'minute' => 'Minute',
                ],
            ])
            ->add(
                'workshops',
                EntityType::class,
                [
                    'class' => Workshops::class,
                    'choice_label' => 'name',
                    'label' => 'Magasin',
                    'attr' => ['class' => 'form-control'],
                ]
            );
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Times::class,
        ]);
    }
}
