<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
use App\Entity\Professeur;
use App\Entity\Cours;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Request;
use App\Form\ProfesseurType;

class ProfesseurController extends AbstractController
{
    #[Route('/professeur', name: 'app_professeur')]
    public function index(): Response
    {
        return $this->render('professeur/index.html.twig', [
            'controller_name' => 'ProfesseurController',
        ]);
    }

    public function consulterProfesseur(ManagerRegistry $doctrine, int $id)
    {

        $professeur = $doctrine->getRepository(Professeur::class)->find($id);
        $cours = $doctrine->getRepository(Cours::class)->findByProfesseur($id);

        if (!$professeur) {
            throw $this->createNotFoundException(
                'Aucun professeur trouvé avec le numéro ' . $id
            );
        }

        //return new Response('Professeur : '.$professeur->getNom());
        return $this->render('professeur/consulter.html.twig', [
            'professeur' => $professeur,
            'cours' => $cours,
        ]);
    }

    public function modifier(ManagerRegistry $doctrine, $id, Request $request)
    {

        //récupération de le responsable dont l'id est passé en paramètre
        $professeur = $doctrine->getRepository(Professeur::class)->find($id);

        if (!$professeur) {
            throw $this->createNotFoundException('Aucun responsable trouvé avec le numéro ' . $id);
        } else {
            $form = $this->createForm(ProfesseurType::class, $professeur);
            $form->handleRequest($request);

            if ($form->isSubmitted() && $form->isValid()) {

                $professeur = $form->getData();
                $entityManager = $doctrine->getManager();
                $entityManager->persist($professeur);
                $entityManager->flush();
                return $this->render('professeur/consulter.html.twig', ['professeur' => $professeur,]);
            } else {
                return $this->render('professeur/modifier.html.twig', array('form' => $form->createView(),));
            }
        }
    }
}
