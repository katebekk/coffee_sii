<?php

namespace App\Controller;

use App\Entity\RegionOfOrigin;
use App\Form\RegionOfOriginType;
use App\Repository\RegionOfOriginRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/region")
 */
class RegionOfOriginController extends AbstractController
{
    /**
     * @Route("/", name="region_of_origin_index", methods={"GET"})
     */
    public function index(RegionOfOriginRepository $regionOfOriginRepository): Response
    {
        return $this->render('region_of_origin/index.html.twig', [
            'region_of_origins' => $regionOfOriginRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="region_of_origin_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $regionOfOrigin = new RegionOfOrigin();
        $form = $this->createForm(RegionOfOriginType::class, $regionOfOrigin);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($regionOfOrigin);
            $entityManager->flush();

            return $this->redirectToRoute('region_of_origin_index');
        }

        return $this->render('region_of_origin/new.html.twig', [
            'region_of_origin' => $regionOfOrigin,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="region_of_origin_show", methods={"GET"})
     */
    public function show(RegionOfOrigin $regionOfOrigin): Response
    {
        return $this->render('region_of_origin/show.html.twig', [
            'region_of_origin' => $regionOfOrigin,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="region_of_origin_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, RegionOfOrigin $regionOfOrigin): Response
    {
        $form = $this->createForm(RegionOfOriginType::class, $regionOfOrigin);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('region_of_origin_index');
        }

        return $this->render('region_of_origin/edit.html.twig', [
            'region_of_origin' => $regionOfOrigin,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="region_of_origin_delete", methods={"POST"})
     */
    public function delete(Request $request, RegionOfOrigin $regionOfOrigin): Response
    {
        if ($this->isCsrfTokenValid('delete'.$regionOfOrigin->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($regionOfOrigin);
            $entityManager->flush();
        }

        return $this->redirectToRoute('region_of_origin_index');
    }
}
