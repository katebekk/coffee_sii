<?php

namespace App\Controller;

use App\Entity\Coffee;
use App\Form\Coffee1Type;
use App\Repository\CoffeeRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/coffee")
 */
class CoffeeController extends AbstractController
{
    /**
     * @Route("/", name="coffee_index", methods={"GET"})
     */
    public function index(CoffeeRepository $coffeeRepository): Response
    {
        return $this->render('coffee/index.html.twig', [
            'coffees' => $coffeeRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="coffee_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $coffee = new Coffee();
        $form = $this->createForm(Coffee1Type::class, $coffee);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($coffee);
            $entityManager->flush();

            return $this->redirectToRoute('coffee_index');
        }

        return $this->render('coffee/new.html.twig', [
            'coffee' => $coffee,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="coffee_show", methods={"GET"})
     */
    public function show(Coffee $coffee): Response
    {
        return $this->render('coffee/show.html.twig', [
            'coffee' => $coffee,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="coffee_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Coffee $coffee): Response
    {
        $form = $this->createForm(Coffee1Type::class, $coffee);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('coffee_index');
        }

        return $this->render('coffee/edit.html.twig', [
            'coffee' => $coffee,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="coffee_delete", methods={"POST"})
     */
    public function delete(Request $request, Coffee $coffee): Response
    {
        if ($this->isCsrfTokenValid('delete'.$coffee->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($coffee);
            $entityManager->flush();
        }

        return $this->redirectToRoute('coffee_index');
    }
}
