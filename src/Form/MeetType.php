<?php

namespace App\Form;

use App\Entity\Meet;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TelType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TimeType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints as Assert;

class MeetType extends AbstractType
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
            ->add('phone', TelType::class, [
                'label'=> 'Numéro de téléphone *',
            ])
            ->add('date', DateType::class,[
                'label'=> 'Date du rendez-vous souhaitez *'
            ])
            ->add('time', TimeType::class, [
                'label'=> 'Heure du rendez-vous souhaitez *'
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
            ->add('subject', TextareaType::class, [
                'label' => 'Raison de votre consultation *',
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
            'data_class' => Meet::class,
        ]);
    }
}
