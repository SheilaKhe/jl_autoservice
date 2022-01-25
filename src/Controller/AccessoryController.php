<?php

namespace App\Controller;

use App\Entity\Accesscategory;
use App\Entity\Accessory;
use App\Repository\AccesscategoryRepository;
use App\Repository\AccessoryRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AccessoryController extends AbstractController
{
    /**
     * @Route("/accessory", name="accessory")
     */
    public function index(AccessoryRepository $accessrep, AccesscategoryRepository $accesscategoryRepo): Response
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
    public function detailsA(AccessoryRepository $accessrep, $id) 
    {     
        $access = $accessrep->find($id);

        return $this->render('accessory/details.html.twig', [
            'access' => $access,
        ]);
    }

    /**
     * @Route ("/acategory/{id}", name="acategory")
     */
    public function cat(AccessoryRepository $accessRep, AccessCategoryRepository $accessCatRep, $id) 
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
