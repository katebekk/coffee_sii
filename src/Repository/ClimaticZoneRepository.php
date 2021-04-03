<?php

namespace App\Repository;

use App\Entity\ClimaticZone;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method ClimaticZone|null find($id, $lockMode = null, $lockVersion = null)
 * @method ClimaticZone|null findOneBy(array $criteria, array $orderBy = null)
 * @method ClimaticZone[]    findAll()
 * @method ClimaticZone[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ClimaticZoneRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ClimaticZone::class);
    }

    // /**
    //  * @return ClimaticZone[] Returns an array of ClimaticZone objects
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
    public function findOneBySomeField($value): ?ClimaticZone
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
