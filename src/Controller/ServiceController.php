<?php

namespace App\Controller;

use App\Form\ContactType;
use App\Repository\ServiceRepository;
use App\Repository\TypeRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Validator\Constraints\Email;

class ServiceController extends AbstractController
{
    /**
     * @Route("/service", name="app_service")
     */
    public function index(Request $request, MailerInterface $mailer, ServiceRepository $serviceRepository, TypeRepository $typeRepository): Response
    {

        $services = $serviceRepository->findAll();

        /* Lien redirigeant vers les différents types d'articles dans menu */
        $accessory = $typeRepository->findOneById('1');
        $product = $typeRepository->findOneById('2');

            // Formulaire de contact
            $form2 = $this->createForm(ContactType::class);
            $form2->handleRequest($request);
    
    
            if($form2->isSubmitted() && $form2->isValid()) {
    
                $contactFormData = $form2->getData();
                
                $message = (new Email())
                    ->from($contactFormData['email'])
                    ->to('ton@gmail.com')
                    ->subject('Vous avez reçu un email')
                    ->text('Sender : '.$contactFormData['email'].\PHP_EOL.
                        $contactFormData['Message'],
                        'text/plain');
                $mailer->send($message);
    
                $this->addFlash('success', 'Vore message a été envoyé');
    
                return $this->redirectToRoute('home');
            }


        return $this->render('service/index.html.twig', [
            'services' => $services,
            'accessory' =>$accessory,
            'product' => $product,
            'form2' => $form2->createView(),
        ]);
    }
}
