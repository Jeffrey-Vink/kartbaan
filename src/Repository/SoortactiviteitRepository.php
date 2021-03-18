<?php

namespace App\Repository;

use App\Entity\Soortactiviteit;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Soortactiviteit|null find($id, $lockMode = null, $lockVersion = null)
 * @method Soortactiviteit|null findOneBy(array $criteria, array $orderBy = null)
 * @method Soortactiviteit[]    findAll()
 * @method Soortactiviteit[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SoortactiviteitRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Soortactiviteit::class);
    }

    // /**
    //  * @return Soortactiviteit[] Returns an array of Soortactiviteit objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('s.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Soortactiviteit
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
