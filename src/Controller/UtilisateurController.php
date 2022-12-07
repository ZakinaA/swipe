<?php
 
namespace App\Controller;
 
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Request;

class UtilisateurController extends AbstractController
{
    /*
     * @Route("/utilisateur", name="utilisateur")
     */
    public function index()
    {
         return $this->render('accueil.html.twig');				         
    }

    public function consulter(ManagerRegistery $doctrine, string $mail){
        $responsable= $doctrine->getRepository(Responsable::class)->findByMail($mail);

        if (!$responsable) {
			$eleve= $doctrine->getRepository(Eleve::class)->findByMail($mail);

            if (!$eleve) {
                $professeur= $doctrine->getRepository(Professeur::class)->findByMail($mail);

                if (!$professeur) {
                    throw $this->createNotFoundException(
                        'Aucun compte trouvé avec le mail '.$mail
                        );
                }else{
                    return $this->redirectToRoute("path('ProfesseurConsulter', { 'mail': ".$professeur[0]." })"); 
                }
            }else{
                return $this->redirectToRoute("path('EleveConsulter', { 'mail': ".$eleve[0]." })"); 
            }
		}else{
            return $this->redirectToRoute("path('ResponsableConsulter', { 'mail': ".$responsable[0]." })"); 
        }
    }
}