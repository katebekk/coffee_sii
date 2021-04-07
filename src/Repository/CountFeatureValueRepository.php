<?php

namespace App\Repository;

use App\Entity\CountFeatureValue;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method CountFeatureValue|null find($id, $lockMode = null, $lockVersion = null)
 * @method CountFeatureValue|null findOneBy(array $criteria, array $orderBy = null)
 * @method CountFeatureValue[]    findAll()
 * @method CountFeatureValue[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CountFeatureValueRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CountFeatureValue::class);
    }

    // /**
    //  * @return CountFeatureValue[] Returns an array of CountFeatureValue objects
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
    public function findOneBySomeField($value): ?CountFeatureValue
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
