<?php

namespace App\Repository;

use App\Entity\ScoreDifficulties;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method ScoreDifficulties|null find($id, $lockMode = null, $lockVersion = null)
 * @method ScoreDifficulties|null findOneBy(array $criteria, array $orderBy = null)
 * @method ScoreDifficulties[]    findAll()
 * @method ScoreDifficulties[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ScoreDifficultiesRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ScoreDifficulties::class);
    }

    // /**
    //  * @return ScoreDifficulties[] Returns an array of ScoreDifficulties objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('s.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?ScoreDifficulties
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
