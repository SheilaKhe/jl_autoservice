<?php

namespace App\Controller\Admin;

use App\Entity\Accessory;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Car;
use App\Entity\Product;
use App\Entity\User;
use App\Entity\Service;


class DashboardController extends AbstractDashboardController
{
    /**
     * @Route("/admin", name="admin")
     */
    public function index(): Response
    {
        return parent::index();
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('JL AutoService')
            ->renderSidebarMinimized();
    }

    public function configureMenuItems(): iterable
    {
        return [
            MenuItem::linktoDashboard('Tableau de bord', 'fa fa-home'),

            MenuItem::section('Site'),
            MenuItem::linkToCrud('Voitures', 'fas fa-car', Car::class),
            MenuItem::linkToCrud('Produits', 'fas fa-list', Product::class),
            MenuItem::linkToCrud('Accessoires', 'fas fa-list', Accessory::class),
            MenuItem::linkToCrud('Services', 'fas fa-concierge-bell', Service::class),

            MenuItem::section('Utilisateurs'),
            MenuItem::linkToCrud('Membres', 'fa fa-user', User::class),
        ];
            
    }
}
