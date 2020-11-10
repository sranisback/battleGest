<?php

namespace App\Repository;

use App\Entity\Mecha;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Mecha|null find($id, $lockMode = null, $lockVersion = null)
 * @method Mecha|null findOneBy(array $criteria, array $orderBy = null)
 * @method Mecha[]    findAll()
 * @method Mecha[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class MechaRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Mecha::class);
    }

    // /**
    //  * @return Mecha[] Returns an array of Mecha objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('m')
            ->andWhere('m.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('m.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Mecha
    {
        return $this->createQueryBuilder('m')
            ->andWhere('m.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
