<?php
 
namespace App\Controller;
 
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
use App\Entity\Compte;
use App\Form\Inscription;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Request;

 
class CompteController extends AbstractController
{


    public function ajouter(Request $request,ManagerRegistry $doctrine){
 

        $compte = new compte();
        $form = $this->createForm(Inscription::class, $compte);
        $form->handleRequest($request);
     
        if ($form->isSubmitted() && $form->isValid()) {
     
                $compte = $form->getData();
    
                $entityManager = $doctrine->getManager();
                $entityManager->persist($compte);
                $entityManager->flush();
     
            return $this->render('accueil.html.twig', ['compte' => $compte,]);
        }
        else
            {
                return $this->render('compte/ajouter.html.twig', array('form' => $form->createView(),));
        }
    
    
    
    
    
    
    }


}