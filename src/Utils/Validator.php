<?php

namespace App\Utils;

use App\Entity\CoffeeSort;
use App\Repository\CoffeeSortRepository;
use App\Repository\CountFeatureValueRepository;
use App\Repository\QuanFeatureValueRepository;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;


class Validator
{
    private $coffeeSortRepository;
    private $countFeatureValueRepository;
    private $quanFeatureValueRepository;
    private $urlGenerator;


    public function __construct(
        CoffeeSortRepository $coffeeSortRepository,
        CountFeatureValueRepository $countFeatureValueRepository,
        QuanFeatureValueRepository $quanFeatureValueRepository,
        UrlGeneratorInterface $urlGenerator
    )
    {
        $this->coffeeSortRepository = $coffeeSortRepository;
        $this->countFeatureValueRepository = $countFeatureValueRepository;
        $this->quanFeatureValueRepository = $quanFeatureValueRepository;
        $this->urlGenerator = $urlGenerator;
    }

    public function validate(): array
    {
        $result = [];
        foreach ($this->coffeeSortRepository->findAll() as $coffeeSort) {
            if ($coffeeSort->getQuanFeatures()->isEmpty() and $coffeeSort->getCountFeatures()->isEmpty()) {
                $result[$coffeeSort->getName()] = [
                    "У сорта \"$coffeeSort\" отсутствуют признаки",
                    $this->urlGenerator->generate('features_of_sort_edit', [
                        'id' => $coffeeSort->getId()
                    ])
                ];
            }
        }
        foreach ($this->coffeeSortRepository->findAll() as $coffeeSort) {
            foreach ($coffeeSort->getQuanFeatures() as $feature) {
                $value = $this->quanFeatureValueRepository->findOneBy(['feature' => $feature, 'coffeeSort' => $coffeeSort]);
                if (!$value) {
//                    or $value->getFeatureValues()->isEmpty()
                    $result[$coffeeSort->getName()] = [
                        "У сорта \"$coffeeSort\" для признака \"$feature\" отсутствует значение",
                        $this->urlGenerator->generate('value_of_quan_feature_edit', [
                            'sortId' => $coffeeSort->getId(),
                            'featureId' => $feature->getId()
                        ])
                    ];
                }
            }
            foreach ($coffeeSort->getCountFeatures() as $feature) {
                $value = $this->countFeatureValueRepository->findOneBy(['feature' => $feature, 'coffeeSort' => $coffeeSort]);
                if (!$value) {
                    $result[$coffeeSort->getName()] = [
                        "У сорта \"$coffeeSort\" для признака \"$feature\" отсутствует значение",
                        $this->urlGenerator->generate('value_of_count_feature_edit', [
                            'sortId' => $coffeeSort->getId(),
                            'featureId' => $feature->getId()
                        ])
                    ];
                }
            }
        }

        return $result;

    }
}