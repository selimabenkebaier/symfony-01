<?php

namespace App\Repository;

use App\Entity\Beer;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Beer|null find($id, $lockMode = null, $lockVersion = null)
 * @method Beer|null findOneBy(array $criteria, array $orderBy = null)
 * @method Beer[]    findAll()
 * @method Beer[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class BeerRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Beer::class);
    }

    /**
     * @return Beer[] Returns an array of Beer objects
     */
    public function findLastBeers()
    {
        return $this->createQueryBuilder('b')
            ->orderBy('b.id', 'DESC')
            ->setMaxResults(3)
            ->getQuery()
            ->getResult()
            ;
    }

    /**
     * @return Beer[] Returns an array of Beer objects
     */
    public function findBeerByCategoryId($id)
    {
        return $this->createQueryBuilder('b')
            ->join('b.category','c')
            ->where('c.id = :id')
            ->setParameter('id',$id)
            ->getQuery()
            ->getResult()
            ;
    }

    public function findBeerByCountryId(int $id)
    {
        return $this->createQueryBuilder('b')
            ->join('b.country', 'c')
            ->where('c.id = :id')
            ->setParameter('id', $id)
            ->getQuery()
            ->getResult()
            ;
    }

}
