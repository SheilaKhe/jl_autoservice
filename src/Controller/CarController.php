<?php

namespace App\Controller;

use App\Repository\BrandRepository;
use App\Repository\CarRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CarController extends AbstractController
{
    /**
     * @Route("/car", name="car")
     */
    public function index(CarRepository $carrep, BrandRepository $brandrep): Response
    {
        $cars = $carrep->FindAll();

        return $this->render('car/index.html.twig', [
            'car' => $cars,
        ]);
    }

    /**
     * @Route("/car/{id}", name="detailsCar")
     */
    public function details(CarRepository $carrep, $id)
    {
        $car = $carrep->find($id);

        return $this->render('car/car.html.twig', [
            'car' => $car,
        ]);
    }
}
