<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
use App\Entity\Eleve;
use App\Entity\Emprunter;
use App\Entity\Cours;
use App\Entity\Inscription;
use App\Entity\Compte;
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

    public function ML(ManagerRegistry $doctrine){
		return $this->render('mentionsLegales.html.twig');
	}

    public function PC(ManagerRegistry $doctrine){
		return $this->render('politiqueCo.html.twig');
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

    public function supprimerEleve(ManagerRegistry $doctrine, int $id){

        $eleve= $doctrine->getRepository(Eleve::class)->find($id);
        $inscrire = $doctrine->getRepository(Inscription::class)->findByEleve($id);
        $emprunter = $doctrine->getRepository(Emprunter::class)->findByEleve($id);
        $compte = $doctrine->getRepository(Compte::class)->findOneByEleve($id);

        if (!$eleve){
            throw $this->createNotFoundException('Aucun élève trouvé avec cet id !');
        }
        else{
            $entityManager = $doctrine->getManager();
            if ($inscrire){
                for($i=0;$i<count($inscrire);$i++){
                    $entityManager->remove($inscrire[$i]);
                    $entityManager->flush();
                }
            }
            if ($emprunter){
                for($i=0;$i<count($emprunter);$i++){
                    $entityManager->remove($emprunter[$i]);
                    $entityManager->flush();
                }
            }
            $compte->setEleve(null);
            $entityManager->flush();

            $entityManager->remove($compte);
            $entityManager->remove($eleve);
            $entityManager->flush();
            return $this->redirectToRoute('route_accueil');
        }
    }
}