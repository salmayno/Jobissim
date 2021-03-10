<?php

namespace App\Controller;

use Stripe\Stripe;
use Stripe\BillingPortal\Session;
use App\Form\CVUserType;
use App\Form\DataUserType;
use App\Form\ImageUserType;
use App\Form\LettreUserType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class AccountController extends AbstractController
{

    // Récuperer le manager

    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }


    /**
     * @Route("/compte", name="account")
     */
    public function index(Request $request): Response
    {
        $user = $this->getUser();
        $form = $this->createForm(DataUserType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $tel = $form->get('telephone')->getData();
            $adresse = $form->get('adresse')->getData();
            $ville = $form->get('ville')->getData();
            $postale = $form->get('postale')->getData();
            $about = $form->get('about')->getData();

            $user->setTelephone($tel);
            $user->setAdresse($adresse);
            $user->setVille($ville);
            $user->setPostale($postale);
            $user->setAbout($about);

            $this->entityManager->flush();

        return $this->redirectToRoute('account');

    }

        return $this->render('account/index.html.twig', [
            'form' => $form->createView(),
        ]);
    }


    /**
     * @Route("/compte/image", name="account_image")
     */
    public function image(Request $request): Response
    {
        $user = $this->getUser();
        $form = $this->createForm(ImageUserType::class, $user);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

                $image = $form->get('imageFile')->getData();
                $user->setImage($image);
                $this->entityManager->flush();

            return $this->redirectToRoute('account');

        }

        return $this->render('account/image.html.twig', [
            'form' => $form->createView(),
        ]);
    }



    /**
     * @Route("/compte/cv", name="account_cv")
     */
    public function cv(Request $request): Response
    {
        $user = $this->getUser();
        $form = $this->createForm(CVUserType::class, $user);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

                $cv = $form->get('cvFile')->getData();
                $user->setCv($cv);
                $this->entityManager->flush();

            return $this->redirectToRoute('account');

        }

        return $this->render('account/cv.html.twig', [
            'form' => $form->createView(),
        ]);
    }


    /**
     * @Route("/compte/lettre", name="account_lettre")
     */
    public function lettre(Request $request): Response
    {
        $user = $this->getUser();
        $form = $this->createForm(LettreUserType::class, $user);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

                $lettre = $form->get('lettreFile')->getData();
                $user->setLettre($lettre);
                $this->entityManager->flush();

            return $this->redirectToRoute('account');

        }

        return $this->render('account/lettre.html.twig', [
            'form' => $form->createView(),
        ]);
    }


    /**
     * @Route("/administrator/document/voir/{nom}")
     */
    // Pour afficher un fichier pdf dans le navigateur
    
    public function visualiserdocument($nom) {
        $projectRoot = $this->getParameter('kernel.project_dir');
        $filename = $nom;
        return $this->file( $projectRoot.'/public/uploads/'.$filename );
        }



    /**
     * @Route("/compte/cancel", name="cancelabo")
     */
    public function cancel(Request $request): Response
    {

        \Stripe\Stripe::setApiKey(

            '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'
            );
            $user = 'cus_J2ehtoQttyQNlr';

            $session = \Stripe\BillingPortal\Session::create([
              'customer' => $user,
              'return_url' => 'https://jobissim.com/compte',
            ]);
            
            header("Location: " . $session->url);
            
        return $this->render('account/cancel.html.twig', [
        ]);
    }


}
