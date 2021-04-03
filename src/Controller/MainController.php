<?php

namespace App\Controller;

use App\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MainController extends AbstractController
{
    /**
     * @Route("/", name="main")
     */
    public function index(): Response
    {
        $curUser = $this->getUser();
        if($curUser){
            $userRole = $curUser->getUserType();
            switch ($userRole) {
                case User::SPECIALIST:
                    return $this->redirectToRoute('specialist_homepage');
                case User::USER:
                    return $this->redirectToRoute('user_homepage');
            }
        }
        return $this->render('main/index.html.twig', [
            'controller_name' => 'MainController',
        ]);
    }
}
