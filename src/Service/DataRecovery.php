<?php

namespace App\Service;

use Symfony\Component\HttpFoundation\File\UploadedFile;
use App\Form\UploadType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Model\Upload;
use App\Entity\SignalementEsin;
use Doctrine\ORM\EntityManagerInterface;

class DataRecovery
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }
    
    public function recovery(UploadedFile $file)
    {
        if ($file->getRealPath() !== false) {
            $openFile = fopen($file->getRealPath(), 'r');
    
            if ($openFile !== false) {
                $record = fgetcsv($openFile, 0, ";", '"');
                //on saute la première ligne qui contient les intitulés des champs
                $record = fgetcsv($openFile, 0, ";", '"');
                while ($record!== false) {
                    $esin = new SignalementEsin();
                    $esin ->setIdentifiantDeLaFiche($record[0]);
                    $esin ->setStringDerniereModif($record[2]);
                    $esin ->setEmissionString($record[3]);
                    $esin ->setStringEpisode($record[9]);
                    $esin ->setCodeFinessEtab($record[13]);
                    $esin ->setEnvoiAuCnr($record[32]);
                    $esin ->setNomCnrOuLabo($record[34]);
                    $esin ->setNbCas($record[50]);
                    $esin ->setEpidemieCasGroupes($record[56]);
                    $esin ->setCaractereNosocomial($record[57]);
                    $esin ->setOrigineCasImportes($record[63]);
                    $esin ->setEtabConcernes($record[64]);
                    $esin ->setAutresEtabs($record[65]);
                    $esin ->setCodeMicroOrganisme1($record[72]);
                    $esin ->setCodeMicroOrganisme2($record[74]);
                    $esin ->setCodeMicroOrganisme3($record[76]);
                    $esin ->setCodeSiteUn($record[78]);
                    $esin ->setCodeSiteDeux($record[80]);
                    $esin ->setCodeSiteTrois($record[82]);
                    $esin ->setInvestigation($record[85]);
                    $esin ->setHypotheseCause($record[87]);
                    $esin ->setJustification($record[95]);
                    $esin ->setPraticienHygiene($record[96]);
                    $record = fgetcsv($openFile, 0, ";", '"');
                    $this->entityManager->persist($esin);
                }
                $this->entityManager->flush();
            }
        }
    }
}
