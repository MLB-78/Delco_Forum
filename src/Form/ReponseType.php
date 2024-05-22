<?php

namespace App\Form;

use App\Entity\Reponses;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class ReponseType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('messageR', TextareaType::class, [
                'label' => 'Votre réponse',
            ])
            ->add('dateN', null, [
                'label' => 'Date',
                'data' => new \DateTime(), 
                'disabled' => true, 
            ])
            ->add('submit', SubmitType::class, [
                'label' => 'Répondre',
                'attr' => ['class' => 'btn btn-primary'],
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Reponses::class,
        ]);
    }
}
