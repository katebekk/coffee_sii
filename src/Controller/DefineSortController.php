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

class DefineSortController extends AbstractController
{
    private $coffeeSortRepository;
    private $quanFeatureRepository;
    private $countFeatureRepository;
    private $countPossibleValuesRepository;
    private $quanPossibleValuesRepository;
    private $countFeatureValueRepository;
    private $quanFeatureValueRepository;

    public function __construct(
        CoffeeSortRepository $coffeeSortRepository,
        CountFeatureRepository $countFeatureRepository,
        QuanFeatureRepository $quanFeatureRepository,
        CountPossibleValuesRepository $countPossibleValuesRepository,
        QuanPossibleValuesRepository $quanPossibleValuesRepository,
        CountFeatureValueRepository $countFeatureValueRepository,
        QuanFeatureValueRepository $quanFeatureValueRepository

    )
    {
        $this->coffeeSortRepository = $coffeeSortRepository;
        $this->quanFeatureRepository = $quanFeatureRepository;
        $this->countFeatureRepository = $countFeatureRepository;
        $this->countPossibleValuesRepository = $countPossibleValuesRepository;
        $this->quanPossibleValuesRepository = $quanPossibleValuesRepository;
        $this->countFeatureValueRepository = $countFeatureValueRepository;
        $this->quanFeatureValueRepository = $quanFeatureValueRepository;
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
            $similarity = [];
            $explain = [];
            $quanValues = [];
            $countValues = [];
            $countFeaturesId = null;
            $quanFeaturesValuesId = $request->request->get('quanFeatures');
            $countFeaturesValuesMin = $request->request->get('min');
            $countFeaturesValuesMax = $request->request->get('max');
            if ($countFeaturesValuesMin) $countFeaturesId = array_keys($countFeaturesValuesMin);
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
                    $min = $countFeaturesValuesMin[$fid];
                    $max = $countFeaturesValuesMax[$fid];
                    if ($min >= $value->getMin() and $max <= $value->getMax()) {
                        $countValues[] = [$min, $max, $feature];
                    }
                }

            }
            foreach ($this->coffeeSortRepository->findAll() as $coffeeSort) {
                $similarity[$coffeeSort->getName()] = 0;
                foreach ($quanValues as $quanPossValue) {
                    $coffeeSortValue = $this->quanFeatureValueRepository->findOneBy(['coffeeSort' => $coffeeSort,
                        'feature' => $quanPossValue->getFeature()]);
                    if ($coffeeSortValue) {
                        if ($coffeeSortValue->getFeatureValues()->contains($quanPossValue)) {
                            $similarity[$coffeeSort->getName()]++;
                        }
                    }
                }
                foreach ($countValues as $countValue) {
                    $coffeeSortValue = $this->countFeatureValueRepository->findOneBy(['coffeeSort' => $coffeeSort,
                        'feature' => $countValue[2]]);
                    if ($coffeeSortValue) {
                        if ($min >= $coffeeSortValue->getMin() and $max <= $coffeeSortValue->getMax()) {
                            $similarity[$coffeeSort->getName()]++;
                        }
                    }
                }
            }

            if (max($similarity) == 0) {
                $result = "Сорт кофе не определен, попробуйте ввести другие значения признаков";
            } else {
                $result = array_keys($similarity,max($similarity));
//                    array_search(max($similarity), $similarity);
            }


            return $this->render('define_sort/result.html.twig', [
                'quanFeaturesValuesId' => $quanFeaturesValuesId,
                'countFeaturesValuesMin' => $countFeaturesValuesMin,
                'quanValues' => $quanValues,
                'countValues' => $countValues,
                'similarity' => $similarity,
                'result' => $result,
            ]);
        }
        return $this->render('define_sort/values.html.twig', [
            'quanPossibleValues' => $this->quanPossibleValuesRepository->findAll(),
            'countPossibleValues' => $this->countPossibleValuesRepository->findAll()
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
