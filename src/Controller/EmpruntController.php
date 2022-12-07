<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Emprunter;
use App\Entity\Instrument;
use App\Entity\Eleve;
use App\Entity\TypeInstrument;
use Doctrine\Persistence\ManagerRegistry;

class EmpruntController extends AbstractController
{
    #[Route('/emprunt', name: 'app_emprunt')]
    public function index(): Response
    {
        return $this->render('emprunt/index.html.twig', [
            'controller_name' => 'EmpruntController',
        ]);
    }

    public function lister(ManagerRegistry $doctrine){
        $repository = $doctrine->getRepository(Emprunter::class);
        $emprunt = $repository->findAll();
        return $this->render('emprunt/lister.html.twig', [
            'pEmprunt' => $emprunt,]);	
    }

}