<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Length;

class UpdatePasswordType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add(
                'password',
                RepeatedType::class,
                [
                    'type' => PasswordType::class,
                    'invalid_message' => 'Heslo a Heslo znovu se neshodují.',
                    'required' => true,
                    'mapped' => false,
                    'first_options' => [
                        'label' => 'Heslo',
                        'constraints' => [
                            new Length(min: 6, minMessage: 'Heslo musí mít alespoň {{ limit }} znaky.')
                        ]
                    ],
                    'second_options' => ['label' => 'Heslo znovu']
                ]
            )
            ->add(
                'submit',
                SubmitType::class,
                ['label' => 'Změnit heslo']
            );
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            // Configure your form options here
        ]);
    }
}
