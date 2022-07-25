<?php

namespace App\Controller;

use App\Form\ContactType;
use App\Repository\TypeRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use Symfony\Component\Validator\Constraints\Email;
use Symfony\Component\HttpFoundation\Request;


class LoginController extends AbstractController
{
    /**
     * @Route("/login", name="login")
     */
    public function index(authenticationUtils $authenticationUtils, TypeRepository $typeRepository, MailerInterface $mailer, Request $request): Response
    {

        /* Lien redirigeant vers les différents types d'articles dans menu */
        $accessory = $typeRepository->findOneById('1');
        $product = $typeRepository->findOneById('2');

        // get the login error if there is one
        $error = $authenticationUtils->getLastAuthenticationError();

        // last username entered by the user
        $lastUserName = $authenticationUtils->getLastUsername();

        

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

        return $this->render('login/index.html.twig', [
            'last_username' => $lastUserName,
            'error' => $error,
            'accessory' =>$accessory,
            'product' => $product,
            'form2' => $form2->createView()
        ]);
    }
    /**
     * @Route("/logout", name="app_logout")
     */
    public function logout(): void
    {
        throw new \LogicException('This method can be blank - it will be intercepted by the logout key on your firewall.');
    }
}
