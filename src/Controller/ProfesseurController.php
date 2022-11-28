<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
use App\Entity\Professeur;
use App\Entity\Cours;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Request;

class ProfesseurController extends AbstractController
{
    #[Route('/professeur', name: 'app_professeur')]
    public function index(): Response
    {
        return $this->render('professeur/index.html.twig', [
            'controller_name' => 'ProfesseurController',
        ]);
    }

    public function consulterProfesseur(ManagerRegistry $doctrine, int $id){

		$professeur= $doctrine->getRepository(Professeur::class)->find($id);
        $cours= $doctrine->getRepository(Cours::class)->findByProfesseur($id);

		if (!$professeur) {
			throw $this->createNotFoundException(
            'Aucun professeur trouvé avec le numéro '.$id
			);
		}

		//return new Response('Professeur : '.$professeur->getNom());
		return $this->render('professeur/consulter.html.twig', [
            'professeur' => $professeur,
            'cours' => $cours,]);
	}
}
