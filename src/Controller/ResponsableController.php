<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\Responsable;
use App\Form\ResponsableType;
use Doctrine\ORM\EntityManagerInterface;

class ResponsableController extends AbstractController
{
    #[Route('/responsable', name: 'app_responsable')]
    public function index(): Response
    {
        return $this->render('responsable/index.html.twig', [
            'controller_name' => 'ResponsableController',
        ]);
    }

    public function consulter(ManagerRegistry $doctrine, int $id)
    {

        $responsable = $doctrine->getRepository(Responsable::class)->find($id);

        if (!$responsable) {
            throw $this->createNotFoundException(
                'Aucun eleve trouvé avec le numéro ' . $id
            );
        }
        return $this->render('responsable/consulter.html.twig', [
            'responsable' => $responsable,
        ]);
    }

    public function modifier(ManagerRegistry $doctrine, $id, Request $request)
    {

        //récupération de le responsable dont l'id est passé en paramètre
        $responsable = $doctrine->getRepository(Responsable::class)->find($id);

        if (!$responsable) {
            throw $this->createNotFoundException('Aucun responsable trouvé avec le numéro ' . $id);
        } else {
            $form = $this->createForm(ResponsableType::class, $responsable);
            $form->handleRequest($request);

            if ($form->isSubmitted() && $form->isValid()) {

                $responsable = $form->getData();
                $entityManager = $doctrine->getManager();
                $entityManager->persist($responsable);
                $entityManager->flush();
                return $this->render('responsable/consulter.html.twig', ['responsable' => $responsable,]);
            } else {
                return $this->render('responsable/modifier.html.twig', array('form' => $form->createView(),));
            }
        }
    }
}
