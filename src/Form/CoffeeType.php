<?php

namespace App\Form;

use App\Entity\Coffee;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CoffeeType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('GrowthHeight')
            ->add('Rainfall')
            ->add('AverageGrowingTemperature')
            ->add('AverageHeightCoffeeTree')
            ->add('GrainSize')
            ->add('KindOfCoffeeTree')
            ->add('AveragePricePerKilogram')
            ->add('EvaluationCQL')
            ->add('CaffeineContent')
            ->add('Density')
            ->add('Kislotnost')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Coffee::class,
        ]);
    }
}
