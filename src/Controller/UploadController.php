<?php

namespace App\Controller;

use App\Form\UploadType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Model\Upload;
use App\Entity\SignalementEsin;
use App\Service\DataRecovery;

class UploadController extends AbstractController
{
    /**
    * @Route("/upload", name="upload")
    */
    public function new(Request $request, DataRecovery $dataRecovery)
    {
        $upload = new Upload();
        $form = $this->createForm(UploadType::class, $upload);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $dataRecovery->recovery($upload->getUploadedFile());
        }
        return $this->render(
            'upload/form_upload.html.twig',
            ['form' => $form->createView(),
            'validationMessage' => 'Le fichier a bien été recupéré',
            'errorMessage' => 'Le fichier n\'a pas été recupéré'

            ]
        );
    }
}
