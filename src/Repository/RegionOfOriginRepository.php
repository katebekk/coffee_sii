<?php

namespace App\Repository;

use App\Entity\RegionOfOrigin;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method RegionOfOrigin|null find($id, $lockMode = null, $lockVersion = null)
 * @method RegionOfOrigin|null findOneBy(array $criteria, array $orderBy = null)
 * @method RegionOfOrigin[]    findAll()
 * @method RegionOfOrigin[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class RegionOfOriginRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, RegionOfOrigin::class);
    }

    // /**
    //  * @return RegionOfOrigin[] Returns an array of RegionOfOrigin objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('r')
            ->andWhere('r.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('r.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?RegionOfOrigin
    {
        return $this->createQueryBuilder('r')
            ->andWhere('r.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
