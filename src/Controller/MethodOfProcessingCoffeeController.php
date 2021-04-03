<?php

namespace App\Controller;

use App\Entity\MethodOfProcessingCoffee;
use App\Form\MethodOfProcessingCoffeeType;
use App\Repository\MethodOfProcessingCoffeeRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/method/of/processing/coffee")
 */
class MethodOfProcessingCoffeeController extends AbstractController
{
    /**
     * @Route("/", name="method_of_processing_coffee_index", methods={"GET"})
     */
    public function index(MethodOfProcessingCoffeeRepository $methodOfProcessingCoffeeRepository): Response
    {
        return $this->render('method_of_processing_coffee/index.html.twig', [
            'method_of_processing_coffees' => $methodOfProcessingCoffeeRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="method_of_processing_coffee_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $methodOfProcessingCoffee = new MethodOfProcessingCoffee();
        $form = $this->createForm(MethodOfProcessingCoffeeType::class, $methodOfProcessingCoffee);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($methodOfProcessingCoffee);
            $entityManager->flush();

            return $this->redirectToRoute('method_of_processing_coffee_index');
        }

        return $this->render('method_of_processing_coffee/new.html.twig', [
            'method_of_processing_coffee' => $methodOfProcessingCoffee,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="method_of_processing_coffee_show", methods={"GET"})
     */
    public function show(MethodOfProcessingCoffee $methodOfProcessingCoffee): Response
    {
        return $this->render('method_of_processing_coffee/show.html.twig', [
            'method_of_processing_coffee' => $methodOfProcessingCoffee,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="method_of_processing_coffee_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, MethodOfProcessingCoffee $methodOfProcessingCoffee): Response
    {
        $form = $this->createForm(MethodOfProcessingCoffeeType::class, $methodOfProcessingCoffee);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('method_of_processing_coffee_index');
        }

        return $this->render('method_of_processing_coffee/edit.html.twig', [
            'method_of_processing_coffee' => $methodOfProcessingCoffee,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="method_of_processing_coffee_delete", methods={"POST"})
     */
    public function delete(Request $request, MethodOfProcessingCoffee $methodOfProcessingCoffee): Response
    {
        if ($this->isCsrfTokenValid('delete'.$methodOfProcessingCoffee->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($methodOfProcessingCoffee);
            $entityManager->flush();
        }

        return $this->redirectToRoute('method_of_processing_coffee_index');
    }
}
