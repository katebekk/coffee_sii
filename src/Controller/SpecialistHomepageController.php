<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/specialist")
 */
class SpecialistHomepageController extends AbstractController
{
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
}
