<?php

namespace AppBundle\Form\Type;


use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class InstructorType extends AbstractType
{
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'readOnly' => false
        ));
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('firstname', TextType::class, [
                'required' => true,
                'label' => 'Voornaam',
                'disabled' => $options['readOnly'],
            ])
            ->add('lastname', TextType::class, [
                'required' => true,
                'label' => 'Achternaam',
                'disabled' => $options['readOnly'],
            ])
            ->add('dateofbirth', DateType::class, [
                'required' => true,
                'label' => 'Geboortedatum',
                'disabled' => $options['readOnly'],
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
                'disabled' => $options['readOnly'],
            ])
            ->add('hiringdate', DateType::class, [
                'required' => true,
                'label' => 'Datum van aanname',
                'disabled' => $options['readOnly'],
            ])
            ->add('salary', NumberType::class, [
                'required' => true,
                'label' => 'Salaris',
                'disabled' => $options['readOnly'],
            ])
        ;
       if (!$options['readOnly']) {
           $builder->add('save', SubmitType::class, [
               'label' => 'Opslaan',
           ]);
       }
    }
}