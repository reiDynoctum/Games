<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Email;
use Symfony\Component\Validator\Constraints\NotBlank;

class ContactType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', TextType::class, [
                'label' => 'Jméno',
                'mapped' => false,
                'constraints' => [
                    new NotBlank(message: 'Toto pole je povinné.')
                ]
            ])
            ->add('email', EmailType::class, [
                'label' => 'Email',
                'mapped' => false,
                'constraints' => [
                    new NotBlank(message: 'Toto pole je povinné.'),
                    new Email(message: 'Zadejte email ve správném formátu.')
                ]
            ])
            ->add('message', TextareaType::class, [
                'label' => 'Text zprávy',
                'mapped' => false,
                'constraints' => [
                    new NotBlank(message: 'Toto pole je povinné.')
                ]
            ])
            ->add('submit', SubmitType::class, ['label' => 'Odeslat'])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            // Configure your form options here
        ]);
    }
}
