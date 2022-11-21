<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Instrument;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Request;

class InstrumentController extends AbstractController
{
    #[Route('/instrument', name: 'app_instrument')]
    public function index(): Response
    {
        return $this->render('instrument/index.html.twig', [
            'controller_name' => 'InstrumentController',
        ]);
    }

    public function listerInstrument(ManagerRegistry $doctrine){

            $repository = $doctrine->getRepository(Instrument::class);

            $instruments= $repository->findAll();
            return $this->render('instrument/lister.html.twig', [
        'pInstruments' => $instruments,]);	
    
}

}
