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
    * @Route("/show/{id}", name="esin_show")
    */

    public function show(Esin $esin): Response
    {
        return $this->render('esin/show.html.twig', [
            'esin' => $esin,
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
            $file = $upload->getUploadedFile();
            if ($file !== null) {
                $dataRecovery->recovery($file);
                return $this->redirectToRoute('esin_index');
            }
            $this->addFlash('success', 'Chargement du fichier effectué');
        }
            
        
        return $this->render(
            'esin/upload.html.twig',
            ['form' => $form->createView(),

            ]
        );
    }
}
