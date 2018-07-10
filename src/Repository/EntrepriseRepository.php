<?php
/**
 * Created by PhpStorm.
 * User: sridar
 * Date: 10/07/2018
 * Time: 18:58
 */



namespace App\Repository;

use App\Entity\Event;
use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Query\Expr\Join;
use Doctrine\ORM\QueryBuilder;


class EntrepriseRepository extends EntityRepository
{

    public function liste(){


    }

    public function getEntrepriseBySearch($param){

        $qb = $this->getEntityManager()->createQueryBuilder()
            ->select('e')
            ->from('App:Entreprise', 'e');
        $qb->where(
                $qb->expr()->like('e.nom', ':nom')
            )
            ->setParameter('nom', '%'.$param['nom'].'%');


        return $qb->getQuery()->getResult();
    }

}