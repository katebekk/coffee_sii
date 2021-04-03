<?php

namespace App\Repository;

use App\Entity\MethodOfProcessingCoffee;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method MethodOfProcessingCoffee|null find($id, $lockMode = null, $lockVersion = null)
 * @method MethodOfProcessingCoffee|null findOneBy(array $criteria, array $orderBy = null)
 * @method MethodOfProcessingCoffee[]    findAll()
 * @method MethodOfProcessingCoffee[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class MethodOfProcessingCoffeeRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, MethodOfProcessingCoffee::class);
    }

    // /**
    //  * @return MethodOfProcessingCoffee[] Returns an array of MethodOfProcessingCoffee objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('m')
            ->andWhere('m.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('m.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?MethodOfProcessingCoffee
    {
        return $this->createQueryBuilder('m')
            ->andWhere('m.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
