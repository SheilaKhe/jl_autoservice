<?php

namespace App\Controller;

use App\Form\ContactType;
use App\Repository\BrandRepository;
use App\Repository\CarRepository;
use App\Repository\TypeRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\FormView;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Validator\Constraints\Email;


class CarController extends AbstractController
{
    /**
     * @Route("/car", name="car")
     */
    public function index(Request $request, MailerInterface $mailer, CarRepository $carRepository, BrandRepository $brandRepository, TypeRepository $typeRepository): Response
    {
        $cars = $carRepository->findAll();
        $brands = $brandRepository->findAll();

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

        return $this->render('car/index.html.twig', [
            'cars' => $cars,
            'brands' => $brands,
            'accessory' =>$accessory,
            'product' => $product,
            'form2' => $form2->createView(),
        ]);
    }

    /**
     * @Route("/filter/brand/{id}", name="car_filter_brand")
     */
    public function brand(Request $request, MailerInterface $mailer, CarRepository $carRepository, BrandRepository $brandRepository, TypeRepository $typeRepository, $id): Response
    {
        $brands = $brandRepository->findAll();
        $brand = $brandRepository->findOneById($id);
        $cars = $carRepository->findBy(['brand' => $id]);

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

        
        return $this->render('car/filter.html.twig', [
            'brands' => $brands,
            'brand' => $brand,
            'cars' => $cars,
            'accessory' =>$accessory,
            'product' => $product,
            'form2' => $form2->createView(),
        ]);
    }
    /**
     * @Route("/car/{id}", name="car_choice")
     */
    public function choice(Request $request, MailerInterface $mailer, CarRepository $carRepository, TypeRepository $typeRepository, $id): Response
    {
        $car = $carRepository->findOneById($id);

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

        return $this->render('car/car.html.twig', [
            'car' => $car,
            'accessory' =>$accessory,
            'product' => $product,
            'form2' => $form2->createView(),
        ]);
    }

}
