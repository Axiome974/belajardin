<?php

namespace App\Repository;

use App\Entity\FileUploaded;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method FileUploaded|null find($id, $lockMode = null, $lockVersion = null)
 * @method FileUploaded|null findOneBy(array $criteria, array $orderBy = null)
 * @method FileUploaded[]    findAll()
 * @method FileUploaded[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class FileUploadedRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, FileUploaded::class);
    }

    // /**
    //  * @return FileUploaded[] Returns an array of FileUploaded objects
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
    public function findOneBySomeField($value): ?FileUploaded
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
