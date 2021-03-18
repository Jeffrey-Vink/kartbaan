<?php

namespace App\Form;

use App\Entity\Activiteit;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ActiviteitType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('datum')
            ->add('tijd')
            ->add('soort', EntityType::class, [
                'class' => 'App:Soortactiviteit',
                'choice_label' => 'naam',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Activiteit::class,
        ]);
    }
}
