<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\BirthdayType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormInterface as FormFormInterface;
use Symfony\Component\Form\Test\FormInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\IsTrue;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;

class RegistrationFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('email', EmailType::class, [
                'label' => 'Email'
            ])
            ->add('lastname', TextType::class, [
                'label' => 'Nom'
            ])
            ->add('firstname', TextType::class, [
                'label' => 'Prénom'
            ])
            ->add('civility', ChoiceType::class, [
                'label' => 'Sexe',
                'choices' => [
                    'Homme' => 'Homme',
                    'Femme' => 'Femme',
                ]
            ])
            ->add('birthday', BirthdayType::class, [
                'label' => '📅 Date de naissance',
                'widget' => 'single_text',
                // this is actually the default format for single_text
                'format' => 'yyyy-MM-dd'
                ]
            )
            // ->add('createdAt')
            ->add('password', PasswordType::class, [
                // instead of being set onto the object directly,
                // this is read and encoded in the controller
                'label' => '🔐 Mot de passe',
                'mapped' => false,
                'attr' => ['autocomplete' => 'new-password'],
                'constraints' => [
                    new NotBlank([
                        'message' => 'Ce champ ne peut pas être vide.',
                        'groups' => ['registration']
                    ]),
                    new Length([
                        'groups' => ['registration'],
                        'min' => 6,
                        'minMessage' => 'Your password should be at least {{ limit }} characters',
                        // max length allowed by Symfony for security reasons
                        'max' => 4096,
                    ]),
                ],
            ])
            
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
            'validation_groups' => function (FormFormInterface $form) {
                $data = $form->getData();
                if(!$data->getId() || $form->get('password')->getData())
                    return ['registration'];

                return [];
            }
        ]);
    }
}
