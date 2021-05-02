<?php

namespace App\Controller;

use App\Utils\Validator;
use App\Entity\QuanFeatureValue;
use App\Entity\CountFeatureValue;
use App\Entity\CountPossibleValues;
use App\Entity\QuanPossibleValues;
use App\Repository\CoffeeSortRepository;
use App\Repository\QuanFeatureRepository;
use App\Repository\CountPossibleValuesRepository;
use App\Repository\QuanPossibleValuesRepository;
use App\Repository\CountFeatureRepository;
use App\Repository\QuanFeatureValueRepository;
use App\Repository\CountFeatureValueRepository;
use App\Form\CountFeatureValueType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Form\FormError;

/**
 * @Route("/specialist/value_of_feature")
 */
class ValueOfFeatureController extends AbstractController
{
    private $coffeeSortRepository;
    private $quanFeatureRepository;
    private $countFeatureRepository;
    private $countFeatureValueRepository;
    private $quanFeatureValueRepository;
    private $countPossibleValuesRepository;
    private $quanPossibleValuesRepository;
    private $validator;


    public function __construct(
        CoffeeSortRepository $coffeeSortRepository,
        CountFeatureValueRepository $countFeatureValueRepository,
        QuanFeatureValueRepository $quanFeatureValueRepository,
        CountFeatureRepository $countFeatureRepository,
        QuanFeatureRepository $quanFeatureRepository,
        CountPossibleValuesRepository $countPossibleValuesRepository,
        QuanPossibleValuesRepository $quanPossibleValuesRepository,
        Validator $validator
    )
    {
        $this->coffeeSortRepository = $coffeeSortRepository;
        $this->countFeatureValueRepository = $countFeatureValueRepository;
        $this->quanFeatureValueRepository = $quanFeatureValueRepository;
        $this->quanFeatureRepository = $quanFeatureRepository;
        $this->countFeatureRepository = $countFeatureRepository;
        $this->countPossibleValuesRepository = $countPossibleValuesRepository;
        $this->quanPossibleValuesRepository = $quanPossibleValuesRepository;
        $this->validator = $validator;

    }


    /**
     * @Route("/{sortId}", name="value_of_feature", methods={"GET", "POST"}, requirements={"id"="\d+"})
     */
    public function valueOfFeature(Request $request, $sortId = null): Response
    {
        $coffeeSort = $sortId;
        if ($request->request->has('submit')) {
            $coffeeSort = $this->coffeeSortRepository->findOneBy(['id' => $request->request->get('select')]);
        }
        if ($sortId) {
            $coffeeSort = $this->coffeeSortRepository->findOneBy(['id' => $sortId]);
        }

        return $this->render('value_of_feature/index.html.twig', [
            'coffeeSorts' => $this->coffeeSortRepository->findAll(),
            'countFeatureValue' => $this->countFeatureValueRepository->findAll(),
            'quanFeatureValue' => $this->quanFeatureValueRepository->findAll(),
            'coffeeSort' => $coffeeSort,
        ]);
    }
    /**
     * @Route("/{sortId}/count_edit/{featureId}", name="value_of_count_feature_edit", methods={"GET","POST"})
     */
    public function valueOfCountFeatureEdit(Request $request, $sortId = null,  $featureId = null ): Response
    {
        $coffeeSort = $this->coffeeSortRepository->findOneBy(['id' => $sortId]);
        $feature = $this->countFeatureRepository->findOneBy(['id' => $featureId]);
        $value = $this->countFeatureValueRepository->findOneBy(['feature'=> $feature, 'coffeeSort'=> $coffeeSort]);
        if(!$value){
            $value = new CountFeatureValue();
            $value->setFeature($feature);
            $value->setCoffeeSort($coffeeSort);
            $coffeeSort->addCountFeatureValue($value);
        }
        $form = $this->createForm(CountFeatureValueType::class, $value);
        $form->handleRequest($request);

        $possibleValue = $this->countPossibleValuesRepository->findOneBy(['feature' => $feature]);
        if ($form->isSubmitted() && $form->isValid()) {
            if ($possibleValue) {
                $min = $form['min']->getData();
                $max = $form['max']->getData();
                $min_possible = $possibleValue->getMin();
                $max_possible = $possibleValue->getMax();
                if ($min < $min_possible or $max > $max_possible) {
                    $form->addError(new FormError("Значения не соответствуют допустимым значениям! [{$min_possible}:{$max_possible}]"));
                }elseif($min > $max) {
                    $form->addError(new FormError("Значение \"от\" больше значения \"до\" ! "));
                } else {
                    $entityManager = $this->getDoctrine()->getManager();
                    $entityManager->persist($value);
                    $entityManager->flush();
                    return $this->redirectToRoute('value_of_feature', ['sortId' => $sortId]);
                }
            } else {
                $entityManager = $this->getDoctrine()->getManager();
                $entityManager->persist($value);
                $entityManager->flush();
                return $this->redirectToRoute('value_of_feature', ['sortId' => $sortId]);
            }

        }

        return $this->render('value_of_feature/count_edit.html.twig', [
            'coffeeSort' => $coffeeSort,
            'form'=>$form->createView(),
        ]);
    }
    /**
     * @Route("/{sortId}/quan_edit/{featureId}", name="value_of_quan_feature_edit", methods={"GET","POST"})
     */
    public function valueOfQuanFeatureEdit(Request $request, $sortId = null,  $featureId = null ): Response
    {
        $coffeeSort = $this->coffeeSortRepository->findOneBy(['id' => $sortId]);
        $feature = $this->quanFeatureRepository->findOneBy(['id' => $featureId]);
        $featureValue = $this->quanFeatureValueRepository->findOneBy(['feature' => $feature,'coffeeSort' => $coffeeSort]);
        if(!$featureValue){
            $featureValue = new QuanFeatureValue();
            $featureValue->setCoffeeSort($coffeeSort);
            $featureValue->setFeature($feature);
            $coffeeSort->addQuanFeatureValue($featureValue);
        }
        if ($request->request->has('submit')) {
            $featureValue->getFeatureValues()->clear();
            $valuesId = $request->request->get('values');
            if ($valuesId) {
                foreach ($valuesId as $fid) {
                    $possibleValue = $this->quanPossibleValuesRepository->findOneBy(['id' => $fid]);
                    $featureValue->addFeatureValue($possibleValue);
                }
            }
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($featureValue);
            $entityManager->flush();
            
            return $this->redirectToRoute('value_of_feature', ['sortId' => $sortId]);
        }
        return $this->render('value_of_feature/quan_edit.html.twig', [
            'coffeeSort' => $coffeeSort,
            'feature'=>$feature,
            'values' => $this->quanPossibleValuesRepository->findBy(['feature' => $feature]),
            'featureValues'=>$this->quanPossibleValuesRepository->findOneBy(['feature' => $feature])
        ]);
    }



}