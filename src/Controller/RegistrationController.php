<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\ContactType;
use App\Form\RegistrationFormType;
use App\Repository\TypeRepository;
use App\Security\EmailVerifier;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Contracts\Translation\TranslatorInterface;
use SymfonyCasts\Bundle\VerifyEmail\Exception\VerifyEmailExceptionInterface;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Validator\Constraints\Email;

class RegistrationController extends AbstractController
{

    /**
     * @Route("/register", name="app_register")
     */
    public function register(Request $request, MailerInterface $mailer, UserPasswordHasherInterface $userPasswordHasher, EntityManagerInterface $entityManager, TypeRepository $typeRepository): Response
    {
        /* Lien redirigeant vers les différents types d'articles dans menu */
        $accessory = $typeRepository->findOneById('1');
        $product = $typeRepository->findOneById('2');

        $user = new User();
        $form = $this->createForm(RegistrationFormType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            
            // encode the plain password
            $user->setPassword(
            $userPasswordHasher->hashPassword(
                    $user,
                    $form->get('plainPassword')->getData()
                )
            );

            if ($user->getEmail() == 'khedoo.sheila@gmail.com') {
                $user->setRoles(['ROLE_ADMIN']);
            }

            $entityManager->persist($user);
            $entityManager->flush();
            // do anything else you need here, like send an email

            return $this->redirectToRoute('login');
        }

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

        return $this->render('registration/register.html.twig', [
            'registrationForm' => $form->createView(),
            'accessory' =>$accessory,
            'product' => $product,
            'form2' => $form2->createView()
        ]);
    }

}
