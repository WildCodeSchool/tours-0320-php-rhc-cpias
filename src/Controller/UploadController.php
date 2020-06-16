<?php

namespace App\Controller;

use App\Form\UploadType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Upload;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;

class UploadController extends AbstractController
{
    /**
     * @Route("/upload", name="upload")
     * @IsGranted("ROLE_RESPONSABLE")
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
        }

        return $this->render('uploader.html.twig', [
            'form' => $form->createView(),

        ]);
    }
}
