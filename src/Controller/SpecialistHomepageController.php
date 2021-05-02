<?php

namespace App\Controller;

use App\Utils\Validator;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;


/**
 * @Route("/specialist")
 */
class SpecialistHomepageController extends AbstractController
{
    private $validator;

    public function __construct(Validator $validator){
        $this->validator = $validator;
    }

    /**
     * @Route("/homepage", name="specialist_homepage")
     */
    public function index(): Response
    {
        return $this->render('specialist_homepage/index.html.twig', [
            'controller_name' => 'SpecialistHomepageController',
        ]);
    }
    /**
     * @Route("/editor", name="knowledge_editor")
     */
    public function editor(): Response
    {
        return $this->render('specialist_homepage/editor.html.twig', [
            'controller_name' => 'SpecialistHomepageController',
        ]);
    }
    /**
     * @Route("/integrity_check", name="integrity_check", methods={"GET", "POST"})
     */
    public function  integrityCheck(Request $request): Response
    {
        $vals = $this->validator->validate();
        return $this->render('value_of_feature/check.html.twig', [
            'result' => $vals
        ]);
    }
}
