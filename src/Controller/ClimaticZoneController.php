<?php

namespace App\Controller;

use App\Entity\ClimaticZone;
use App\Form\ClimaticZoneType;
use App\Repository\ClimaticZoneRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/climatic/zone")
 */
class ClimaticZoneController extends AbstractController
{
    /**
     * @Route("/", name="climatic_zone_index", methods={"GET"})
     */
    public function index(ClimaticZoneRepository $climaticZoneRepository): Response
    {
        return $this->render('climatic_zone/index.html.twig', [
            'climatic_zones' => $climaticZoneRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="climatic_zone_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $climaticZone = new ClimaticZone();
        $form = $this->createForm(ClimaticZoneType::class, $climaticZone);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($climaticZone);
            $entityManager->flush();

            return $this->redirectToRoute('climatic_zone_index');
        }

        return $this->render('climatic_zone/new.html.twig', [
            'climatic_zone' => $climaticZone,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="climatic_zone_show", methods={"GET"})
     */
    public function show(ClimaticZone $climaticZone): Response
    {
        return $this->render('climatic_zone/show.html.twig', [
            'climatic_zone' => $climaticZone,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="climatic_zone_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, ClimaticZone $climaticZone): Response
    {
        $form = $this->createForm(ClimaticZoneType::class, $climaticZone);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('climatic_zone_index');
        }

        return $this->render('climatic_zone/edit.html.twig', [
            'climatic_zone' => $climaticZone,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="climatic_zone_delete", methods={"POST"})
     */
    public function delete(Request $request, ClimaticZone $climaticZone): Response
    {
        if ($this->isCsrfTokenValid('delete'.$climaticZone->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($climaticZone);
            $entityManager->flush();
        }

        return $this->redirectToRoute('climatic_zone_index');
    }
}
