<?php
/**
 * Created by PhpStorm.
 * User: sridar
 * Date: 13/06/2018
 * Time: 14:35
 */

namespace App\Controller;


use App\Entity\UserGroupe;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Groupe;
use App\Entity\User;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\UserRepository;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;


class NotifController extends Controller
{


    public function showAction(Request $request)
    {

       $idUser = $this->getUser()->getId();

        $entityManager = $this->getDoctrine()->getManager();


        $relationgroupe = $entityManager->getRepository(  UserGroupe::class)

            ->findBy(array('user' => $idUser, 'statue' => 0));


        return $this->render ( 'Invitation/inviteGroupe.html.twig', array (
            'inviteGroupe' => $relationgroupe,
        ));

    }


    public function accepterAction(UserGroupe $userGroupe){


        $userGroupe->setStatue(1);

              $entityManager = $this->getDoctrine()->getManager();
                $entityManager->persist($userGroupe);
                $entityManager->flush($userGroupe);


        return $this->redirect($this->generateUrl('user_invite_notif'));



}


    public function refuserAction(UserGroupe $userGroupe){

        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->remove($userGroupe);
        $entityManager->flush($userGroupe);

        return $this->redirect($this->generateUrl('user_invite_notif'));



    }



    }
