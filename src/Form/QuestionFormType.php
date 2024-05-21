<?php

// src/Form/QuestionFormType.php

namespace App\Form;

use App\Entity\Questions;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class QuestionFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('message', TextareaType::class, [
                'label' => 'Votre question',
                'attr' => ['rows' => 5],
            ])
            // Add the dateN field, but don't make it editable
            ->add('dateN', null, [
                'label' => 'Date',
                'data' => new \DateTime(), // Set default value to current date
                'disabled' => true, // Make the field disabled
            ])
            ->add('submit', SubmitType::class, [
                'label' => 'Poser',
                'attr' => ['class' => 'btn btn-primary'],
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Questions::class,
        ]);
    }
}
