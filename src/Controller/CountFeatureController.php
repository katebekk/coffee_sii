<?php

namespace App\Controller;

use App\Entity\CountFeature;
use App\Entity\CountPossibleValues;
use App\Form\CountFeatureType;
use App\Form\CountPossibleValuesType;
use App\Repository\CountFeatureRepository;
use App\Repository\CountFeatureValueRepository;
use App\Repository\CountPossibleValuesRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/count/feature")
 */
class CountFeatureController extends AbstractController
{
    private $countFeatureValueRepository;
    private $countPossibleValuesRepository;

    public function __construct(
        CountFeatureValueRepository $countFeatureValueRepository,
        CountPossibleValuesRepository $countPossibleValuesRepository
    ){
        $this->countFeatureValueRepository = $countFeatureValueRepository;
        $this->countPossibleValuesRepository = $countPossibleValuesRepository;
    }

    /**
     * @Route("/new", name="count_feature_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $countFeature = new CountFeature();
        $form = $this->createForm(CountFeatureType::class, $countFeature);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($countFeature);
            $entityManager->flush();

            return $this->redirectToRoute('feature_index');
        }

        return $this->render('count_feature/new.html.twig', [
            'count_feature' => $countFeature,
            'form' => $form->createView(),
        ]);
    }
    
    /**
     * @Route("/{id}/edit", name="count_feature_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, CountFeature $countFeature): Response
    {
        //если не были указаны возможные значения ранее
        if(!$countFeature->getCountPossibleValues()){
            $countPossibleValues = new CountPossibleValues();
            $countPossibleValues->setFeature($countFeature);
            $form = $this->createForm(CountPossibleValuesType::class, $countPossibleValues);
            $form->handleRequest($request);

            if ($form->isSubmitted() && $form->isValid()) {
                $countFeature->setCountPossibleValues($countPossibleValues);
                $entityManager = $this->getDoctrine()->getManager();
                $entityManager->persist($countPossibleValues);
                $entityManager->flush();

                return $this->redirectToRoute('feature_index');
            }

        }else{
            $countPossibleValues = $countFeature->getCountPossibleValues();
            $form = $this->createForm(CountPossibleValuesType::class, $countPossibleValues);
            $form->handleRequest($request);
            if ($form->isSubmitted() && $form->isValid()) {
                $this->getDoctrine()->getManager()->flush();

                return $this->redirectToRoute('feature_index');
            }
        }
        return $this->render('count_feature/edit.html.twig', [
            'count_feature' => $countFeature,
            'form' => $form->createView(),
        ]);

    }

    /**
     * @Route("/{id}", name="count_feature_delete", methods={"POST"})
     */
    public function delete(Request $request, CountFeature $countFeature): Response
    {
        if ($this->isCsrfTokenValid('delete'.$countFeature->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();

            $possibleValue = $this->countPossibleValuesRepository->findOneBy(['feature' => $countFeature]);
            $valuesOfFeature = $this->countFeatureValueRepository->findBy(['feature' => $countFeature]);

            if ($possibleValue) {
                $entityManager->remove($possibleValue);
            }
            foreach ($valuesOfFeature as $value) {
                $entityManager->remove($value);
            }


            $entityManager->remove($countFeature);
            $entityManager->flush();
        }

        return $this->redirectToRoute('feature_index');
    }
}
