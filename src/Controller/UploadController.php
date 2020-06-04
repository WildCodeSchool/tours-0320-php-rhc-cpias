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
            $fileName = md5(uniqid()).'.'.$file->guessExtension();
            $file->move($this->getParameter('csv_directory'), $fileName);
            $upload->setName($fileName);
        }

        return $this->render('uploader.html.twig', [
            'form' => $form->createView(),
            
        ]);
    }
}
