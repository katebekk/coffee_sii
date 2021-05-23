<?php

namespace App\Controller;

use App\Entity\QuanFeature;
use App\Entity\CountFeature;
use App\Form\QuanFeatureType;
use App\Entity\CoffeeSort;
use App\Repository\CoffeeSortRepository;
use App\Repository\QuanFeatureRepository;
use App\Repository\CountFeatureRepository;
use App\Repository\CountPossibleValuesRepository;
use App\Repository\QuanPossibleValuesRepository;
use App\Repository\QuanFeatureValueRepository;
use App\Repository\CountFeatureValueRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use App\Utils\Validator;

class DefineSortController extends AbstractController
{
    private $coffeeSortRepository;
    private $quanFeatureRepository;
    private $countFeatureRepository;
    private $countPossibleValuesRepository;
    private $quanPossibleValuesRepository;
    private $countFeatureValueRepository;
    private $quanFeatureValueRepository;
    private $validator;

    public function __construct(
        CoffeeSortRepository $coffeeSortRepository,
        CountFeatureRepository $countFeatureRepository,
        QuanFeatureRepository $quanFeatureRepository,
        CountPossibleValuesRepository $countPossibleValuesRepository,
        QuanPossibleValuesRepository $quanPossibleValuesRepository,
        CountFeatureValueRepository $countFeatureValueRepository,
        QuanFeatureValueRepository $quanFeatureValueRepository,
        Validator $validator

    )
    {
        $this->coffeeSortRepository = $coffeeSortRepository;
        $this->quanFeatureRepository = $quanFeatureRepository;
        $this->countFeatureRepository = $countFeatureRepository;
        $this->countPossibleValuesRepository = $countPossibleValuesRepository;
        $this->quanPossibleValuesRepository = $quanPossibleValuesRepository;
        $this->countFeatureValueRepository = $countFeatureValueRepository;
        $this->quanFeatureValueRepository = $quanFeatureValueRepository;
        $this->validator = $validator;
    }

    /**
     * @Route("/define_sort/features", name="define_sort_features", methods={"GET","POST"})
     */
    public function features(Request $request): Response
    {
        if ($request->request->has('submit')) {
            $quanFeaturesId = $request->request->get('quanFeatures');
            $countFeaturesId = $request->request->get('countFeatures');
            $quanFeatures = array();
            $countFeatures = array();
            if ($quanFeaturesId) {
                foreach ($quanFeaturesId as $fid) {
                    $feature = $this->quanFeatureRepository->findOneBy(['id' => $fid]);
                    $quanFeatures[] = $feature;
                }
            }
            if ($countFeaturesId) {
                foreach ($countFeaturesId as $fid) {
                    $feature = $this->countFeatureRepository->findOneBy(['id' => $fid]);
                    $countFeatures[] = $feature;
                }
            }
            $this->getDoctrine()->getManager()->flush();

            return $this->render('define_sort/values.html.twig', [
                'quanFeatures' => $quanFeatures,
                'countFeatures' => $countFeatures,
                'quanPossibleValues' => $this->quanPossibleValuesRepository->findAll(),
                'countPossibleValues' => $this->countPossibleValuesRepository->findAll()
            ]);
        }

        return $this->render('define_sort/edit.html.twig', [
            'quanFeatures' => $this->quanFeatureRepository->findAll(),
            'countFeatures' => $this->countFeatureRepository->findAll()
        ]);
    }

