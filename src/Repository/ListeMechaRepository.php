<?php

namespace App\Repository;

use App\Entity\ListeMecha;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method ListeMecha|null find($id, $lockMode = null, $lockVersion = null)
 * @method ListeMecha|null findOneBy(array $criteria, array $orderBy = null)
 * @method ListeMecha[]    findAll()
 * @method ListeMecha[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ListeMechaRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ListeMecha::class);
    }

    // /**
    //  * @return ListeMecha[] Returns an array of ListeMecha objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('l')
            ->andWhere('l.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('l.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?ListeMecha
    {
        return $this->createQueryBuilder('l')
            ->andWhere('l.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
