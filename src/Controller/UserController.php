<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Form\SearchType;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\Search;
use App\Repository\CarRepository;

class UserController extends AbstractController
{
    /**
     * @Route("/", name="home")
     */
    public function Home(Request $request): Response
    {
        $search = new Search();
        $searchForm = $this->createForm(SearchType::class, $search);
        $searchForm->handleRequest($request);

        $car = [];
        $brand = [];

        if ($searchForm->isSubmitted() && $searchForm->isValid()) {
            $keyword = $search->getKeyword();

            if ($keyword != null) {
                $car = $this->getDoctrine()->getRepository(Car::class)->findBy(['model' => $keyword]);
            } else {
                $car = $this->getDoctrine()->getRepository(Car::class)->findAll();
            }

            if ($keyword != null && $car == null) {
                $brand = $this->getDoctrine()->getRepository(Brand::class)->findBy(['name' => $keyword]);
            } else {
                $brand = $this->getDoctrine()->getRepository(Brand::class)->findAll();
            }
        
        }

        return $this->render('base.html.twig', [
            'searchForm' => $searchForm->createView(),
            'cars' => $car,
            'brands' => $brand,
        ]);
    }
}
    