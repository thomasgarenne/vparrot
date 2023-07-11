<?php

namespace App\Form;

use App\Entity\Comments;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Length;

class CommentsType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('firstname', TextType::class, [
                'label' => 'Prénom',
                'required' => true,
                'constraints' =>
                new Length([], 2, 30, null, null, null, null, 'Vous devez rentrer au moins {{ limit }} caractères', 'Vous devez rentrer moins de {{ limit }} caractères'),
            ])
            ->add('lastname', TextType::class, [
                'label' => 'Nom',
                'required' => true,
                'constraints' =>
                new Length([], 2, 30, null, null, null, null, 'Vous devez rentrer au moins {{ limit }} caractères', 'Vous devez rentrer moins de {{ limit }} caractères'),
            ])
            ->add('content', TextType::class, [
                'label' => 'Message',
                'required' => true,
                'constraints' =>
                new Length([], 10, 200, null, null, null, null, 'Vous devez rentrer au moins {{ limit }} caractères', 'Vous devez rentrer moins de {{ limit }} caractères'),
            ])
            ->add('note', ChoiceType::class, [
                'choices' => [
                    1 => 1,
                    2 => 2,
                    3 => 3,
                    4 => 4,
                    5 => 5,
                ]
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Comments::class,
        ]);
    }
}
