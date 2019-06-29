<?php

namespace App\Repository;

use App\Entity\Loose;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Loose|null find($id, $lockMode = null, $lockVersion = null)
 * @method Loose|null findOneBy(array $criteria, array $orderBy = null)
 * @method Loose[]    findAll()
 * @method Loose[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class LooseRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Loose::class);
    }

    // /**
    //  * @return Loose[] Returns an array of Loose objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('l')
            ->andWhere('l.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('l.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Loose
    {
        return $this->createQueryBuilder('l')
            ->andWhere('l.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
