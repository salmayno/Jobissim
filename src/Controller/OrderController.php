<?php

namespace App\Controller;

use App\Classe\Mail;
use App\Entity\Message;
use App\Entity\User;
use App\Form\StopType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class OrderController extends AbstractController
{

    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    /**
     * @Route("/commande/stop", name="stop", methods={"POST", "GET"})
     */
    public function stop(Request $request)
    {
        $message = new Message();
        $form = $this->createForm(StopType::class, $message);
        $form->handleRequest($request);
        $id = 5;
        $users = $this->entityManager->getRepository(User::class)->findOneBy(['id' => $id]);

        if ($form->isSubmitted() && $form->isValid()) {
            $message->setFromId($this->getUser());
            $message->setToId($users);
            $message->setIsRead(0);
            $message->setSubject("Résiliation abonnement");
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($message);
            $entityManager->flush();

            $toId = "jobissim@jobissim.com";
            $firstName = "Jobissim";

            $mail = new Mail();
            $content = "Bonjour ".$firstName."<br/> Vous avez reçu une demande de résiliation d'abonnement.";
            $mail->send($toId, $firstName, 'Résiliation abonnement.', $content);

            return $this->redirectToRoute('account');
        }

        return $this->render('order/stop.html.twig', [
            'form' => $form->createView()
            ]);
    }




    /**
     * @Route("/commande/merci", name="order_validate")
     */
    public function success()
    {

        return $this->render('order/success.html.twig', [
        ]);
    }



    /**
     * @Route("/commande/erreur", name="order_cancel")
     */
    public function error()
    {

        return $this->render('order/cancel.html.twig', [
        ]);
    }
}
