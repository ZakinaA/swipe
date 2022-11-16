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
     	/* Cette simple instruction permet d'envoyer des informations au navigateur sans passer par une vue.
        return new Response('<html><body>Salut Les SIO</body></html>');
        */
 
         // initialise une variable qui sera exploitée dans la vue
         $annee = '2023';
         return $this->render('etudiant/accueil.html.twig', ['pAnnee' => $annee,
        ]);				         
    }
}