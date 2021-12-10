<?php

namespace App\Repository;

use App\Entity\Productcategory;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Productcategory|null find($id, $lockMode = null, $lockVersion = null)
 * @method Productcategory|null findOneBy(array $criteria, array $orderBy = null)
 * @method Productcategory[]    findAll()
 * @method Productcategory[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ProductcategoryRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Productcategory::class);
    }

    // /**
    //  * @return Productcategory[] Returns an array of Productcategory objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('p.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Productcategory
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
