<?php

namespace App\Repository;

use App\Entity\SignalementEsin;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method SignalementEsin|null find($id, $lockMode = null, $lockVersion = null)
 * @method SignalementEsin|null findOneBy(array $criteria, array $orderBy = null)
 * @method SignalementEsin[]    findAll()
 * @method SignalementEsin[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SignalementEsinRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, SignalementEsin::class);
    }

    // /**
    //  * @return SignalementEsin[] Returns an array of SignalementEsin objects
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
    public function findOneBySomeField($value): ?SignalementEsin
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
