<?php

namespace App\Form;

use App\Entity\Times;
use App\Entity\Workshops;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class TimesType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('day')
            ->add('open_am')
            ->add('close_am')
            ->add('open_pm')
            ->add('close_pm')
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
