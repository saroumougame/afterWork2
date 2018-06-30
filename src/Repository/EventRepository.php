<?php


namespace App\Repository;

use App\Entity\Event;
use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Query\Expr\Join;
use Doctrine\ORM\QueryBuilder;


class EventRepository extends EntityRepository
{

    public function liste(){


    }

    public function getByGroupe($param){
    	    
    	    $qb = $this->getEntityManager()->createQueryBuilder()
            ->select('e')
           /* ->addSelect('d.id as idgroupe')
            ->addSelect('d.nom AS nomGroupe')*/
            ->from('App:Event', 'e')
            ->join('e.groupe', 'g') // , col 60 near 'ug': Error: Class App\Entity\Groupe has no association named relationsUserGroupe
            ->where('g.idGroupe = :groupe')
        ->setParameter('groupe', $param);


        return $qb->getQuery()->getResult();
    }

}