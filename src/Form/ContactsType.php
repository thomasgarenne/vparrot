<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TelType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Length;

class ContactsType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('email', EmailType::class)
            ->add('phone', TelType::class)
            ->add('prenom', TextType::class, [
                'constraints' =>
                new Length([], 2, 30, null, null, null, null, 'Vous devez rentrer au moins {{ limit }} caractères', 'Vous devez rentrer moins de {{ limit }} caractères'),
            ])
            ->add('nom', TextType::class, [
                'constraints' =>
                new Length([], 2, 30, null, null, null, null, 'Vous devez rentrer au moins {{ limit }} caractères', 'Vous devez rentrer moins de {{ limit }} caractères'),
            ])
            ->add('message', TextareaType::class, [
                'constraints' =>
                new Length([], 10, 300, null, null, null, null, 'Vous devez rentrer au moins {{ limit }} caractères', 'Vous devez rentrer moins de {{ limit }} caractères'),
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            // Configure your form options here
        ]);
    }
}
