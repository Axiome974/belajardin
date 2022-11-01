<?php

namespace App\Repository;

use App\Entity\VisitorMessage;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method VisitorMessage|null find($id, $lockMode = null, $lockVersion = null)
 * @method VisitorMessage|null findOneBy(array $criteria, array $orderBy = null)
 * @method VisitorMessage[]    findAll()
 * @method VisitorMessage[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class VisitorMessageRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, VisitorMessage::class);
    }

    // /**
    //  * @return VisitorMessage[] Returns an array of VisitorMessage objects
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
    public function findOneBySomeField($value): ?VisitorMessage
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
