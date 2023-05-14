<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Cours;
use App\Entity\TypeInstrument;
use App\Entity\Inscription;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Request;
use App\Form\AjouterCoursType;
use App\Form\ModifierCoursType;
use App\Form\InscriptionCoursType;

class CoursController extends AbstractController
{
    #[Route('/cours', name: 'app_cours')]
    public function index(): Response
    {
        return $this->render('cours/index.html.twig', [
            'controller_name' => 'CoursController',
        ]);
    }

    public function lister(ManagerRegistry $doctrine)
    {
        $repository = $doctrine->getRepository(Cours::class);
        $cours = $repository->findBy(array(), array('dateCours' => 'ASC'));
        return $this->render('cours/lister.html.twig', [
            'pCours' => $cours,
        ]);
    }

    public function consulterCours(ManagerRegistry $doctrine, int $id)
    {


        $cours = $doctrine->getRepository(Cours::class)->find($id);

        if (!$cours) {
            throw $this->createNotFoundException(
                'Aucun cours trouvé avec le numéro ' . $id
            );
        }

        return $this->render('cours/consulter.html.twig', [
            'cours' => $cours,
        ]);
    }

    public function supprimer(ManagerRegistry $doctrine, int $id)
    {
        $cours = $doctrine->getRepository(Cours::class)->find($id);
        $entityManager = $doctrine->getManager();
        $entityManager->remove($cours);
        $entityManager->flush();
        return $this->redirectToRoute('coursLister');
    }


    public function ajouterCours(ManagerRegistry $doctrine, Request $request)
    {
        $cours = new cours();
        if ($this->getUser()->getProfesseur() != null) {
            $form = $this->createForm(AjouterCoursType::class, $cours, [
                'prof_id' => $this->getUser()->getProfesseur()->getId(),
            ]);
        } else {
            $form = $this->createForm(AjouterCoursType::class, $cours, [
                'prof_id' => null,
            ]);
        }
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $doctrine->getManager();
            $entityManager->persist($cours);
            $entityManager->flush();

            return $this->render('cours/consulter.html.twig', [
                'cours' => $cours,
            ]);
        } else {
            return $this->render('cours/ajouter.html.twig', array('form' => $form->createView(),));
        }
    }

    public function modifierCours(ManagerRegistry $doctrine, $id, Request $request)
    {

        //récupération de l'étudiant dont l'id est passé en paramètre
        $cours = $doctrine->getRepository(Cours::class)->find($id);

        if (!$cours) {
            throw $this->createNotFoundException('Aucun cours trouvé avec le numéro ' . $id);
        } else {
            if ($this->getUser()->getProfesseur() != null) {
                $form = $this->createForm(ModifierCoursType::class, $cours, [
                    'prof_id' => $this->getUser()->getProfesseur()->getId(),
                ]);
            } else {
                $form = $this->createForm(ModifierCoursType::class, $cours, [
                    'prof_id' => null,
                ]);
            }
            $form->handleRequest($request);

            if ($form->isSubmitted() && $form->isValid()) {

                $cours = $form->getData();

                $entityManager = $doctrine->getManager();
                $entityManager->persist($cours);
                $entityManager->flush();

                return $this->render('cours/consulter.html.twig', [
                    'cours' => $cours,
                ]);
            } else {
                return $this->render('cours/modifier.html.twig', array('form' => $form->createView(),));
            }
        }
    }
    public function supprimerCoursEleve(ManagerRegistry $doctrine, int $id)
    {

        $inscription = $doctrine->getRepository(Inscription::class)->find($id);

        if (!$inscription) {
            throw $this->createNotFoundException('Aucun cours avec cet élève trouvé avec cet id !');
        } else {
            $entityManager = $doctrine->getManager();
            $entityManager->remove($inscription);
            $entityManager->flush();
            return $this->redirectToRoute('route_accueil');
        }
    }

    public function ajouterCoursEleve(ManagerRegistry $doctrine, Request $request)
    {
        $inscription = new Inscription();
        if ($this->getUser()->getEleve() != null) {
            $form = $this->createForm(InscriptionCoursType::class, $inscription, [
                'eleve_id' => $this->getUser()->getEleve()->getId(),
            ]);
        } else {
            $form = $this->createForm(InscriptionCoursType::class, $inscription, [
                'eleve_id' => null,
            ]);
        }
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $inscription = $form->getData();

            $entityManager = $doctrine->getManager();
            $entityManager->persist($inscription);
            $entityManager->flush();

            return $this->redirectToRoute('coursLister');
        } else {
            return $this->render('inscription/ajouter.html.twig', array('form' => $form->createView(),));
        }
    }
}
