<?php

namespace App\Repository;

use App\Entity\Activiteit;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Activiteit|null find($id, $lockMode = null, $lockVersion = null)
 * @method Activiteit|null findOneBy(array $criteria, array $orderBy = null)
 * @method Activiteit[]    findAll()
 * @method Activiteit[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ActiviteitRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Activiteit::class);
    }

    public function getBeschikbareActiviteiten($userid)
    {
        $em=$this->getEntityManager();
        $query=$em->createQuery("SELECT a FROM App:Activiteit a WHERE :userid NOT MEMBER OF a.users ORDER BY a.datum");

        $query->setParameter('userid',$userid);

        return $query->getResult();
    }

    public function getIngeschrevenActiviteiten($userid)
    {

        $em=$this->getEntityManager();
        $query=$em->createQuery("SELECT a FROM App:Activiteit a WHERE :userid MEMBER OF a.users ORDER BY a.datum");

        $query->setParameter('userid',$userid);

        return $query->getResult();
    }

    public function getTotaal($activiteiten)
    {

        $totaal=0;
        foreach($activiteiten as $a)
        {
            $totaal+=$a->getSoort()->getPrijs();
        }
        return $totaal;

    }

    // /**
    //  * @return Activiteit[] Returns an array of Activiteit objects
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
    public function findOneBySomeField($value): ?Activiteit
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
