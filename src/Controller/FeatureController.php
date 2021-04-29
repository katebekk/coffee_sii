<?php

namespace App\Controller;

use App\Entity\QuanFeature;
use App\Entity\CountFeature;
use App\Form\QuanFeatureType;
use App\Entity\CoffeeSort;
use App\Repository\CoffeeSortRepository;
use App\Repository\QuanFeatureRepository;
use App\Repository\CountFeatureRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/specialist/feature")
 */
class FeatureController extends AbstractController
{
    private $coffeeSortRepository;
    private $quanFeatureRepository;
    private $countFeatureRepository;

    public function __construct(
        CoffeeSortRepository $coffeeSortRepository,
        CountFeatureRepository $countFeatureRepository,
        QuanFeatureRepository $quanFeatureRepository
    )
    {
        $this->coffeeSortRepository = $coffeeSortRepository;
        $this->quanFeatureRepository = $quanFeatureRepository;
        $this->countFeatureRepository = $countFeatureRepository;
    }

    /**
     * @Route("/", name="feature_index", methods={"GET"})
     *
     */
    public function index(): Response
    {
        return $this->render('feature/index.html.twig', [
            'quan_features' => $this->quanFeatureRepository->findAll(),
            'count_features' => $this->countFeatureRepository->findAll(),
        ]);
    }

    /**
     * @Route("/edit", name="feature_edit", methods={"GET"})
     *
     */
    public function edit(): Response
    {
        return $this->render('feature/edit.html.twig', [
            'quan_features' => $this->quanFeatureRepository->findAll(),
            'count_features' => $this->countFeatureRepository->findAll(),
        ]);
    }

    /**
     * @Route("/feature_of_sort", name="features_of_sort_index", methods={"GET"})
     */
    public function featuresOfSortIndex(): Response
    {
        return $this->render('features_of_sort/index.html.twig', [
            'coffeeSorts' => $this->coffeeSortRepository->findAll(),
        ]);
    }

    /**
     * @Route("/feature_of_sort/edit/{id}", name="features_of_sort_edit", methods={"GET","POST"})
     */
    public function featuresOfSortEdit(Request $request,CoffeeSort $coffeeSort): Response
    {
        if ($request->request->has('submit')) {
            $coffeeSort->getQuanFeatures()->clear();
            $coffeeSort->getCountFeatures()->clear();
            $quanFeaturesId = $request->request->get('quanFeatures');
            $countFeaturesId = $request->request->get('countFeatures');
            if ($quanFeaturesId) {
                foreach ($quanFeaturesId as $fid) {
                    $feature = $this->quanFeatureRepository->findOneBy(['id' => $fid]);
                    $coffeeSort->addQuanFeature($feature);
                }
            }
            if($countFeaturesId) {
                foreach ($countFeaturesId as $fid) {
                    $feature = $this->countFeatureRepository->findOneBy(['id' => $fid]);
                    $coffeeSort->addCountFeature($feature);
                }
            }
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('features_of_sort_index');
        }

        return $this->render('features_of_sort/edit.html.twig', [
            'coffeeSort' => $coffeeSort,
            'quanFeatures' => $this->quanFeatureRepository->findAll(),
            'countFeatures' => $this->countFeatureRepository->findAll(),

        ]);
    }
}
