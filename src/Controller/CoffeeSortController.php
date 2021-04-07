<?php

namespace App\Controller;

use App\Entity\CoffeeSort;
use App\Form\CoffeeSortType;
use App\Repository\CoffeeSortRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/coffee/sort")
 */
class CoffeeSortController extends AbstractController
{
    /**
     * @Route("/", name="coffee_sort_index", methods={"GET","POST"})
     */
    public function index(CoffeeSortRepository $coffeeSortRepository, Request $request): Response
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
        if ($this->isCsrfTokenValid('delete'.$coffeeSort->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($coffeeSort);
            $entityManager->flush();
        }

        return $this->redirectToRoute('coffee_sort_index');
    }
}
