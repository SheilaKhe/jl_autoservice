<?php

namespace App\Controller;

use App\Form\ContactType;
use App\Form\SearchArticleType;
use App\Repository\ArticleRepository;
use App\Repository\CarRepository;
use App\Repository\CategoryRepository;
use App\Repository\ServiceRepository;
use App\Repository\TypeRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Validator\Constraints\Email;

class MainController extends AbstractController
{
    /**
     * @Route("/", name="home")
     */
    public function index(CategoryRepository $categoryRepository, MailerInterface $mailer, TypeRepository $typeRepository, CarRepository $carRepository, ArticleRepository $articleRepository, ServiceRepository $serviceRepository, Request $request): Response
    {

        $types = $typeRepository->findAll();

        /* Lien redirigeant vers les différents types d'articles dans menu */
        $accessory = $typeRepository->findOneById('1');
        $product = $typeRepository->findOneById('2');

        $cars = $carRepository->findAll();
        $services = $serviceRepository->findAll();

        /* Trouver tous les accessoires */
        $acc = $categoryRepository->findBy(['type' => 1]);
        $accessories = $articleRepository->findBy(['category' => $acc]);
        /* Trouver les produits d'entretien */
        $pdt = $categoryRepository->findBy(['type' => 2]);
        $products = $articleRepository->findBy(['category' => $pdt]);

        /* Barre de recherche */
        $form = $this->createForm(SearchArticleType::class);
        $search = $form->handleRequest($request);

        // Formulaire de contact
        $form2 = $this->createForm(ContactType::class);
        $form2->handleRequest($request);

        // Recherche 
        if($form->isSubmitted() && $form->isValid()){
            // On recherche les articles correspondant aux mots clés
            $items = $articleRepository->search(
                $search->get('mots')->getData()
            );

            return $this->render('article/index.html.twig', [
                'items' => $items,
                'accessory' =>$accessory,
                'product' => $product,
                'types' => $types,
                'form2' => $form2->createView()
            ]); 
    
        }
            
        // Contact
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

        return $this->render('main/index.html.twig', [
            'accessory' =>$accessory,
            'product' => $product,
            'cars' => $cars,
            'accessories' => $accessories,
            'products' => $products,
            'services' => $services,
            'form' => $form->createView(),
            'form2' => $form2->createView(),
        ]);
    }
}
