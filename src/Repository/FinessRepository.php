<?php

namespace App\Repository;

use App\Entity\Finess;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Finess|null find($id, $lockMode = null, $lockVersion = null)
 * @method Finess|null findOneBy(array $criteria, array $orderBy = null)
 * @method Finess[]    findAll()
 * @method Finess[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class FinessRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Finess::class);
    }

    // /**
    //  * @return Finess[] Returns an array of Finess objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('f')
            ->andWhere('f.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('f.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Finess
    {
        return $this->createQueryBuilder('f')
            ->andWhere('f.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
