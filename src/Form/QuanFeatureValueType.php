<?php

namespace App\Form;

use App\Entity\QuanFeatureValue;
use App\Entity\QuanFeature;
use App\Entity\QuanPossibleValues;
use App\Repository\QuanPossibleValuesRepository;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;

class QuanFeatureValueType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('feature', TextType::class, [
                'label' => false,
                'disabled' => true,
            ])
            ->add('featureValues', EntityType::class, [
                'class' => 'App\Entity\QuanPossibleValues',
                'choice_label' => 'name',
                'multiple'=>true,
                'expanded' => true,
                'label' => false,
//                'query_builder' => function (QuanPossibleValuesRepository $er) use($options) {
//                    return $er->createQueryBuilder('q')
//                        ->andWhere('q.id = :val')
//                        ->setParameter('val', $options['feature']->getName());
//
//                },
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => QuanFeatureValue::class,
            'feature' => QuanFeature::class,
        ]);
    }
}
