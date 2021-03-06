<?php
/**
 * Created by PhpStorm.
 * User: sridar
 * Date: 02/07/2018
 * Time: 16:35
 */


namespace App\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use App\Entity\Groupe;
use App\Entity\Message;
use App\Entity\User;
use App\Entity\UserGroupe;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;


class AdminGroupeController extends Controller
{

    public function indexAction(Groupe $groupe)
    {


         $roleAdmin =  $this->verifRoleAdmin($groupe); // si tu nest pas admin redirection

         if($roleAdmin == true){

             $entityManager = $this->getDoctrine()->getManager();
             $usergroupe =  $entityManager->getRepository(UserGroupe::class)->findBy(array('groupe' => $groupe));

             return $this->render('adminGroupe/admin.html.twig', array(
                 'usergroupe' => $usergroupe,

             ));

         }else{

             return $this->redirect($this->generateUrl('message_add', array('groupe' => $groupe->getIdGroupe())));

         }



    }


    public function deleteAction(Groupe $groupe, User $user)
    {


        // $usergroupe = new UserGroupe();

        $entityManager = $this->getDoctrine()->getManager();
        $usergroupe =  $entityManager->getRepository(UserGroupe::class)->findOneBy(array('groupe' => $groupe, 'user' => $user));

        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->remove($usergroupe);
        $entityManager->flush($usergroupe);

        return $this->redirect($this->generateUrl('admin_groupe'));



    }



    private function getRoleUser($groupe , $user){


        $usergroupe = new UserGroupe($groupe , $user);

        $role = $usergroupe->getRole();

        if ($role == 1){

            return 'admin';

        }else{
            return 'membre';
        }


    }


    private function verifRoleAdmin($groupe){

        $user = $this->getUser();


        $entityManager = $this->getDoctrine()->getManager();
        $currentUserGroupe =  $entityManager->getRepository(UserGroupe::class)->findOneBy(array('groupe' => $groupe, 'user' => $user));


        $currentRole = $currentUserGroupe->getRoleGroupe();

        if($currentRole == 0){

            return false;

        }else{
            return true;
        }

    }



    private function UpAdminAction(Groupe $groupe, User $user){

        $roleAdmin =  $this->verifRoleAdmin($groupe); // si tu nest pas admin redirection

        if($roleAdmin == true) {


            $entityManager = $this->getDoctrine()->getManager();
            $usergroupe = $entityManager->getRepository(UserGroupe::class)->findOneBy(array('groupe' => $groupe, 'user' => $user));


            $entityManager = $this->getDoctrine()->getManager();
            $usergroupe->setRoleGroupe(1);
            $entityManager->flush($usergroupe);

            return $this->redirect($this->generateUrl('admin_groupe'));

        }else{

            return $this->redirect($this->generateUrl('message_add', array('groupe' => $groupe->getIdGroupe())));

        }

    }




}