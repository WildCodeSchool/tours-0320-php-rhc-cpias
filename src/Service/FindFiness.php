<?php

namespace App\Service;

use Symfony\Component\HttpFoundation\File\File;
use App\Form\UploadType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Model\Upload;
use App\Entity\Finess;
use Doctrine\ORM\EntityManagerInterface;
use App\Repository\FinessRepository;

class FindFiness
{
    private $entityManager;
    
    private $finessRepository;

    public function __construct(EntityManagerInterface $entityManager, FinessRepository $finessRepository)
    {
        $this->entityManager = $entityManager;
        $this->finessRepository = $finessRepository;
    }
    
    public function finess(File $file)
    {
        if ($file->getRealPath() !== false) {
            $openFile = fopen($file->getRealPath(), 'r');
    
            if ($openFile !== false) {
                $record = fgetcsv($openFile, 0, ";", '"');
                //on saute la première ligne qui contient les intitulés des champs
                $record = fgetcsv($openFile, 0, ";", '"');
                while ($record!== false && $record!== null) {
                    $finess = new Finess();
                    $finess ->setEtablissement($record[0]);
                    $finess ->setAdresse($record[1]);
                    $finess ->setCodePostal($record[2]);
                    $finess ->setVille($record[3]);
                    $finess ->setFiness($record[4]);
                    $record = fgetcsv($openFile, 0, ";", '"');
                    $this->entityManager->persist($finess);

                    $this->entityManager->flush();
                }
            }
        }
    }
}
