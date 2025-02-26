<?php

namespace App\Repository;

use App\Entity\Editeur;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Editeur>
 */
class EditeurRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Editeur::class);
    }

    public function findByCodePostal($codePostal): array
    {
        return $this->createQueryBuilder('e')
            ->andWhere('e.cp = :cp')
            ->setParameter('cp', $codePostal)
            ->orderBy('e.id', 'ASC')
            ->getQuery()
            ->getResult()
        ;
    }

    //    /**
    //     * @return Editeur[] Returns an array of Editeur objects
    //     */
    //    public function findByExampleField($value): array
    //    {
    //        return $this->createQueryBuilder('e')
    //            ->andWhere('e.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->orderBy('e.id', 'ASC')
    //            ->setMaxResults(10)
    //            ->getQuery()
    //            ->getResult()
    //        ;
    //    }

    //    public function findOneBySomeField($value): ?Editeur
    //    {
    //        return $this->createQueryBuilder('e')
    //            ->andWhere('e.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}
