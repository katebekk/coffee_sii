<?php

namespace App\Repository;

use App\Entity\CountPossibleValues;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method CountPossibleValues|null find($id, $lockMode = null, $lockVersion = null)
 * @method CountPossibleValues|null findOneBy(array $criteria, array $orderBy = null)
 * @method CountPossibleValues[]    findAll()
 * @method CountPossibleValues[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CountPossibleValuesRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CountPossibleValues::class);
    }

    // /**
    //  * @return CountPossibleValues[] Returns an array of CountPossibleValues objects
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
    public function findOneBySomeField($value): ?CountPossibleValues
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
