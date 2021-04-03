<?php

namespace App\Form;

use App\Entity\Coffee;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class Coffee1Type extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('growthHeight')
            ->add('rainfall')
            ->add('averageGrowingTemperature')
            ->add('averageHeightCoffeeTree')
            ->add('grainSize')
            ->add('kindOfCoffeeTree')
            ->add('averagePricePerKilogram')
            ->add('evaluationCQL')
            ->add('caffeineContent')
            ->add('density')
            ->add('kislotnost')
            ->add('growthHeightMin')
            ->add('growthHeightMax')
            ->add('rainfallMin')
            ->add('rainfallMax')
            ->add('growingTemperatureMin')
            ->add('growingTemperatureMax')
            ->add('averageHeightCoffeeTreeMin')
            ->add('averageHeightCoffeeTreeMax')
            ->add('grainSizeMin')
            ->add('grainSizeMax')
            ->add('averagePricePerKilogramMin')
            ->add('averagePricePerKilogramMax')
            ->add('evaluationCQLMin')
            ->add('evaluationCQLMax')
            ->add('caffeineContentMin')
            ->add('class')
            ->add('regionOfOrigin')
            ->add('climaticZone')
            ->add('methodOfProcessing')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Coffee::class,
        ]);
    }
}
