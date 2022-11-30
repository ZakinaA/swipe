<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\ClasseInstrument;
use App\Entity\Instrument;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Request;

class ClasseInstrumentController extends AbstractController
{
    #[Route('/classe/instrument', name: 'app_classe_instrument')]
    public function index(): Response
    {
        return $this->render('classe_instrument/index.html.twig', [
            'controller_name' => 'ClasseInstrumentController',
        ]);
    }

    public function lister(ManagerRegistry $doctrine){
        $repository = $doctrine->getRepository(ClasseInstrument::class);
    
        $classeInstrument= $repository->findAll();
        return $this->render('instrument/listerClasseInstrument.html.twig', [
        'pclasseInstrument' => $classeInstrument,]);
    }
}
