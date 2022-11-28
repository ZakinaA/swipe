<?php
 
namespace App\Controller;
 
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
 
class UtilisateurController extends AbstractController
{
    /*
     * @Route("/utilisateur", name="utilisateur")
     */
    public function index()
    {
         return $this->render('accueil.html.twig');				         
    }
}