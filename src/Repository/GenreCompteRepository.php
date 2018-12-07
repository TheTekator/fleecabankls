<?php

namespace App\Repository;

use App\Entity\GenreCompte;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method GenreCompte|null find($id, $lockMode = null, $lockVersion = null)
 * @method GenreCompte|null findOneBy(array $criteria, array $orderBy = null)
 * @method GenreCompte[]    findAll()
 * @method GenreCompte[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class GenreCompteRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, GenreCompte::class);
    }

    // /**
    //  * @return GenreCompte[] Returns an array of GenreCompte objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('g')
            ->andWhere('g.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('g.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?GenreCompte
    {
        return $this->createQueryBuilder('g')
            ->andWhere('g.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
