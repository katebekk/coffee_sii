<?php

namespace App\Repository;

use App\Entity\CoffeeSort;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method CoffeeSort|null find($id, $lockMode = null, $lockVersion = null)
 * @method CoffeeSort|null findOneBy(array $criteria, array $orderBy = null)
 * @method CoffeeSort[]    findAll()
 * @method CoffeeSort[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CoffeeSortRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CoffeeSort::class);
    }

    // /**
    //  * @return CoffeeSort[] Returns an array of CoffeeSort objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('c.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBy($value): ?CoffeeSort
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
