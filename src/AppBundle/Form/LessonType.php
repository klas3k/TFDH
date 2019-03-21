<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use AppBundle\Entity\Lesson;
use AppBundle\Entity\Training;
use AppBundle\Entity\Instructor;

class LessonType extends AbstractType {

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('training', EntityType::class, ["class" => Training::class])
            ->add('instructor', EntityType::class, ["class" => Instructor::class])
            ->add('time', DateTimeType::class)
            ->add('location', TextType::class)
            ->add('max_people', IntegerType::class)
            ->add('save', SubmitType::class, ["label" => "Save"]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Lesson::class,
        ]);
    }
}
