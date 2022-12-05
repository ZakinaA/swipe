<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
use App\Entity\Eleve;
use App\Entity\Cours;
use App\Entity\Inscription;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Request;

class EleveController extends AbstractController
{
    #[Route('/eleve', name: 'app_eleve')]
    public function index(): Response
    {
        return $this->render('eleve/index.html.twig', [
            'controller_name' => 'EleveController',
        ]);
    }

    public function consulterEleve(ManagerRegistry $doctrine, int $id){

		$eleve= $doctrine->getRepository(Eleve::class)->find($id);
        $cours= $doctrine->getRepository(Cours::class)->findAll();

		if (!$eleve) {
			throw $this->createNotFoundException(
            'Aucun eleve trouvé avec le numéro '.$id
			);
		}
		return $this->render('eleve/consulter.html.twig', [
            'eleve' => $eleve,
            'cours' => $cours,]);

	}
}
