<?php

namespace App\Repository;

use App\Entity\QuanPossibleValues;
use App\Entity\QuanFeature;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method QuanPossibleValues|null find($id, $lockMode = null, $lockVersion = null)
 * @method QuanPossibleValues|null findOneBy(array $criteria, array $orderBy = null)
 * @method QuanPossibleValues[]    findAll()
 * @method QuanPossibleValues[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class QuanPossibleValuesRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, QuanPossibleValues::class);
    }

//     /**
//      * @return QuanPossibleValues[] Returns an array of QuanPossibleValues objects
//      */

    public function findByFeatureField($value)
    {
        return $this->createQueryBuilder('q')
            ->andWhere('q.id = :val')
            ->setParameter('val', $value)
            ->orderBy('q.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
        ;
    }



    /*public function findOneByFeatureField(): ?QuanPossibleValues
    {
        return $this->createQueryBuilder('q')
            ->andWhere('q.feature = :val')
            ->setParameter('val', 0 )
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }*/

}
