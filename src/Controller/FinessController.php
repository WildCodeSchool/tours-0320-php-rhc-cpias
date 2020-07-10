<?php

namespace App\Controller;

use App\Entity\Finess;
use App\Form\FinessType;
use App\Repository\FinessRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Service\FindFiness;
use App\Model\Upload;
use App\Form\FinessUploadType;

/**
 * @Route("/finess")
 */
class FinessController extends AbstractController
{
    /**
     * @Route("/", name="finess_index", methods={"GET"})
     */
    public function index(FinessRepository $finessRepository): Response
    {
        return $this->render('finess/index.html.twig', [
            'finesses' => $finessRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="finess_new", methods={"GET","POST"})
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

            return $this->redirectToRoute('finess_index');
        }

        return $this->render('finess/new.html.twig', [
            'finess' => $finess,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/show/{id}", name="finess_show", methods={"GET"})
     */
    public function show(Finess $finess): Response
    {
        return $this->render('finess/show.html.twig', [
            'finess' => $finess,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="finess_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Finess $finess): Response
    {
        $form = $this->createForm(FinessType::class, $finess);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('finess_index');
        }

        return $this->render('finess/edit.html.twig', [
            'finess' => $finess,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="finess_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Finess $finess): Response
    {
        if ($this->isCsrfTokenValid('delete'.$finess->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($finess);
            $entityManager->flush();
        }

        return $this->redirectToRoute('finess_index');
    }

    /**
     * @Route("/add", name="finess_upload")
     * @param Request $request
     * @param FindFiness $finess
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|Response
     */
    public function find(Request $request, FindFiness $finess)
    {
        $upload = new Upload();
        $form = $this->createForm(FinessType::class, $upload);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $file = $upload->getUploadedFile();
            if ($file !== null) {
                $finess->finess($file);
                return $this->redirectToRoute('finess_map');
            }
        }

        return $this->render(
            'finess/upload.html.twig',
            ['form' => $form->createView(),

            ]
        );
    }
}
