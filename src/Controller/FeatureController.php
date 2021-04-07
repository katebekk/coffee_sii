<?php

namespace App\Controller;

use App\Entity\QuanFeature;
use App\Entity\CountFeature;
use App\Form\QuanFeatureType;
use App\Repository\QuanFeatureRepository;
use App\Repository\CountFeatureRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/feature")
 */
class FeatureController extends AbstractController
{
    /**
     * @Route("/", name="feature_index", methods={"GET"})
     *
     */
    public function index(QuanFeatureRepository $quanFeatureRepository, CountFeatureRepository $countFeatureRepository): Response
    {
        return $this->render('feature/index.html.twig', [
            'quan_features' => $quanFeatureRepository->findAll(),
            'count_features' => $countFeatureRepository->findAll(),
        ]);
    }
    /**
     * @Route("/feature/edit", name="feature_edit", methods={"GET"})
     *
     */
    public function edit(QuanFeatureRepository $quanFeatureRepository, CountFeatureRepository $countFeatureRepository): Response
    {
        return $this->render('feature/edit.html.twig', [
            'quan_features' => $quanFeatureRepository->findAll(),
            'count_features' => $countFeatureRepository->findAll(),
        ]);
    }


}
