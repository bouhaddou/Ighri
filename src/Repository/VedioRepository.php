<?php

namespace App\Repository;

use App\Entity\Vedio;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method Vedio|null find($id, $lockMode = null, $lockVersion = null)
 * @method Vedio|null findOneBy(array $criteria, array $orderBy = null)
 * @method Vedio[]    findAll()
 * @method Vedio[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class VedioRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Vedio::class);
    }

    // /**
    //  * @return Vedio[] Returns an array of Vedio objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('v')
            ->andWhere('v.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('v.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Vedio
    {
        return $this->createQueryBuilder('v')
            ->andWhere('v.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
