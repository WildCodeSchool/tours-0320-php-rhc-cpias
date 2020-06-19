<?php

namespace App\Controller;

use App\Form\EsinType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Model\Upload;
use App\Entity\Esin;
use App\Service\DataRecovery;

/**
 * @Route("/esin")
 */
class EsinController extends AbstractController
{

   /**
    * @Route("/index", name="esin_index")
    */
    public function index()
    {
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
