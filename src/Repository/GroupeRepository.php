<?php


namespace App\Repository;

use App\Entity\Groupe;
use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Query\Expr\Join;
use Doctrine\ORM\QueryBuilder;


class GroupeRepository extends EntityRepository
{

public function liste(){


}

    public function getGroupeByUser($param){

        $qb = $this->getEntityManager()->createQueryBuilder()
            ->select('g')
           /* ->addSelect('d.id as idgroupe')
            ->addSelect('d.nom AS nomGroupe')*/
            ->from('App:groupe', 'g')
            ->join('g.relationsUserGroupe', 'ug') // , col 60 near 'ug': Error: Class App\Entity\Groupe has no association named relationsUserGroupe
            ->join('ug.user', 'user')
            ->where('ug.user = :user')
            ->andWhere('ug.statue = 1')
        ->setParameter('user', $param ['user']);


        return $qb->getQuery()->getResult();

    }
}