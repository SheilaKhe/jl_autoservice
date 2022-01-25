<?php

namespace App\Controller;

use App\Entity\Message;
use App\Form\ContactType;
use App\Repository\CarRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MailerController extends AbstractController
{
    /**
     * @Route("/contact/{id}", name="contact")
     */
    public function sendEmail(Request $req, $id, CarRepository $carRep)
    {
        $car = $carRep->find($id);
        $msg = new Message();
        $form = $this->createForm(ContactType::class, $msg);
        $form->handleRequest($req);

        if($form->isSubmitted()){
            $msg = $form->getData();
            $cnx = $this->getDoctrine()->getManager();
            $cnx->persist($msg);
            $cnx->flush();

            return $this->redirectToRoute('success');

        }
        return $this->render('contact/index.html.twig', [
            'form' => $form->createView(),
            'car' => $car,
        ]);
    }

    /**
     * @Route("/success", name="success")
     */
    public function successMsg() {
        return $this->render('contact/success.html.twig');
    }
}
