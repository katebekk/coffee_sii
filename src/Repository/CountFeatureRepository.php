<?php

namespace App\Repository;

use App\Entity\CountFeature;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method CountFeature|null find($id, $lockMode = null, $lockVersion = null)
 * @method CountFeature|null findOneBy(array $criteria, array $orderBy = null)
 * @method CountFeature[]    findAll()
 * @method CountFeature[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CountFeatureRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CountFeature::class);
    }

    // /**
    //  * @return CountFeature[] Returns an array of CountFeature objects
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
    public function findOneBySomeField($value): ?CountFeature
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
