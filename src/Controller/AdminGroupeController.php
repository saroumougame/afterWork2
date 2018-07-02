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


       // $usergroupe = new UserGroupe();

        // ACCEDER A CHANGER

        $user = $this->getUser();
        $entityManager = $this->getDoctrine()->getManager();
        $usergroupe =  $entityManager->getRepository(UserGroupe::class)->findBy(array('groupe' => $groupe));
        

        return $this->render('adminGroupe/admin.html.twig', array(
            'usergroupe' => $usergroupe,

        ));

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



    private function getRoleGroupe($groupe , $user){


    }



}