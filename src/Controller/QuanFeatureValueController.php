<?php

namespace App\Controller;

use App\Entity\QuanFeatureValue;
use App\Form\QuanFeatureValueType;
use App\Repository\QuanFeatureValueRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/quan/feature/value")
 */
class QuanFeatureValueController extends AbstractController
{
    /**
     * @Route("/", name="quan_feature_value_index", methods={"GET"})
     */
    public function index(QuanFeatureValueRepository $quanFeatureValueRepository): Response
    {
        return $this->render('quan_feature_value/index.html.twig', [
            'quan_feature_values' => $quanFeatureValueRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="quan_feature_value_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $quanFeatureValue = new QuanFeatureValue();
        $form = $this->createForm(QuanFeatureValueType::class, $quanFeatureValue);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($quanFeatureValue);
            $entityManager->flush();

            return $this->redirectToRoute('quan_feature_value_index');
        }

        return $this->render('quan_feature_value/new.html.twig', [
            'quan_feature_value' => $quanFeatureValue,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="quan_feature_value_show", methods={"GET"})
     */
    public function show(QuanFeatureValue $quanFeatureValue): Response
    {
        return $this->render('quan_feature_value/show.html.twig', [
            'quan_feature_value' => $quanFeatureValue,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="quan_feature_value_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, QuanFeatureValue $quanFeatureValue): Response
    {
        $form = $this->createForm(QuanFeatureValueType::class, $quanFeatureValue);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('quan_feature_value_index');
        }

        return $this->render('quan_feature_value/edit.html.twig', [
            'quan_feature_value' => $quanFeatureValue,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="quan_feature_value_delete", methods={"POST"})
     */
    public function delete(Request $request, QuanFeatureValue $quanFeatureValue): Response
    {
        if ($this->isCsrfTokenValid('delete'.$quanFeatureValue->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($quanFeatureValue);
            $entityManager->flush();
        }

        return $this->redirectToRoute('quan_feature_value_index');
    }
}
