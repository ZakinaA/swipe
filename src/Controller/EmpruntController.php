<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Emprunter;
use App\Entity\Instrument;
use App\Entity\Eleve;
use App\Entity\TypeInstrument;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Persistence\ManagerRegistry;
use App\Form\EmpruntType;
use Symfony\Component\Security\Core\Security;

class EmpruntController extends AbstractController
{
    #[Route('/emprunt', name: 'app_emprunt')]
    public function index(): Response
    {
        return $this->render('emprunt/index.html.twig', [
            'controller_name' => 'EmpruntController',
        ]);
    }

    public function lister(ManagerRegistry $doctrine)
    {
        $repository = $doctrine->getRepository(Emprunter::class);
        $emprunt = $repository->findAll();
        return $this->render('emprunt/lister.html.twig', [
            'pEmprunt' => $emprunt,
        ]);
    }

    public function consulter(ManagerRegistry $doctrine, int $id)
    {

        $eleve = $doctrine->getRepository(Eleve::class)->find($id);
        $emprunt = $doctrine->getRepository(Emprunter::class)->findAll();

        if (!$eleve) {
            throw $this->createNotFoundException(
                'Aucun eleve trouvé avec le numéro ' . $id
            );
        }
        return $this->render('emprunt/consulter.html.twig', [
            'eleve' => $eleve,
            'emprunts' => $emprunt,
        ]);
    }

    public function ajouter(ManagerRegistry $doctrine, Request $request, int $id)
    {
        $emprunt = new emprunter();
        $form = $this->createForm(EmpruntType::class, $emprunt);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {


            $user = $this->getUser();
            if (!empty($user)) {
                $userId = $user->getEleve()->getId();
            }

            $emprunt = $form->getData();
            $eleve = $doctrine->getRepository(Eleve::class)->find($userId);
            $emprunt->setEleve($eleve);
            $entityManager = $doctrine->getManager();
            $entityManager->persist($emprunt);
            $entityManager->flush();

            return $this->render('emprunt/consulter.html.twig', [
                'emprunt' => $emprunt,
                'eleve' => $eleve,
            ]);
        } else {
            return $this->render('emprunt/ajouter.html.twig', array('form' => $form->createView(),));
        }
    }

    public function supprimer(ManagerRegistry $doctrine, int $id)
    {
        $emprunt = $doctrine->getRepository(Emprunter::class)->find($id);
        $entityManager = $doctrine->getManager();
        $entityManager->remove($emprunt);
        $entityManager->flush();
        return $this->redirectToRoute('empruntConsulter', ['id' => $this->getUser()->getEleve()->getId()]);
    }
}
