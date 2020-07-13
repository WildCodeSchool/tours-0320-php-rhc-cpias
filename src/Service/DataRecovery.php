<?php

namespace App\Service;

use Symfony\Component\HttpFoundation\File\File;
use App\Form\UploadType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Model\Upload;
use App\Entity\Esin;
use Doctrine\ORM\EntityManagerInterface;
use App\Repository\EsinRepository;
use \DateTime;

class DataRecovery
{
    private $entityManager;
    
    private $esinRepository;

    public function __construct(EntityManagerInterface $entityManager, EsinRepository $esinRepository)
    {
        $this->entityManager = $entityManager;
        $this->esinRepository = $esinRepository;
    }
    
    public function recovery(File $file)
    {
        if ($file->getRealPath() !== false) {
            $openFile = fopen($file->getRealPath(), 'r');
            if ($openFile !== false) {
                $record = fgetcsv($openFile, 0, ";", '"');
                //on saute la première ligne qui contient les intitulés des champs
                $record = fgetcsv($openFile, 0, ";", '"');
                while ($record!== false && $record!== null) {
                    // Vérifier qu'il y a au moins 96 cases dans $record
                    
                    if (count($record) < 96) {
                    // Sinon, on a pas un fichier au bon format --> message d'erreur
                        return "Le csv n'est pas au bon format, il manque des cases";
                    }

                   
                    $date = $record[3];
                    $day = substr($date, 0, 3);
                    $month = substr($date, 3, 3);
                    $year = substr($date, 6, 4);
                    $newDate = new DateTime($month .$day . $year);
                    

                    $esin = $this->esinRepository->findOneby(
                        ['identifiantDeLaFiche'=>$record[0],'emissionDeLaFiche'=>$newDate]
                    );
                    
                    if ($esin === null) {
                        $esin = new Esin();
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
    

                            $this->entityManager->flush();
                    } else {
                        return "ce fichier à deja été entré";
                    }
                }
            }
        }
    }
}
