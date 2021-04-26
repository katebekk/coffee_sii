<?php

namespace App\Form;

use App\Entity\CountFeatureValue;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CountFeatureValueType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('feature',TextType::class, [
                'label' => false,
                'disabled' => true,
            ])
            ->add('min',null, ['label' => 'От'])
            ->add('max',null, ['label' => 'До'])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => CountFeatureValue::class,
        ]);
    }
}
