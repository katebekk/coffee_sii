<?php

namespace App\Form;

use App\Entity\CoffeeSort;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CoffeeSortType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name')
            ->add('quanFeatureValues', CollectionType::class, [
                'entry_type' => QuanFeatureValueType::class,
                'entry_options' => ['label' => false],
            ])
            ->add('countFeatureValues', CollectionType::class, [
                'entry_type' => CountFeatureValueType::class,
                'entry_options' => ['label' => false],
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => CoffeeSort::class,
        ]);
    }
}
