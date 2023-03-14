<?php

namespace App\Form;

use App\Entity\Order;
use App\Entity\Room;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TelType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\GreaterThanOrEqual;

class OrderType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('startAt', DateType::class, [
                'label' => 'Arrivée',
                'widget' => 'single_text',
                // this is actually the default format for single_text
                'format' => 'yyyy-MM-dd',
                'invalid_message' => 'La date ne peut pas être antérieure à aujourd\'hui',
                'constraints' => [
                    new GreaterThanOrEqual([
                        'value' => 'today',
                        'message' => 'La date ne peut pas être antérieure à aujourd\'hui'
                    ])
                ]
            ])
            ->add('endAt', DateType::class, [
                'label' => 'Départ',
                'widget' => 'single_text',
                // this is actually the default format for single_text
                'format' => 'yyyy-MM-dd',
                'invalid_message' => 'La date ne peut pas être antérieure à aujourd\'hui',
            ])
            // ->add('total')
            ->add('civility', ChoiceType::class, [
                'label' => 'Civilité',
                'choices' => [
                    'Mr' => 'Mr',
                    'Mme' => 'Mme'
                ]
            ])
            ->add('lastname', TextType::class, [
                'label' => 'Nom'
            ])
            ->add('firstname' , TextType::class, [
                'label' => 'Prénom'
            ])
            ->add('phone', TelType::class, [
                'label' => 'Téléphone'
            ])
            ->add('email', EmailType::class, [
                'label' => 'Email'
            ])
            // ->add('createdAt')
            ->add('rooms', EntityType::class, [
                'label' => 'Sélectionner une chambre',
                'class' => Room::class,
                'choice_label' => 'title'
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Order::class,
        ]);
    }
}
