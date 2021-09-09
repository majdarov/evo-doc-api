<?php

namespace App\Repository;

use App\Entity\EvoDocument;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method EvoDocument|null find($id, $lockMode = null, $lockVersion = null)
 * @method EvoDocument|null findOneBy(array $criteria, array $orderBy = null)
 * @method EvoDocument[]    findAll()
 * @method EvoDocument[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class EvoDocumentRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, EvoDocument::class);
    }

    // /**
    //  * @return EvoDocument[] Returns an array of EvoDocument objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('e')
            ->andWhere('e.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('e.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?EvoDocument
    {
        return $this->createQueryBuilder('e')
            ->andWhere('e.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
