<?php

namespace App\Controller;

use App\Entity\Finess;
use App\Form\FinessType;
use App\Form\FinessUploadType;
use App\Repository\FinessRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Exception\ExceptionInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Service\FindFiness;
use App\Model\Upload;
use Symfony\Component\HttpClient\HttpClientInterface;
use Symfony\Component\HttpClient\HttpClient;

/**
 * @Route("/finess")
 */
class FinessController extends AbstractController
{
    /**
     * @Route("/", name="finess_index", methods={"GET"})
     */
    public function index(FinessRepository $finessRepository): Response
    {
        return $this->render('finess/index.html.twig', [
            'finesses' => $finessRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="finess_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $finess = new Finess();
        $form = $this->createForm(FinessType::class, $finess);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($finess);
            $entityManager->flush();

            return $this->redirectToRoute('finess_index');
        }

        return $this->render('finess/new.html.twig', [
            'finess' => $finess,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/show/{id}", name="finess_show", methods={"GET"})
     */
    public function show(Finess $finess): Response
    {
        return $this->render('finess/show.html.twig', [
            'finess' => $finess,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="finess_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Finess $finess): Response
    {
        $form = $this->createForm(FinessType::class, $finess);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('finess_index');
        }

        return $this->render('finess/edit.html.twig', [
            'finess' => $finess,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="finess_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Finess $finess): Response
    {
        if ($this->isCsrfTokenValid('delete'.$finess->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($finess);
            $entityManager->flush();
        }

        return $this->redirectToRoute('finess_index');
    }

    /**

     * @Route("/upload", name="finess_upload")

     */
    public function find(Request $request, FindFiness $finess)
    {
        $upload = new Upload();
        $form = $this->createForm(FinessUploadType::class, $upload);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $file = $upload->getUploadedFile();
            if ($file !== null) {
                $finess->recovery($file);
                return $this->redirectToRoute('finess_map');
            }
        }

        return $this->render(
            'finess/upload.html.twig',
            ['form' => $form->createView(),

            ]
        );
    }

    /*Route qui gère la recherche des automatique des coordonnées via l'api geo.api.gouv */

    /**
     * @Route("/coord/{id}", name="finess_coord", methods={"GET","POST"}, requirements = {"id": "\d+| "})
     */
    public function updateCoord(Finess $finess)
    {

        $ville=$finess->getVille();
        $adresse=$finess->getAdresse();
        $id=$finess->getId();
        $codePostal=$finess->getCodePostal();

        //connection à l'api
        $client = HttpClient::create();
        $url = "https://api-adresse.data.gouv.fr/search/?q=" . $adresse . " " . $ville .
            "&postcode=" . $codePostal . "&limit=1";

        try {
            $response = $client->request('GET', $url);
            $content = $response->toArray();
        } catch (ExceptionInterface $e) {
            return $this->render('finess/errorTemplate.html.twig', ['errors'=>["L'Api n'est pas disponible,
             veuillez trouvé l'adresse pour l'établissement " . $id . " , manuellement."], 'etab'=>$finess]);
        }

        // récupération et enregistrement des coordonnées si l'api en à trouvé autrement
        // renvoi d'un lien pour mettre à jour les coordonnées manuellement
        if (isset($content["features"][0]['geometry']['coordinates'])) {
            $coordsTab = $content["features"][0]['geometry']['coordinates'];
            $coords = $coordsTab[0] . "," . $coordsTab[1];
            $finess->setCoordinates($coords);
            $this->getDoctrine()->getManager()->flush();
        } else {
            return $this->render('finess/errorTemplate.html.twig', ['errors'=>["L'Api n'a pas trouvé 
            d'adresse pour l'établissement " . $id . ", veuillez rechercher les coordonnées manuellement."],
                'etab'=>$finess]);
        }


        return $this->redirectToRoute('finess_show', ['id'=>$id]);
    }

    /*Route qui gère la recherche des automatique d'un grand nombre de coordonnées via l'api geo.api.gouv
    pas de bouton , à lancer via la barre d'adresse, uniquement à l'usage d'un technicien
    enregistre les coordonnées ou renvoie un tableau d'erreurs contennant des liens pour mettre
    à jour manuellement les coordonnées */

    /**
     * @Route("/allcoords", name="AllCoord", methods={"GET","POST"})
     */
    public function allCoords(FinessRepository $finessRepository)
    {
        $finess = $finessRepository->findAll();
        $tabError=[];

        foreach ($finess as $etab) {
            $ville = $etab->getVille();
            $adresse = $etab->getAdresse();
            $codePostal = $etab->getCodePostal();
            $id = $etab->getId();


            $client = HttpClient::create();
            $url = "https://api-adresse.data.gouv.fr/search/?q=" . $adresse . " "
                . $ville . "&postcode=" . $codePostal . "&limit=1";

            try {
                $response = $client->request('GET', $url);
                $content = $response->toArray();
            } catch (ExceptionInterface $e) {
                array_push($tabError, ["la connection à échoué pour l'établissement" . $id .
                 " veuillez rechercher les coordonnées manuellement"]);
                continue;
            }

            if (isset($content["features"][0]['geometry']['coordinates'])) {
                $coordsTab = $content["features"][0]['geometry']['coordinates'];
                $coords = $coordsTab[0] . "," . $coordsTab[1];
                $etab->setCoordinates($coords);
                $this->getDoctrine()->getManager()->flush();
            } else {
                array_push($tabError, ["l'Api n'a pas trouvé d'adresse pour l'établissement " . $id .
                    " , veuillez rechercher les coordonnées manuellement.", $id]);
            }
            sleep(1);
        }

        if (empty($tabError) === false) {
            return $this->render('finess/errorTemplateMulti.html.twig', ['errors'=>$tabError]);
        } else {
            return $this->redirectToRoute('finess_index');
        }
    }
}
