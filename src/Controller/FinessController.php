<?php

namespace App\Controller;

use App\Form\FinessType;
use App\Entity\Finess;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class FinessController extends AbstractController
{

     /**
     * @Route("finess/new", name="finess_new", methods={"GET","POST"})
     * @param Request $request
     * @return Response
     */
    public function new(Request $request): Response
    {
        $finess = new Finess();
        $form = $this->createForm(FinessType::class, $finess);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($finess);
            $entityManager->flush();

            return $this->redirectToRoute('finess_new');
        }

        return $this->render('finess/new.html.twig', [
            'finess' => $finess,
            'form' => $form->createView(),
        ]);
    }

     /**
     * @Route("/finess/edit/{id}", name="finess_edit", methods={"GET","POST"}, requirements ={"id"="\d+"})
     * @param Request $request
     * @param Finess $finess
     * @return Response
     */
    public function edit(Request $request, Finess $finess): Response
    {
        $form = $this->createForm(FinessType::class, $finess);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();
        }

        return $this->render('finess/edit.html.twig', [
            'finess' => $finess,
            'form' => $form->createView(),
        ]);
    }
}