<?php

namespace App\Controller\Admin;

use App\Entity\Car;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\NumberField;
use phpDocumentor\Reflection\Types\Integer;

class CarCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Car::class;
    }

    
    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('model', 'Modèle'),
            IntegerField::new('year', 'Année'),
            TextField::new('motor', 'Moteur'),
            IntegerField::new('km', 'Kilométrage'),
            NumberField::new('stock', 'Stock'),
            DateField::new('date', 'Date de mise en vente')
        ];
    }
    
}
