<?php

namespace App\Controller;

use App\Form\UploadType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Upload;

class UploadController extends AbstractController
{
    /**
    * @Route("/upload", name="upload")
    */
    public function new(Request $request)
    {
        $upload = new Upload();
        $form = $this->createForm(UploadType::class, $upload);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $file = $upload->getName();
            $fileName = uniqid().'.'.$file->guessExtension();
            $file->move($this->getParameter('csv_directory'), $fileName);
            $openFile = fopen($fileName, 'r');
            if ($openFile === false) {
                return $this->render(
                    'form_upload.html.twig',
                    ['form' => $form->createView(),
                    'errorMessage' => 'Le fichier n\' a pas pu être ouvert'
            
                    ]
                );
            }
            fgetcsv($openFile, 0, ";", '"');
        }

        return $this->render('form_upload.html.twig', [
            'form' => $form->createView(),
            
        ]);
    }
}
