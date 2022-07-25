<?php

namespace App\Controller\Admin;

use App\Entity\Article;
use App\Entity\Car;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use EasyCorp\Bundle\EasyAdminBundle\Router\AdminUrlGenerator;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DashboardController extends AbstractDashboardController
{
    /**
     * @Route("/admin", name="admin")
     */
    public function index(): Response
    {
        $adminUrlGenerator = $this->container->get(AdminUrlGenerator::class);

        // Option 1. Make your dashboard redirect to the same page for all users
        return $this->redirect($adminUrlGenerator->setController(CarCrudController::class)->generateUrl());

    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
        // the name visible to end users
        ->setTitle('JL Autoservice ')

        // by default EasyAdmin displays a black square as its default favicon;
        // use this method to display a custom favicon: the given path is passed
        // "as is" to the Twig asset() function:
        // <link rel="shortcut icon" href="{{ asset('...') }}">
        ->setFaviconPath('favicon.svg')

        // the domain used by default is 'messages'
        ->setTranslationDomain('my-custom-domain')

        // there's no need to define the "text direction" explicitly because
        // its default value is inferred dynamically from the user locale
        ->setTextDirection('ltr')

        // set this option if you prefer the page content to span the entire
        // browser width, instead of the default design which sets a max width
        ->renderContentMaximized()

        // set this option if you prefer the sidebar (which contains the main menu)
        // to be displayed as a narrow column instead of the default expanded design
        ->renderSidebarMinimized();

    }

    public function configureMenuItems(): iterable
    {
        return [
            MenuItem::linkToRoute('Retour vers le site', 'fas fa-globe', 'home'),
            MenuItem::linkToCrud('Article', 'fas fa-plus', Article::class),
            MenuItem::linkToCrud('Voiture', 'fas fa-car', Car::class),
            
            // yield MenuItem::linkToCrud('The Label', 'fas fa-list', EntityClass::class);

        ];
    }
}
