<?php

namespace App\Controller;

use App\Form\UploadType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Upload;
use App\Entity\SignalementEsin;
use App\Entity\EsinSuite;

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
            if ($openFile !== false) {
                $record = fgetcsv($openFile, 0, ";", '"');
                //on saute la première ligne qui contient les intitulés des champs
                $record = fgetcsv($openFile, 0, ";", '"');
                while ($record!== false) {
                    $esin = new SignalementEsin();
                    $esinSuite = new EsinSuite();
                    $esin ->setIdentifiantDeLaFiche($record[0]);
                    $esin ->setDateDerniereModif($record[2]);
                    $esin ->setEmissionDeLaFiche($record[3]);
                    $esin ->setEpisodePrecedent($record[9]);
                    $esin ->setCodeFinessEtab($record[13]);
                    $esin ->setEnvoiAuCnr($record[32]);
                    $esin ->setNomCnrOuLabo($record[34]);
                    $esin ->setNbCas($record[49]);
                    $esin ->setEpidemieCasGroupes($record[55]);
                    $esin ->setCaractereNosocomial($record[56]);
                    $esin ->setOrigineCasImportes($record[62]);
                    $esin ->setEtabConcernes($record[63]);
                    $esin ->setAutresEtabs($record[64]);
                    $esin ->setCodeMicroOrganisme1($record[71]);
                    $esin ->setCodeMicroOrganisme2($record[73]);
                    $esin ->setCodeMicroOrganisme3($record[75]);
                    $esin ->setCodeSiteUn($record[77]);
                    $esin ->setCodeSiteDeux($record[79]);
                    $esin ->setCodeSiteTrois($record[81]);
                    $esinSuite ->setInvestigation($record[84]);
                    $esinSuite ->setHypotheseCause($record[86]);
                    $esinSuite ->setJustification($record[94]);
                    $esinSuite ->setPraticienHygiene($record[95]);
                    $record = fgetcsv($openFile, 0, ";", '"');
                }
            }
            {
                return $this->render(
                    'form_upload.html.twig',
                    ['form' => $form->createView(),
                    'errorMessage' => 'Le fichier n\' a pas pu être ouvert'
            
                    ]
                );
            }
        }

        return $this->render('form_upload.html.twig', [
            'form' => $form->createView(),
            
        ]);
    }
}
