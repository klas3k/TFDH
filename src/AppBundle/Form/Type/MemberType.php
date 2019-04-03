<?php

namespace AppBundle\Form\Type;


use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class MemberType extends AbstractType
{
    public function __construct()
    {
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'readOnly' => false,
            'register' => false,
            'data_class' => 'AppBundle\Entity\Member',
        ]);
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('firstname', TextType::class, [
                'required' => true,
                'label' => 'Voornaam',
                'disabled' => $options['readOnly']
            ])
            ->add('lastname', TextType::class, [
                'required' => true,
                'label' => 'Achternaam',
                'disabled' => $options['readOnly']
            ])
            ->add('dateofbirth', TextType::class, [
                'required' => true,
                'label' => 'Geboortedatum',
                'disabled' => $options['readOnly'],
                'attr' => ['class' => 'datepicker']
            ])
            ->add('gender', ChoiceType::class, [
                'choices' => [
                    'Man' => 'm',
                    'Vrouw' => 'v',
                    'Beide' => 'speshal',
                    'Geen' => 'geen',
                ],
                'placeholder' => 'Kies een geslacht',
                'label' => 'Geslacht',
                'disabled' => $options['readOnly']
            ])
            ->add('street', TextType::class, [
                'required' => true,
                'label' => 'Adres',
                'disabled' => $options['readOnly']
            ])
            ->add('postalcode', TextType::class, [
                'required' => true,
                'label' => 'Postcode',
                'disabled' => $options['readOnly']
            ])

            ->add('email', EmailType::class, [
                'required' => true,
                'label' => 'Email adres',
                'disabled' => $options['readOnly']
            ])
            ->add('password', PasswordType::class, [
                'required' => true,
                'label' => 'Wachtwoord',
                'disabled' => $options['readOnly']
            ])
        ;
        if (!$options['readOnly'] || $options['register']) {
            $builder
                ->add('register', SubmitType::class, [
                'label' => 'Registeren',
            ]);
        }
    }
}