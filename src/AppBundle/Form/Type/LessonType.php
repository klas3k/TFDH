<?php

namespace AppBundle\Form\Type;


use AppBundle\Entity\Instructor;
use AppBundle\Entity\Training;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TimeType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class LessonType extends AbstractType
{
    public function __construct()
    {

    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'readOnly' => false,
            'data_class' => 'AppBundle\Entity\Lesson',
        ));
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('time', TimeType::class)
            ->add('date', DateType::class, [
                'data' => new \DateTime(),
            ])
            ->add('location', TextType::class)
            ->add('max_persons', NumberType::class)
            ->add('trainings', EntityType::class, [
                'class' => Training::class])
            ->add('instuctor', EntityType::class, [
                'class' => Instructor::class])
        ;
        if (!$options['readOnly']) {
            $builder->add('save', SubmitType::class, [
                'label' => 'Opslaan',
            ]);
        }
    }
}