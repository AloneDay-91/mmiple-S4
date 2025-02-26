<?php

namespace App\Repository;

use App\Entity\Jeu;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Jeu>
 */
class JeuRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Jeu::class);
    }
    public function findByJeux(float $prix, string $nom, int $cp): array
    {
        return $this->createQueryBuilder('j')
            ->andWhere('j.prix >= :prix')
            ->andWhere('j.nom LIKE :nom')
            ->join('j.editeur', 'e')
            ->andWhere('e.cp = :cp')
            ->setParameter('prix', $prix)
            ->setParameter('nom', '%' . $nom . '%')
            ->setParameter('cp', $cp)
            ->orderBy('j.prix', 'DESC')
            ->addOrderBy('j.nom', 'ASC')
            ->getQuery()
            ->getResult()
            ;
    }

    //    /**
    //     * @return Jeu[] Returns an array of Jeu objects
    //     */
    //    public function findByExampleField($value): array
    //    {
    //        return $this->createQueryBuilder('j')
    //            ->andWhere('j.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->orderBy('j.id', 'ASC')
    //            ->setMaxResults(10)
    //            ->getQuery()
    //            ->getResult()
    //        ;
    //    }

    //    public function findOneBySomeField($value): ?Jeu
    //    {
    //        return $this->createQueryBuilder('j')
    //            ->andWhere('j.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}
