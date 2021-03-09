<?php

namespace App\Repository;

use App\Entity\ChangeRequest;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method ChangeRequest|null find($id, $lockMode = null, $lockVersion = null)
 * @method ChangeRequest|null findOneBy(array $criteria, array $orderBy = null)
 * @method ChangeRequest[]    findAll()
 * @method ChangeRequest[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ChangeRequestRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ChangeRequest::class);
    }

    // /**
    //  * @return ChangeRequest[] Returns an array of ChangeRequest objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('c.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?ChangeRequest
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
