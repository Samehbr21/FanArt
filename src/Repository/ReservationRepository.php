<?php

namespace App\Repository;

use App\Entity\Reservation;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\Form\FormTypeInterface;
/**
 * @method Reservation|null find($id, $lockMode = null, $lockVersion = null)
 * @method Reservation|null findOneBy(array $criteria, array $orderBy = null)
 * @method Reservation[]    findAll()
 * @method Reservation[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ReservationRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Reservation::class);
    }

    public function trierDomaineASC()
    {
        return $this->createQueryBuilder('formation')
            ->orderBy('formation.domaine','ASC')
            ->getQuery()
            ->getResult()
            ;
    }

    public function trierDomaineDESC()
    {
        return $this->createQueryBuilder('formation')
            ->orderBy('formation.domaine','DESC')
            ->getQuery()
            ->getResult()
            ;
    }

    public function showAllByNom($nom){
        return $this->createQueryBuilder('formation')
            ->where('formation.nomformation LIKE :nomformation')
            ->setParameter('nomformation', '%'.$nom.'%')
            ->getQuery()
            ->getResult();
    }


    public function trierParDate()
    {
        return $this->createQueryBuilder('formation')
            ->orderBy('formation.datedebut','DESC')
            ->getQuery()
            ->getResult()
            ;
    }

    public function findlastone()
    {
        return $this->createQueryBuilder('h')
            ->orderBy('h.id', 'DESC')
            ->setMaxResults(1)
            ->setFirstResult(5)
            ->getQuery()
            ->getResult()
            ;
    }




    // /**
    //  * @return Formation[] Returns an array of Formation objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('f')
            ->andWhere('f.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('f.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Formation
    {
        return $this->createQueryBuilder('f')
            ->andWhere('f.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