    /**
     * @Route("/define_sort/values", name="define_sort_values", methods={"GET","POST"})
     */
    public function values(Request $request): Response
    {
        if ($request->request->has('submit')) {
            $explain = [];
            $similarity = [];
            $quanValues = [];
            $countValues = [];
            $countFeaturesId = null;

            $coffeeSorts = $this->coffeeSortRepository->findAll();

            $countFeatures = $this->countFeatureRepository->findAll();
            $quanFeatures = $this->quanFeatureRepository->findAll();
            $notValidItem = array_keys($this->validator->validate());

            $quanFeatures = $this->deleteNotValid($quanFeatures, $notValidItem);
            $countFeatures = $this->deleteNotValid($countFeatures, $notValidItem);
            $coffeeSorts = $this->deleteNotValid($coffeeSorts, $notValidItem);


            $quanFeaturesValuesId = $request->request->get('quanFeatures');
            $countFeaturesValues = $request->request->get('val');
            if ($countFeaturesValues) $countFeaturesId = array_keys($countFeaturesValues);
            if ($quanFeaturesValuesId) {
                foreach ($quanFeaturesValuesId as $fid) {
                    $value = $this->quanPossibleValuesRepository->findOneBy(['id' => $fid]);
                    $quanValues[] = $value;
                }

            }
            if ($countFeaturesId) {
                foreach ($countFeaturesId as $fid) {
                    $feature = $this->countFeatureRepository->findOneBy(['id' => $fid]);
                    $value = $this->countPossibleValuesRepository->findOneBy(['feature' => $feature]);
                    $val = $countFeaturesValues[$fid];
                    if ($val >= $value->getMin() and $val <= $value->getMax()) {
                        $countValues[] = [$val, $feature];
                    }
                }

            }
            foreach ($this->coffeeSortRepository->findAll() as $coffeeSort) {
                $similarity[$coffeeSort->getName()] = 0;
                foreach ($quanValues as $quanPossValue) {
                    $coffeeSortValue = $this->quanFeatureValueRepository->findOneBy(['coffeeSort' => $coffeeSort,
                        'feature' => $quanPossValue->getFeature()]);
                    if ($coffeeSortValue) {
                        if (!$coffeeSortValue->getFeatureValues()->contains($quanPossValue)) {
                            $feature = $quanPossValue->getFeature();
                            $explain[$coffeeSort->getName()] = "Сорт не подходит, т.к. значение признака \"$feature\" - $quanPossValue не входит во множество значений данного признака.";
                            unset($coffeeSorts[array_search($coffeeSort,$coffeeSorts)]);
                        }
                    }else{
                        $feature = $quanPossValue->getFeature();
                        $explain[$coffeeSort->getName()] = "Сорт не подходит, т.к. признак \"$feature\" не задан у данного сорта";
                    }
                }
                foreach ($countValues as $countValue) {
                    $coffeeSortValue = $this->countFeatureValueRepository->findOneBy(['coffeeSort' => $coffeeSort,
                        'feature' => $countValue[1]]);
                    if ($coffeeSortValue) {
                        if ($val < $coffeeSortValue->getMin()) {
                            $min = $coffeeSortValue->getMin();
                            $explain[$coffeeSort->getName()] = "Сорт не подходит, т.к. значение признака \"$countValue[1]\" - $val меньше нижней границы ($min) множества значений данного признака.";
                            unset($coffeeSorts[array_search($coffeeSort,$coffeeSorts)]);
                        }
                        if ($val > $coffeeSortValue->getMax()) {
                            $max = $coffeeSortValue->getMax();
                            $explain[$coffeeSort->getName()] = "Сорт не подходит, т.к. значение признака \"$countValue[1]\" - $val больше верхней границы ($max) множества значений данного признака.";
                            unset($coffeeSorts[array_search($coffeeSort,$coffeeSorts)]);
                        }
                    }else{
                        $explain[$coffeeSort->getName()] = "Сорт не подходит, т.к. признак \"$countValue[1]\" не задан у данного сорта";
                    }
                }
            }

            if (count($coffeeSorts) == 0) {
                $result = ["Сорт кофе не определен, попробуйте ввести другие значения признаков"];
            } else {
                $result = $coffeeSorts;
//                    array_search(max($similarity), $similarity);
            }


            return $this->render('define_sort/result.html.twig', [
                'quanFeaturesValuesId' => $quanFeaturesValuesId,
                'countFeaturesValues' => $countFeaturesValues,
                'quanValues' => $quanValues,
                'countValues' => $countValues,
                'similarity' => $similarity,
                'result' => $result,
                'explain' => $explain,
            ]);
        }
        return $this->render('define_sort/values.html.twig', [
            'quanPossibleValues' => $this->quanPossibleValuesRepository->findAll(),
            'countPossibleValues' => $this->countPossibleValuesRepository->findAll()
        ]);
    }

