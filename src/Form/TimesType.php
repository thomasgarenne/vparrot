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
use Symfony\Component\Validator\Constraints\GreaterThan;
use Symfony\Component\Validator\Constraints\LessThan;

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
                'label' => 'Ouverture matin',
                'widget' => 'choice',
                'placeholder' => [
                    'hour' => 'Hour', 'minute' => 'Minute',
                ],
                'constraints' => new LessThan([
                    'propertyPath' => 'parent.all[close_am].data',
                    'message' => 'Cette valeur ne peux pas être plus grande que la fermeture du matin'
                ])
            ])
            ->add('close_am', TimeType::class, [
                'label' => 'Fermeture matin',
                'widget' => 'choice',
                'placeholder' => [
                    'hour' => 'Hour', 'minute' => 'Minute',
                ],
                'constraints' => new LessThan([
                    'propertyPath' => 'parent.all[open_pm].data',
                    'message' => 'Cette valeur ne peux pas être plus grande que l\'horaire d\'ouverture de l\'après-midi'
                ])
            ])
            ->add('open_pm', TimeType::class, [
                'label' => 'Ouverture soir',
                'widget' => 'choice',
                'placeholder' => [
                    'hour' => 'Hour', 'minute' => 'Minute',
                ],
                'constraints' => new LessThan([
                    'propertyPath' => 'parent.all[close_pm].data',
                    'message' => 'Cette valeur ne peux pas être plus grande que l\'horaire de fermeture'
                ])
            ])
            ->add('close_pm', TimeType::class, [
                'label' => 'Fermeture soir',
                'widget' => 'choice',
                'placeholder' => [
                    'hour' => 'Hour', 'minute' => 'Minute',
                ],
                'constraints' => new GreaterThan([
                    'propertyPath' => 'parent.all[open_am].data',
                    'message' => 'Cette valeur ne peux pas être plus petite que la réouverture'
                ])
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Times::class,
        ]);
    }
}
