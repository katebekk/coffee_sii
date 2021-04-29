<?php

namespace App\Controller;

use App\Entity\CoffeeSort;
use App\Entity\CountFeatureValue;
use App\Entity\QuanFeatureValue;
use App\Form\CoffeeSortType;
use App\Form\QuanFeatureValueType;
use App\Repository\CoffeeSortRepository;
use App\Repository\QuanFeatureRepository;
use App\Repository\CountFeatureRepository;
use App\Repository\QuanPossibleValuesRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

use Symfony\Component\Form\Extension\Core\Type\CollectionType;

/**
 * @Route("/specialist/coffee/sort")
 */
class CoffeeSortController extends AbstractController
{
    /**
     * @Route("/", name="coffee_sort_index", methods={"GET","POST"})
     */
    public function index(CoffeeSortRepository $coffeeSortRepository, Request $request, QuanFeatureRepository $quanFeatureRepository, CountFeatureRepository $countFeatureRepository): Response
    {
        $coffeeSort = new CoffeeSort();
        $form = $this->createForm(CoffeeSortType::class, $coffeeSort);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($coffeeSort);
            $entityManager->flush();

            return $this->redirectToRoute('coffee_sort_index');
        }
        return $this->render('coffee_sort/index.html.twig', [
            'coffee_sorts' => $coffeeSortRepository->findAll(),
            'coffee_sort' => $coffeeSort,
            'form' => $form->createView(),
            'quan_features' => $quanFeatureRepository->findAll(),
            'count_features'=> $countFeatureRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="coffee_sort_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $coffeeSort = new CoffeeSort();
        $form = $this->createForm(CoffeeSortType::class, $coffeeSort);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($coffeeSort);
            $entityManager->flush();

            return $this->redirectToRoute('coffee_sort_index');
        }

        return $this->render('coffee_sort/new.html.twig', [
            'coffee_sort' => $coffeeSort,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="coffee_sort_show", methods={"GET"})
     */
    public function show(CoffeeSort $coffeeSort): Response
    {
        return $this->render('coffee_sort/show.html.twig', [
            'coffee_sort' => $coffeeSort,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="coffee_sort_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, CoffeeSort $coffeeSort): Response
    {
        $form = $this->createForm(CoffeeSortType::class, $coffeeSort);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('coffee_sort_index');
        }

        return $this->render('coffee_sort/edit.html.twig', [
            'coffee_sort' => $coffeeSort,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="coffee_sort_delete", methods={"POST"})
     */
    public function delete(Request $request, CoffeeSort $coffeeSort): Response
    {
        if ($this->isCsrfTokenValid('delete' . $coffeeSort->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($coffeeSort);
            $entityManager->flush();
        }

        return $this->redirectToRoute('coffee_sort_index');
    }

    /**
     * @Route("/values/{id}", name="coffee_sort_features_values", methods={"GET","POST"})
     */
    public function featuresValues(Request $request, CoffeeSort $coffeeSort, CountFeatureRepository $countFeatureRepository, QuanFeatureRepository $quanFeatureRepository): Response
    {
        foreach ($quanFeatureRepository->findAll() as $quanFeature) {
            $quanFeatureValue = new QuanFeatureValue();
            $quanFeatureValue->setCoffeeSort($coffeeSort);
            $quanFeatureValue->setFeature($quanFeature);
            $coffeeSort->addQuanFeatureValue($quanFeatureValue);
        }
        foreach ($countFeatureRepository->findAll() as $countFeature) {
            $countFeatureValue = new CountFeatureValue();
            $countFeatureValue->setCoffeeSort($coffeeSort);
            $countFeatureValue->setFeature($countFeature);
            $coffeeSort->addCountFeatureValue($countFeatureValue);
        }

        $form = $this->createForm(CoffeeSortType::class, $coffeeSort);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($coffeeSort);
            $entityManager->flush();

            return $this->redirectToRoute('coffee_sort_index');
        }

        return $this->render('coffee_sort/features_values.html.twig', [
            'coffee_sort' => $coffeeSort,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}/add/quan/value", name="add_quan_feature_value", methods={"GET","POST"})
     */
    public function addQuanFeatureValue(Request $request,CoffeeSort $coffeeSort, QuanFeature $quanFeature): Response
    {

        $form = $this->createForm(CoffeeSortType::class, $coffeeSort, );
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($coffeeSort);
            $entityManager->flush();

            return $this->redirectToRoute('coffee_sort_index');
        }

        return $this->render('coffee_sort/new.html.twig', [
            'coffee_sort' => $coffeeSort,
            'form' => $form->createView(),
        ]);
    }
    /**
     * @Route("/values/{id}", name="coffee_sort_features_edit", methods={"GET","POST"})
     */
    public function featuresValuesEdit(Request $request, CoffeeSort $coffeeSort, CountFeatureRepository $countFeatureRepository, QuanFeatureRepository $quanFeatureRepository): Response
    {
        foreach ($quanFeatureRepository->findAll() as $quanFeature) {
            $quanFeatureValue = new QuanFeatureValue();
            $quanFeatureValue->setCoffeeSort($coffeeSort);
            $quanFeatureValue->setFeature($quanFeature);
            $coffeeSort->addQuanFeatureValue($quanFeatureValue);
        }
        foreach ($countFeatureRepository->findAll() as $countFeature) {
            $countFeatureValue = new CountFeatureValue();
            $countFeatureValue->setCoffeeSort($coffeeSort);
            $countFeatureValue->setFeature($countFeature);
            $coffeeSort->addCountFeatureValue($countFeatureValue);
        }

        if ($request->request->has('submit')) {
            $entityManager = $this->getDoctrine()->getManager();
            //$entityManager->persist($coffeeSort);
            $entityManager->flush();

            return $this->redirectToRoute('coffee_sort_index');
        }

        return $this->render('coffee_sort/features_values.html.twig', [
            'coffee_sort' => $coffeeSort,
            'quan_features' => $coffeeSort->getQuanFeatureValues(),
            'count_features' => $coffeeSort->getCountFeatureValues(),
            //'form' => $form->createView(),
        ]);
    }

}
