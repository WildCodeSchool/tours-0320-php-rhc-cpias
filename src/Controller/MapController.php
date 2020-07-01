<?php

namespace App\Controller;

use App\Form\MapSelectionType;
use App\Entity\Strain;
use App\Entity\Finess;
use App\Entity\Esin;
use App\Repository\StrainRepository;
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

    //Affiche les entité "finness" sur la carte en fonction du tri
    //et toutes les entités si il n'y a pas de tri

    /**
     * @Route("/", name="finess_map", methods={"GET"})
     * @param FinessRepository $finessRepository
     * @return Response
     */
    public function index(FinessRepository $finessRepository, Request $request, StrainRepository $strainRepo): Response
    {
        $form = $this->createForm(
            MapSelectionType::class,
            null,
            ['method'=>Request::METHOD_GET]
        );

        $form->handleRequest($request);
        if ($form->isSubmitted()) {
            $data = $form->getData();
            // si le form est vide le controlleur renvoie tt les établissements
            if ($data['microOrganisme']== 'Laisser vide') {
                $fine = $finessRepository->findAll();
            //sinon il affiche les établissement dans lesquel la souche selectionnée a été trouvée
            } else {
                //un établissement contient plusieurs souche, récupération des souches qui ont le nom envoyé par le form
                $strains = $strainRepo->findBy(['microOrganisme' => $data['microOrganisme']]);
                //pour chaque souche récupération l'établissement auquel elle est ratachée
                $fine=[];
                foreach ($strains as $strain) {
                    $hopital=$strain->getFiness();
                    if (in_array($hopital, $fine)==false) {
                        array_push($fine, $hopital);
                    }
                }
            }
        } else {
            $fine = $finessRepository->findAll();
        }

        return $this->render('map/index.html.twig', [
            'finess' => $fine,
            'form' => $form->createView()
        ]);
    }


    // renvoie la "page d'acceuil" de la carte

    /**
     * @param int $finess
     * @Route("/strainByFiness/{finess}",name="strain_finess", methods={"GET"})
     * @return Response
     */
    public function strainByFiness(int $finess): Response
    {
        $strains = $this->getDoctrine()
            ->getRepository(Strain::class)
            ->findby(['finess'=>$finess]);
        return $this->render('strain/index.html.twig', [
            'strains' => $strains
        ]);
    }


    //Est appelé quand on clique sur le nom d'un établissement sur la carte,
    //renvoie la carte ainsi que toutes les souches et tous les signalements associés
    // à l'établissement cliqué

    /**
     * @param int $numFiness
     * @param int $id
     * @Route("/strainEsinByFiness/{id}/{numFiness}",name="strainEsin_finess", methods={"GET"})
     * @return Response
     */
    public function strainEsinByFiness(int $id, int $numFiness): Response
    {
        $fine = $this->getDoctrine()
            ->getRepository(Finess::class)
            ->findAll();

        $strains = $this->getDoctrine()
            ->getRepository(Strain::class)
            ->findby(['finess'=>$id]);

        $esins = $this->getDoctrine()
            ->getRepository(Esin::class)
            ->findby(['codeFinessEtab'=>$numFiness]);


        return $this->render('map/show.html.twig', [
            'strains' => $strains, 'esins' => $esins, 'finess' => $fine
        ]);
    }
}
