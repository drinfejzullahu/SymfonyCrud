<?php

namespace App\Repository;

use App\Entity\Perdoruesi;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method Perdoruesi|null find($id, $lockMode = null, $lockVersion = null)
 * @method Perdoruesi|null findOneBy(array $criteria, array $orderBy = null)
 * @method Perdoruesi[]    findAll()
 * @method Perdoruesi[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PerdoruesiRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Perdoruesi::class);
    }

    // /**
    //  * @return Perdoruesi[] Returns an array of Perdoruesi objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('p.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Perdoruesi
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
