<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class InscriptionController extends AbstractController
{
    #[Route('/inscription', name: 'app_inscription')]
    public function index(): Response
    {
        return $this->render('inscription/index.html.twig', [
            'controller_name' => 'InscriptionController',
        ]);
    }

    public function ajouterInscription(){
 
		$inscription = new inscription();
		$form = $this->createForm(InscriptionType::class, $inscription);
                return $this->render('etudiant/ajouter.html.twig', array(
                'form' => $form->createView(), ));
}
}
