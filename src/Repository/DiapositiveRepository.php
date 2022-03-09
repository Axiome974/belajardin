<?php

namespace App\Repository;

use App\Entity\Diapositive;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Diapositive|null find($id, $lockMode = null, $lockVersion = null)
 * @method Diapositive|null findOneBy(array $criteria, array $orderBy = null)
 * @method Diapositive[]    findAll()
 * @method Diapositive[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class DiapositiveRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Diapositive::class);
    }

    // /**
    //  * @return Diapositive[] Returns an array of Diapositive objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('d')
            ->andWhere('d.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('d.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Diapositive
    {
        return $this->createQueryBuilder('d')
            ->andWhere('d.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
