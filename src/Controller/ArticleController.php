<?php

namespace App\Controller;

use App\Form\ContactType;
use App\Repository\ArticleRepository;
use App\Repository\CategoryRepository;
use App\Repository\TypeRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Validator\Constraints\Email;

class ArticleController extends AbstractController
{
    /**
     * @Route("/article", name="app_article")
     */
    public function index(Request $request, MailerInterface $mailer, ArticleRepository $articleRepository, TypeRepository $typeRepository, CategoryRepository $categoryRepository): Response
    {
        $items = $articleRepository->findAll();
        $types = $typeRepository->findAll();

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

        return $this->render('article/index.html.twig', [
            'items' => $items,
            'types' => $types,
            'accessory' =>$accessory,
            'product' => $product,
            'form2' => $form2->createView(),
        ]);
    }
    /**
     * @Route("/article/type/{id}", name="app_article_type")
     */
    public function byType(ArticleRepository $articleRepository, Request $request, MailerInterface $mailer, CategoryRepository $categoryRepository, TypeRepository $typeRepository, $id): Response
    {
        /* Type choisi (accessoires ou produits) */
        $type = $typeRepository->findOneById($id);

        /* Toutes les catégories selon le type choisi */
        $cat = $categoryRepository->findBy(['type' => $id]);

        /* Tous mes produits du type choisi */
        $items = $articleRepository->findBy(['category' => $cat]);

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
        
        
        return $this->render('article/type.html.twig', [
            'items' => $items,
            'category' => $cat,
            'type' => $type,
            'accessory' =>$accessory,
            'product' => $product,
            'form2' => $form2->createView(),
        ]);
    }
    /**
     * @Route("/article/cat/{id}", name="app_article_category")
     */
    public function category($id, MailerInterface $mailer, Request $request, ArticleRepository $articleRepository, CategoryRepository $categoryRepository, TypeRepository $typeRepository): Response
    {
        /* Catégorie choisie */
        $cat = $categoryRepository->findOneById($id);

        /* Tous les articles de la catégorie choisie */
        $article = $articleRepository->findBy(['category' => $id]);

        /* Toutes les catégories selon le type */
        $category = $cat->getType();

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


        return $this->render('article/category.html.twig', [
            'cat' => $cat,
            'items' => $article,
            'category' => $category,
            'accessory' =>$accessory,
            'product' => $product,
            'form2' => $form2->createView(),
        ]);
    }

    /**
     * @Route("/article/choice/{id}", name="app_article_choice")
     */
    public function choice($id, Request $request, MailerInterface $mailer, ArticleRepository $articleRepository, TypeRepository $typeRepository): Response
    {

        $article = $articleRepository->findOneById($id);

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

        return $this->render('article/article.html.twig', [
            'article' => $article,
            'accessory' =>$accessory,
            'product' => $product,
            'form2' => $form2->createView(),
        ]);
    }
    
}
