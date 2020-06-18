<?php

namespace App\Controller;

use App\Entity\Strain;
use App\Entity\Finess;
use App\Repository\FinessRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/map")
 */
class MapController extends AbstractController
{
    /**
     * @Route("/", name="finess_map", methods={"GET"})
     * @param FinessRepository $finessRepository
     * @return Response
     */
    public function index(FinessRepository $finessRepository): Response
    {
        $fine = $finessRepository->findAll();
        return $this->render('map/index.html.twig', [
            'finess' => $fine
        ]);
    }

    /**
     * @param int $finess
     * @Route("/strainByFiness/{finess}",name="strain_finess", methods={"GET"})
     * @return Response
     */
    public function strainByFiness(?int $finess): Response
    {
        $strains = $this->getDoctrine()
            ->getRepository(Strain::class)
            ->findby(['finess'=>$finess]);
        return $this->render('strain/index.html.twig', [
            'strains' => $strains
        ]);
    }
}
