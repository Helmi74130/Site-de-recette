<?php

namespace App\Form;

use App\Entity\Comment;
use Karser\Recaptcha3Bundle\Form\Recaptcha3Type;
use Karser\Recaptcha3Bundle\Validator\Constraints\Recaptcha3;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;

class CommentType extends AbstractType
{
    private $token;

    public function __construct(TokenStorageInterface $token)
    {
        $this->token = $token;
    }


    public function buildForm(FormBuilderInterface $builder, array $options): void
    {

        $user = $this->token->getToken()?->getUser();



        $builder
            ->add('message', TextareaType::class, [
                'attr' => [
                    'minlength' => '5',
                    'maxlength' => '5000'
                ]
            ])
            ->add('captcha', Recaptcha3Type::class, [
                'constraints' => new Recaptcha3(),
                'action_name' => 'inscription',
                'locale' => 'fr',
            ])
        ;
        if (!$user){
            $builder->add('user', TextType::class, [
                'label'=> 'Pseudo',
                'attr' => [
                    'minlength' => '2',
                    'maxlength' => '150'
                ]
            ]);
            }
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Comment::class,
        ]);
    }
}
