<?php

namespace App\Controller;

use App\Classe\Mail;
use App\Form\CVUserType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class SubController extends AbstractController
{

    // Récuperer le manager

    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }


    /**
     * @Route("/subscription", name="subscription")
     */
    public function index(): Response
    {            
        return $this->render('paiement/sub.html.twig', [
        ]);
    }


    /**
     * @Route("/subscription/contrat", name="contrat", methods={"GET","POST"})
     */
    public function contrat(Request $request): Response
    {
        $user = $this->getUser();
        $form = $this->createForm(CVUserType::class, $user);
        $form->handleRequest($request);
        $roles = $user->getRoles();

        if ($form->isSubmitted() && $form->isValid()) {
            
            array_push($roles, "ROLE_FORMATEUR_VALIDE");
            if ($user->getRoles() != ["ROLE_FORMATEUR_VALIDE"]) {
                $user->setRoles($roles);
            }

            $cv = $form->get('cvFile')->getData();
            $user->setCv($cv);
            $this->entityManager->persist($user);
            $this->entityManager->flush();
            $toId = "jobissim@jobissim.com";
            $lastName = $this->getUser()->getLastName();
            $name = "Jobissim";

            $mail = new Mail();
            $content = $lastName."Vient de remettre son contrat d'apporteur d'affaires signé.";
            $mail->send($toId, $name, 'Nouveau contrat signé.', $content);

            return $this->redirectToRoute('app_login');

        }

        return $this->render('paiement/contrat.html.twig', [
            'form' => $form->createView()
        ]);
    }




    /**
     * @Route("/subscription/free", name="freesub")
     */
    public function free(Request $request): Response
    {
        $user = $this->getUser();
        $roles = $user->getRoles();
        array_push($roles, "ROLE_EMPLOYEUR_1");
        if ($user->getRoles() != ["ROLE_EMPLOYEUR_1"]) {
            $user->setRoles($roles);
        }
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->persist($user);
        $entityManager->flush();

        return $this->redirectToRoute('app_login');

        return $this->render('paiement/sub.html.twig', [
        ]);
    }





    /**
     * @Route("/subscription/cinq", name="cinqsub")
     */
    public function cinq(Request $request): Response
    {
        $user = $this->getUser();
        $roles = $user->getRoles();
        array_push($roles, "ROLE_EMPLOYEUR_5", "ROLE_EVALUATION", "ROLE_CVTHEQUE");
        if ($user->getRoles() != ["ROLE_EMPLOYEUR_5", "ROLE_EVALUATION", "ROLE_CVTHEQUE"]) {
            $user->setRoles($roles);
        }
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->persist($user);
        $entityManager->flush();

        return $this->redirectToRoute('app_login');

        return $this->render('paiement/sub.html.twig', [
        ]);
    }


    /**
     * @Route("/subscription/dix", name="dixsub")
     */
    public function dix(Request $request): Response
    {
        $user = $this->getUser();
        $roles = $user->getRoles();
        array_push($roles, "ROLE_EMPLOYEUR_10", "ROLE_EVALUATION", "ROLE_CVTHEQUE", "ROLE_STATS");
        if ($user->getRoles() != ["ROLE_EMPLOYEUR_10", "ROLE_EVALUATION", "ROLE_CVTHEQUE", "ROLE_STATS"]) {
            $user->setRoles($roles);
        }
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->persist($user);
        $entityManager->flush();

        return $this->redirectToRoute('app_login');

        return $this->render('paiement/sub.html.twig', [
        ]);
    }


    /**
     * @Route("/subscription/illimite", name="illimitesub")
     */
    public function illimite(Request $request): Response
    {
        $user = $this->getUser();
        $roles = $user->getRoles();
        array_push($roles, "ROLE_EMPLOYEUR_ILLIMITE", "ROLE_EVALUATION", "ROLE_CVTHEQUE", "ROLE_STATS", "ROLE_VISIO");
        if ($user->getRoles() != ["ROLE_EMPLOYEUR_ILLIMITE", "ROLE_EVALUATION", "ROLE_CVTHEQUE", "ROLE_STATS", "ROLE_VISIO"]) {
            $user->setRoles($roles);
        }
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->persist($user);
        $entityManager->flush();

        return $this->redirectToRoute('app_login');

        return $this->render('paiement/sub.html.twig', [
        ]);
    }


    /**
     * @Route("/subscription/option", name="optionsub")
     */
    public function option(Request $request): Response
    {
        $user = $this->getUser();
        $roles = $user->getRoles();
        array_push($roles, "ROLE_EVALUATION", "ROLE_CVTHEQUE", "ROLE_STATS", "ROLE_VISIO");
        if ($user->getRoles() != ["ROLE_EVALUATION", "ROLE_CVTHEQUE", "ROLE_STATS", "ROLE_VISIO"]) {
            $user->setRoles($roles);
        }
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->persist($user);
        $entityManager->flush();

        return $this->redirectToRoute('app_login');

        return $this->render('paiement/sub.html.twig', [
        ]);
    }



}




