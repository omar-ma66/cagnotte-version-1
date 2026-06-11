<?php

namespace App\Repository;

use App\Entity\Paiement;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Paiement>
 */
class PaiementRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Paiement::class);
    }

    //    /**
    //     * @return Paiement[] Returns an array of Paiement objects
    //     */
    //    public function findByExampleField($value): array
    //    {
    //        return $this->createQueryBuilder('p')
    //            ->andWhere('p.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->orderBy('p.id', 'ASC')
    //            ->setMaxResults(10)
    //            ->getQuery()
    //            ->getResult()
    //        ;
    //    }

    //    public function findOneBySomeField($value): ?Paiement
    //    {
    //        return $this->createQueryBuilder('p')
    //            ->andWhere('p.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }

    public function getAllVersement(string $key):?array
    {
                return $this->createQueryBuilder('p')
                       ->andWhere('p.campagne = :key')
                       ->setParameter('key',$key)
                       ->getQuery()
                       ->getResult();        

    }

                public function getTrio():?array
                { 
                return $this->createQueryBuilder('p')
                    ->select('c.titre AS titre_campagne','c.contenu','c.id', 'SUM(p.montant) AS total_paiement')
                    ->join('p.campagne', 'c') // Crée la jointure automatique via les relations d'entités
                    ->groupBy('c.nom')
                    ->orderBy('total_paiement', 'DESC')
                    ->setMaxResults(3)
                    ->getQuery()
                    ->getResult();
                    }
}