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
}
