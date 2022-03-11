<?php

namespace App\Repository;

use App\Entity\IconSection;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method IconSection|null find($id, $lockMode = null, $lockVersion = null)
 * @method IconSection|null findOneBy(array $criteria, array $orderBy = null)
 * @method IconSection[]    findAll()
 * @method IconSection[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class IconSectionRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, IconSection::class);
    }

    // /**
    //  * @return IconSection[] Returns an array of IconSection objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('i')
            ->andWhere('i.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('i.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?IconSection
    {
        return $this->createQueryBuilder('i')
            ->andWhere('i.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
