<?php

namespace App\Controller;

use App\Form\EsinType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Model\Upload;
use App\Entity\Esin;
use App\Service\DataRecovery;
use App\Repository\EsinRepository;

/**
 * @Route("/esin")
 */
class EsinController extends AbstractController
{

   /**
    * @Route("/", name="esin_index", methods={"GET"})
    */
    public function index(EsinRepository $esinRepository): Response
    {
        return $this->render('esin/index.html.twig', [
            'esins' => $esinRepository->findAll(),
        ]);
    }


   /**
    * @Route("/show", name="esin_show")
    */

    public function show(EsinRepository $esinRepository): Response
    {
        return $this->render('esin/show.html.twig', [
            'esins' => $esinRepository->findAll(),
        ]);
    }


   /**
    * @Route("/new", name="esin_new")
    */
    public function new(Request $request, DataRecovery $dataRecovery)
    {
        $upload = new Upload();
        $form = $this->createForm(EsinType::class, $upload);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $dataRecovery->recovery($upload->getUploadedFile());
        }
        return $this->render(
            'esin/upload.html.twig',
            ['form' => $form->createView(),
            'validationMessage' => 'Le fichier a bien été recupéré',
            'errorMessage' => 'Le fichier n\'a pas été recupéré'

            ]
        );
    }
}