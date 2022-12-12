<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\TypeInstrument;
use App\Entity\Instrument;
use App\Entity\ClasseInstrument;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Request;
use App\Form\InstrumentType;
use App\Entity\Accessoire;
use App\Entity\Intervenir;
use App\Entity\Emprunter;

class InstrumentController extends AbstractController
{
    #[Route('/instrument', name: 'app_instrument')]
    public function index(): Response
    {
        return $this->render('instrument/index.html.twig', [
            'controller_name' => 'InstrumentController',
        ]);
    }

public function listerTypeInstrument(ManagerRegistry $doctrine){

        $repository = $doctrine->getRepository(typeinstrument::class);

        $instruments= $repository->findAll();
        return $this->render('instrument/listerType.html.twig', [
    'pInstruments' => $instruments,]);	
    
}


public function consulterTypeInstrument(ManagerRegistry $doctrine, int $id){
		

    $instrument = $doctrine->getRepository(Instrument::class)->findByTypeInstrument($id);

    if (!$instrument) {
        throw $this->createNotFoundException(
        'Aucun instrument trouvé avec le numéro '.$id
        );
    }

    return $this->render('instrument/consulterTypeInstrument.html.twig', [
        'instrument' => $instrument,]);
}


public function consulterInstrument(ManagerRegistry $doctrine, int $id){
		

    $instrument = $doctrine->getRepository(Instrument::class)->find($id);

    if (!$instrument) {
        throw $this->createNotFoundException(
        'Aucun instrument trouvé avec le numéro '.$id
        );
    }

    return $this->render('instrument/consulter.html.twig', [
        'instrument' => $instrument,]);
}

public function consulterMaintenance(ManagerRegistry $doctrine, int $id){

    $instrument= $doctrine->getRepository(Instrument::class)->find($id);

    if (!$instrument) {
        throw $this->createNotFoundException(
        'Aucun instrument trouvé avec le numéro '.$id
        );
    }

    //return new Response('Instrument : '.$Instrument->getIntitule());
    return $this->render('instrument/consulterMaintenance.html.twig', [
        'instrument' => $instrument,
        ]);
}

public function instrumentListerTypeByID(ManagerRegistry $doctrine, int $id){
		

    $instrument = $doctrine->getRepository(TypeInstrument::class)->findByClasseInstrument($id);


    if (!$instrument) {
        throw $this->createNotFoundException(
        'Aucun instrument trouvé avec le numéro '.$id
        );
    }

    return $this->render('instrument/listerType.html.twig', [
        'pInstruments' => $instrument,]);
}

public function ajouterInstrument(ManagerRegistry $doctrine,Request $request){
    $instrument = new instrument();
    $form = $this->createForm(InstrumentType::class, $instrument);
    $form->handleRequest($request);
    if ($form->isSubmitted() && $form->isValid()) {

        $instrument = $form->getData();

        $entityManager = $doctrine->getManager();
        $entityManager->persist($instrument);
        $entityManager->flush();

    return $this->render('instrument/consulter.html.twig', ['instrument' => $instrument,]);
        }
    else
       {
        return $this->render('instrument/ajouter.html.twig', array('form' => $form->createView(),));
}
}

public function supprimerInstrument(ManagerRegistry $doctrine, int $id, Request $request){

    $accessoire = $doctrine->getRepository(Accessoire::class)->findByInstrument($id);
    $intervenir = $doctrine->getRepository(Intervenir::class)->findByInstrument($id);
    $emprunter = $doctrine->getRepository(Emprunter::class)->findByInstrument($id);
    $instrument = $doctrine->getRepository(Instrument::class)->find($id);

    if (!$instrument){
        throw $this->createNotFoundException('Aucun instrument trouvé avec cet id !');
    }
    else{
        $entityManager = $doctrine->getManager();
        if ($accessoire){
            for($i=0;$i<count($accessoire);$i++){
                $entityManager->remove($accessoire[$i]);
                $entityManager->flush();
            }
        }
        if ($intervenir){
            for($i=0;$i<count($intervenir);$i++){
                $entityManager->remove($intervenir[$i]);
                $entityManager->flush();
            }
        }
        if ($emprunter){
            for($i=0;$i<count($emprunter);$i++){
                $entityManager->remove($emprunter[$i]);
                $entityManager->flush();
            }
        }
        $entityManager->remove($instrument);
        $entityManager->flush();
        return $this->redirectToRoute('instrumentListerType');
    }
}
}
