<?php

namespace App\Controller;

use App\Form\ImportFichierMulType;
use App\Service\ImportMULService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;

class ImportFichierMulController extends AbstractController
{
    /**
     * @Route("/import/fichier/mul", name="import_fichier_mul")
     * @param Request $request
     * @param ImportMULService $importMULService
     * @return Response
     */
    public function index(Request $request, ImportMULService $importMULService): Response
    {
        $form = $this->createForm(ImportFichierMulType::class);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $fichier = $request->files->all();
            $repertoireFichiersMul = $this->getParameter('repertoire_mul');

            $fichierSauvegarde = $importMULService->sauvegarderFichier(
                $fichier['import_fichier_mul']['fichierMul'],
                $repertoireFichiersMul
            );
            $importMULService->traiteFichier($repertoireFichiersMul . DIRECTORY_SEPARATOR . $fichierSauvegarde);
            return $this->render('ok.html.twig', ['content' => 'ok']);
        }

        return $this->render('import_fichier_mul/index.html.twig', [
            'form' => $form->createView()
        ]);
    }
}
