<?php

namespace App\Repository;

use App\Entity\ContragentType;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method ContragentType|null find($id, $lockMode = null, $lockVersion = null)
 * @method ContragentType|null findOneBy(array $criteria, array $orderBy = null)
 * @method ContragentType[]    findAll()
 * @method ContragentType[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ContragentTypeRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ContragentType::class);
    }

    // /**
    //  * @return ContragentType[] Returns an array of ContragentType objects
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
    public function findOneBySomeField($value): ?ContragentType
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
