<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\ArticleRepository;
use App\Repository\CategoryRepository;


class ArticleController extends AbstractController
{
    /**
     * @Route("/accessory", name="accessory")
     */
    public function index(ArticleRepository $accessrep, CategoryRepository $accesscategoryRepo): Response
    {
        $accessories = $accessrep->findAll();
        $accesscat = $accesscategoryRepo->findAll();

        return $this->render('accessory/index.html.twig', [
            'accessories' => $accessories,
            'accesscat' => $accesscat,
        ]);
    }
    /**
     * @Route("/accessory/{id}", name="detailsAccessory")
     */
    public function detailsA(ArticleRepository $accessrep, $id) 
    {     
        $access = $accessrep->find($id);

        return $this->render('accessory/details.html.twig', [
            'access' => $access,
        ]);
    }

    /**
     * @Route ("/acategory/{id}", name="acategory")
     */
    public function cat(ArticleRepository $accessRep, CategoryRepository $accessCatRep, $id) 
    {
        $catChoice = $accessCatRep->find($id);
        $cat = $accessRep->findBy(['category' => $id]);
        $accesscat = $accessCatRep->findAll();

        return $this->render('accessory/category.html.twig', [
            'cat' => $cat,
            'accesscat' => $accesscat,
            'catchoice' => $catChoice,
        ]);
    }

}
