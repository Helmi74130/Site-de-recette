<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\CallbackTransformer;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\IsTrue;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints as Assert;

class RegistrationFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', TextType::class, [
                'label'=> 'Nom *',
                'attr' => [
                    'minlength' => '2',
                    'maxlength' => '50'
                ]
            ])
            ->add('firstname', TextType::class, [
                'label'=> 'Prénom *',
                'attr' => [
                    'minlength' => '2',
                    'maxlength' => '50'
                ]
            ])
            ->add('allergens', ChoiceType::class, [
                'label'=> 'Allergènes *',
                'multiple' => true,
                'expanded'=> false,
                'choices'  => [
                    'Aucunes allergies' => null,
                    'Gluten' => 'gluten',
                    'Oeufs' => 'oeufs',
                    'Crustacés' => 'crustacés',
                    'Arachides' => 'arachides',
                    'Soja' => 'soja',
                    'Lactose' => 'lactose',
                    'Fruits à coques' => 'fruits à coques',
                    'Céleri' => 'céleri',
                    'Moutarde' => 'moutarde'
                ],
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
            ->add('city', TextType::class, [
                'label' => 'Ville',
                'attr' => [
                    'minlength' => '0',
                    'maxlength' => '150'
                ]
            ])
            ->add('agreeTerms', CheckboxType::class, [
                'label' => 'Accepter nos termes',
                'mapped' => false,
                'constraints' => [
                    new IsTrue([
                        'message' => 'Vous devez accepter les termes pour continuer',
                    ]),
                ],
            ])
            ->add('plainPassword', PasswordType::class, [
                'label' => 'Mot de passe *',
                'mapped' => false,
                'attr' => ['autocomplete' => 'new-password'],
                'constraints' => [
                    new NotBlank([
                        'message' => 'Entrer un mot de passe',
                    ]),
                    new Length([
                        'min' => 6,
                        'minMessage' => 'Votre mot de passe doit contenir au moins {{ limit }} caractères',
                        'max' => 4096,
                    ]),
                ],
            ])
        ;
        $builder->get('allergens')
            ->addModelTransformer(new CallbackTransformer(
                function ($allergensAsString) {
                    // transform the string back to an array
                    return explode(', ', $allergensAsString);
                },
                function ($allergensAsArray) {
                    // transform the array to a string
                    return implode(', ', $allergensAsArray);
                }
            ));
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
