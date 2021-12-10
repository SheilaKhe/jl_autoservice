<?php

namespace App\Repository;

use App\Entity\Accesscategory;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Accesscategory|null find($id, $lockMode = null, $lockVersion = null)
 * @method Accesscategory|null findOneBy(array $criteria, array $orderBy = null)
 * @method Accesscategory[]    findAll()
 * @method Accesscategory[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AccesscategoryRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Accesscategory::class);
    }

    // /**
    //  * @return Accesscategory[] Returns an array of Accesscategory objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('a.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Accesscategory
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
