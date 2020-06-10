<?php

namespace App\Controller;

use App\Entity\Strain;
use App\Form\StrainType;
use App\Repository\StrainRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/strain")
 */
class StrainController extends AbstractController
{
    /**
     * @Route("/", name="strain_index", methods={"GET"})
     * @param StrainRepository $strainRepository
     * @return Response
     */
    public function index(StrainRepository $strainRepository): Response
    {
        return $this->render('strain/index.html.twig', [
            'strains' => $strainRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="strain_new", methods={"GET","POST"})
     * @param Request $request
     * @return Response
     */
    public function new(Request $request): Response
    {
        $strain = new Strain();
        $form = $this->createForm(StrainType::class, $strain);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($strain);
            $entityManager->flush();

            return $this->redirectToRoute('strain_index');
        }

        return $this->render('strain/new.html.twig', [
            'strain' => $strain,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="strain_show", methods={"GET"})
     * @param Strain $strain
     * @return Response
     */
    public function show(Strain $strain): Response
    {
        return $this->render('strain/show.html.twig', [
            'strain' => $strain,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="strain_edit", methods={"GET","POST"})
     * @param Request $request
     * @param Strain $strain
     * @return Response
     */
    public function edit(Request $request, Strain $strain): Response
    {
        $form = $this->createForm(StrainType::class, $strain);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('strain_index');
        }

        return $this->render('strain/edit.html.twig', [
            'strain' => $strain,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="strain_delete", methods={"DELETE"})
     * @param Request $request
     * @param Strain $strain
     * @return Response
     */
    public function delete(Request $request, Strain $strain): Response
    {
        if ($this->isCsrfTokenValid('delete'.$strain->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($strain);
            $entityManager->flush();
        }

        return $this->redirectToRoute('strain_index');
    }
}
