<?php

namespace App\Form;

use App\Entity\Services;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;

class ServicesType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', TextType::class, [
                'label' => 'Nom',
                'constraints' => new Length(null, 2, 30, null, null, null, null,  'Vous devez rentrer au moins {{ limit }} caractères', 'Vous devez rentrer moins de {{ limit }} caractères'),
            ])
            ->add('description', TextType::class, [
                'constraints' => new Length(null, 10, 300, null, null, null, null,  'Vous devez rentrer au moins {{ limit }} caractères', 'Vous devez rentrer moins de {{ limit }} caractères'),
            ]);
        //->add('picture');
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Services::class,
        ]);
    }
}