    private function deleteNotValid(array $heystack, array $notValid): array {
        foreach ($heystack as $item) {
            foreach ($notValid as $notValidItem) {
                if ($item->getName() === $notValidItem) {
                    unset($heystack[array_search($item, $heystack)]);
                }
            }
        }

        return array_filter($heystack);
    }

    /**
     * @Route("/classifier", name="classifier_make")
     */
    public function classify(Request $request): Response
    {
        if ($request->request->has('submit')) {
            $explain = [];
            $coffeeSorts = $this->coffeeSortRepository->findAll();
            $countFeatures = $this->countFeatureRepository->findAll();
            $quanFeatures = $this->quanFeatureRepository->findAll();
            $notValidItem = array_keys($this->validator->validate());

            $quanFeatures = $this->deleteNotValid($quanFeatures, $notValidItem);
            $countFeatures = $this->deleteNotValid($countFeatures, $notValidItem);
            $coffeeSorts = $this->deleteNotValid($coffeeSorts, $notValidItem);

            foreach ($countFeatures as $feature) {
                if (!$request->request->has($feature->getAlias())) {
                    continue;
                }
                $value = $request->request->get($feature->getAlias());

                foreach ($coffeeSorts as $coffeeSort) {
                    $valuesForGenre = $this->valueOfFeatureRepository->findOneBy([
                        'coffeeSort' => $coffeeSort,
                        'countFeature' => $feature
                    ]);
                    if (!$valuesForGenre) {
                        $explain[$coffeeSort->getName()] = "Жанр не подходит, т.к. признак \"$feature\" не задан у данного жанра";
                        unset($coffeeSort[array_search($coffeeSort,$coffeeSorts)]);
                        continue;
                    }
                    $valuesForGenre = json_decode($valuesForGenre->getValue(), true);
                    if ($feature->getType() === Feature::QUALITATIVE) {
                        $isFind = false;
                        foreach ($valuesForGenre as $item) {
                            if (strtolower($item) === strtolower($value)) {
                                $isFind = true;
                                break;
                            }
                        }
                        if (!$isFind) {
                            $explain[$genre->getName()] = "Жанр не подходит, т.к. значение признака \"$feature\" - $value не входит во множество значений данного признака.";
                            unset($genres[array_search($genre,$genres)]);
                        }
                    } else {
                        if ($value < $valuesForGenre[0]) {
                            $explain[$genre->getName()] = "Жанр не подходит, т.к. значение признака \"$feature\" - $value меньше нижней границы ($valuesForGenre[0]) множества значений данного признака.";
                            unset($genres[array_search($genre,$genres)]);
                        }
                        if ($value > $valuesForGenre[1]) {
                            $explain[$genre->getName()] = "Жанр не подходит, т.к. значение признака \"$feature\" - $value больше верхней границы ($valuesForGenre[1]) множества значений данного признака.";
                            unset($genres[array_search($genre,$genres)]);
                        }
                    }
                    array_filter($genres);
                }
            }

            return $this->render('classifier/answer.html.twig', [
                'genres' => $genres,
                'explain' => $explain
            ]);
        }

        $featuresId = $request->query->get('features');
        $features = [];
        $possibleValues = [];
        if (!$featuresId) {
            return $this->render('classifier/answer.html.twig', [
                'genres' => $this->genreRepository->findAll(),
                'explain' => null
            ]);
        }
        foreach ($featuresId as $id) {
            $features[] = $this->featureRepository->findOneBy(['id' => $id]);
        }
        foreach ($features as $feature) {
            $possibleValue = $this->possibleValueRepository->findOneBy(['feature' => $feature]);
            $possibleValues[$feature->getAlias()] = $possibleValue->getValue();
        }

        return $this->render('classifier/form.html.twig', [
            'features' => $features,
            'possibleValues' => $possibleValues
        ]);
    }

    /**
     * @Route("/define_sort/result", name="define_sort_result", methods={"GET","POST"})
     */
    public function result(): Response
    {
        return $this->render('define_sort/result.html.twig', [
            'controller_name' => 'DefineSortController',
        ]);
    }
}
