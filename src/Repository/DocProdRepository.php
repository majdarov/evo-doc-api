<?php

namespace App\Repository;

use App\Entity\DocProd;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method DocProd|null find($id, $lockMode = null, $lockVersion = null)
 * @method DocProd|null findOneBy(array $criteria, array $orderBy = null)
 * @method DocProd[]    findAll()
 * @method DocProd[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class DocProdRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, DocProd::class);
    }

    // /**
    //  * @return DocProd[] Returns an array of DocProd objects
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
    public function findOneBySomeField($value): ?DocProd
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
