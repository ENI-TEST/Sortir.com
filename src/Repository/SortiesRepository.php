<?php

namespace App\Repository;

use App\Entity\Sorties;
use App\Entity\SortieSearchData;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\Tools\Pagination\Paginator;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Sorties|null find($id, $lockMode = null, $lockVersion = null)
 * @method Sorties|null findOneBy(array $criteria, array $orderBy = null)
 * @method Sorties[]    findAll()
 * @method Sorties[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SortiesRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Sorties::class);
    }

    public function findSorties(SortieSearchData $searchData)
    {
        $qb = $this
            ->createQueryBuilder('s')
            ->select('p.nom, p.prenom, c.nom_campus, e.libelle,l.nom_lieu, l.rue, 
                           v.code_postal, l.latitude, l.longitude, s.nom, s.date_debut,
                           s.duree, s.date_cloture, s.nb_inscriptions_max, s.description_infos,
                            s.etat_sortie, s.url_photo')
            ->innerJoin('s.etat', 'e', 'e.id = s.etat_id' )
            ->innerJoin('s.organisateur', 'p', 'p.id = s.organisateur_id')
            ->innerJoin('s.campus','c', 'c.id = s.campus_id')
            ->innerJoin('s.lieu', 'l', 'l.id = s.lieu_id')
            ->innerJoin('l.ville', 'v', 'v.id = l.ville_id');

        if(!empty($searchData->getMotCle())){
            $qb = $qb
            ->andWhere('s.nom LIKE :motCle')
            ->setParameter('motCle', "%{$searchData->getMotCle()}");

        }

        return $query = $qb->getQuery()->getResult();
    }
    // /**
    //  * @return Sorties[] Returns an array of Sorties objects
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
    public function findOneBySomeField($value): ?Sorties
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
