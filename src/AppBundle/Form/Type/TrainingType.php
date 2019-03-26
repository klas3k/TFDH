<?php

namespace AppBundle\Form\Type;


use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class TrainingType extends AbstractType
{
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'readOnly' => false,
            'data_class' => 'AppBundle\Entity\Training',
        ));
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', TextType::class, [
                'required' => true,
                'label' => 'Naam',
                'disabled' => $options['readOnly'],
            ])
            ->add('description', TextType::class, [
                'required' => true,
                'label' => 'Omschrijving',
                'disabled' => $options['readOnly'],
            ])
            ->add('duration', NumberType::class, [
                'required' => true,
                'label' => 'Hoe lang de les duurt in minuten',
                'disabled' => $options['readOnly'],
            ])
            ->add('costs', NumberType::class, [
                'required' => true,
                'label' => 'Kosten',
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