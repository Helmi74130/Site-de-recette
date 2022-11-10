<?php

namespace App\Form;

use App\Entity\Contact;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints as Assert;

class ContactType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', TextType::class, [
                'label'=> 'Nom et Prénom *',
                'attr' => [
                    'minlength' => '2',
                    'maxlength' => '150'
                ]
            ])
            ->add('email', EmailType::class, [
                'label' => 'E-mail *',
                'attr' => [
                    'minlength' => '2',
                    'maxlength' => '180'
                ],
                'constraints' => [
                    new Assert\NotBlank(),
                    new Assert\Email(),
                    new Assert\Length(['min' =>2, 'max' => '180'])
                ]
            ])
            ->add('subject', TextType::class, [
                'label' => 'Sujet *',
                'attr' => [
                    'minlength' => '5',
                    'maxlength' => '255'
                ]
            ])
            ->add('message', TextareaType::class, [
                'label' => 'Message *',
                'attr' => [
                    'minlength' => '5',
                    'maxlength' => '5000'
                ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Contact::class,
        ]);
    }
}
