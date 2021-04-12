<?php

namespace App\Repository;

use App\Entity\Scores;
use App\Service\FilterRequest;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Scores|null find($id, $lockMode = null, $lockVersion = null)
 * @method Scores|null findOneBy(array $criteria, array $orderBy = null)
 * @method Scores[]    findAll()
 * @method Scores[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ScoresRepository extends ServiceEntityRepository implements ScoresRepositoryInterface
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Scores::class);
    }

    public function findByFilter(?int $user, ?int $score, ?string $difficulty, ?string $orderKey = null, ?string $orderDirection = null)
    {
        $qb = $this->createQueryBuilder('s');
        if (!is_null($user)) {
            $qb->andWhere('s.user = :user')
                ->setParameter('user', $user, Types::INTEGER);
        }

        if (!is_null($score)) {
            $qb->andWhere('s.score = :score')
                ->setParameter('score', $score, Types::INTEGER);
        }

        if (!is_null($difficulty)) {
            $qb->andWhere('s.difficulty = :difficulty')
                ->setParameter('difficulty', $difficulty, Types::INTEGER);
        }

        if (!is_null($orderKey)) {
            if (is_null($orderDirection) || !FilterRequest::inArray($orderDirection, ['asc', 'desc'])) {
                $orderDirection = 'asc';
            }
            $qb->orderBy('s.'. $orderKey, $orderDirection);
        }


        return $qb->getQuery()
            ->getResult();
    }

    // /**
    //  * @return Scores[] Returns an array of Scores objects
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
    public function findOneBySomeField($value): ?Scores
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
