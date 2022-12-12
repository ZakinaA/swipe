<?php

namespace App\Controller;

use App\Entity\Compte;
use App\Entity\Eleve;
use App\Entity\Responsable;
use App\Entity\Professeur;
use App\Form\RegistrationFormType;
use App\Form\RegistrationFormEleveType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Contracts\Translation\TranslatorInterface;
use Doctrine\Persistence\ManagerRegistry;


class RegistrationEleveController extends AbstractController
{
    #[Route('/register', name: 'app_register')]
    public function register(ManagerRegistry $doctrine,Request $request, UserPasswordHasherInterface $userPasswordHasher, EntityManagerInterface $entityManager): Response
    {
        $user = new Compte();
        $user->setRoles(array('ROLE_ELEVE')); // Role USER par défaut
        $form = $this->createForm(RegistrationFormEleveType::class, $user);
        $form->handleRequest($request);


        

        if ($form->isSubmitted() && $form->isValid()) {
            // encode the plain password
            $user->setPassword(
                $userPasswordHasher->hashPassword(
                    $user,
                    $form->get('plainPassword')->getData()
                )
            );

            $user = $this->getUser();
            if(!empty($user)){
            $userId = $user->getResponsable()->getId();
            }

            $user = $form->getData();
            $responsable= $doctrine->getRepository(Responsable::class)->find($userId);
            $user->getEleve()->setResponsable($responsable);
            $entityManager = $doctrine->getManager();
            $entityManager->persist($user);
            $entityManager->flush();
            
            // do anything else you need here, like send an email

            return $this->redirectToRoute('route_accueil');
        }

        return $this->render('eleve/register.html.twig', [
            'registrationForm' => $form->createView(),
        ]);
    }
}
