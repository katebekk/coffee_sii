<?php

namespace App\Controller;

use App\Entity\QuanFeature;
use App\Entity\QuanPossibleValues;
use App\Form\QuanFeatureType;
use App\Form\QuanPossibleValuesType;
use App\Repository\QuanFeatureRepository;
use App\Repository\QuanFeatureValueRepository;
use App\Repository\QuanPossibleValuesRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/quan/feature")
 */
class QuanFeatureController extends AbstractController
{

    private $quanFeatureValueRepository;
    private $quanPossibleValuesRepository;

    public function __construct(
        QuanFeatureValueRepository $quanFeatureValueRepository,
        QuanPossibleValuesRepository $quanPossibleValuesRepository
    ){
        $this->quanFeatureValueRepository = $quanFeatureValueRepository;
        $this->quanPossibleValuesRepository = $quanPossibleValuesRepository;
    }
    /**
     * @Route("/new", name="quan_feature_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $quanFeature = new QuanFeature();
        $form = $this->createForm(QuanFeatureType::class, $quanFeature);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($quanFeature);
            $entityManager->flush();

            return $this->redirectToRoute('feature_index');
        }

        return $this->render('quan_feature/new.html.twig', [
            'quan_feature' => $quanFeature,
            'form' => $form->createView(),
        ]);
    }


    /**
     * @Route("/{id}/edit", name="quan_feature_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, QuanFeature $quanFeature): Response
    {
        $quanPossibleValues = new QuanPossibleValues();
        $quanPossibleValues->setFeature($quanFeature);
        $form = $this->createForm(QuanPossibleValuesType::class, $quanPossibleValues);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $quanFeature->addQuanPossibleValue($quanPossibleValues);
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($quanPossibleValues);
            $entityManager->flush();

            return $this->redirectToRoute('quan_feature_edit', ['id' => $quanFeature->getId()]);
        }

        return $this->render('quan_feature/edit.html.twig', [
            'quan_feature' => $quanFeature,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="quan_feature_delete", methods={"POST"})
     */
    public function delete(Request $request, QuanFeature $quanFeature): Response
    {
        if ($this->isCsrfTokenValid('delete'.$quanFeature->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $possibleValues = $this->quanPossibleValuesRepository->findBy(['feature' => $quanFeature]);
            $valuesOfFeature = $this->quanFeatureValueRepository->findBy(['feature' => $quanFeature]);

            foreach ($possibleValues as $possibleValue) {
                $entityManager->remove($possibleValue);
            }
            foreach ($valuesOfFeature as $value) {
                $entityManager->remove($value);
            }
            $entityManager->remove($quanFeature);
            $entityManager->flush();
        }

        return $this->redirectToRoute('feature_index');
    }

    /**
     * @Route("/{id}/delete", name="quan_possible_values_delete", methods={"POST"})
     */
    public function deletePossibleValues(Request $request, QuanPossibleValues $quanPossibleValues): Response
    {
        $quanFeature = $quanPossibleValues->getFeature();
        if ($this->isCsrfTokenValid('delete'.$quanPossibleValues->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($quanPossibleValues);
            $entityManager->flush();
        }

//       return $this->redirectToRoute('feature_edit');
        return $this->redirectToRoute('quan_feature_edit', ['id' => $quanFeature->getId()]);
    }
}
