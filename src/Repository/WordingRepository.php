<?php

namespace App\Repository;

use App\Entity\Wording;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method Wording|null find($id, $lockMode = null, $lockVersion = null)
 * @method Wording|null findOneBy(array $criteria, array $orderBy = null)
 * @method Wording[]    findAll()
 * @method Wording[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class WordingRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Wording::class);
    }

    // /**
    //  * @return Wording[] Returns an array of Wording objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('w')
            ->andWhere('w.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('w.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Wording
    {
        return $this->createQueryBuilder('w')
            ->andWhere('w.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
