<?php
/**
 * Created by PhpStorm.
 * User: sridar
 * Date: 18/05/2018
 * Time: 17:38
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


class GroupeController extends Controller
{


    public function showAction(Request $request)
    {

        $param = array('user' => $this->getUser());


        $entityManager = $this->getDoctrine()->getManager();


        $groupe = $entityManager->getRepository(Groupe::class)

            ->getGroupeByUser($param);

        $newgroupe = new Groupe();
        $formgroupe = $this->getForm($newgroupe);

        return $this->render('Groupe/mygroupe.html.twig', array(
            'groupe' => $groupe,
            'formAddGroupe' => $formgroupe->createView(),
        ));
    }


    public function addAction(Request $request) {

        $groupe = new Groupe();

        $formGroupe = $this->getForm($groupe);


        $formGroupe->handleRequest($request);

        if ($formGroupe->isSubmitted()) {

                $groupe = $formGroupe->getData();
                $groupe->setNom($groupe->getNom());
                $usergroupe = new UserGroupe($this->getUser(), $groupe);
                $usergroupe->setInviteur($this->getUser()->getUsername());
                $usergroupe->setStatue(1);
                $entityManager = $this->getDoctrine()->getManager();
                 $entityManager->persist($usergroupe);
                $entityManager->persist($groupe);
                $entityManager->flush();

                return $this->redirect($this->generateUrl('message_add', array('groupe'=>$groupe->getIdgroupe())));

        }

        return $this->render('Groupe/addgroupe.html.twig', array(
            'formGroupe' => $formGroupe->createView(),
        ));

    }


    private function getForm(groupe $groupe){
        $form = $this->createFormBuilder($groupe, array(
            'action' =>$this->generateUrl('groupe_add'),
            'method' => 'POST',

        ));

        $form->add("nom", TextType::class, 
            array(
                'attr' => array(
                    'class' => 'form-control'
                )
            )
        )
            ->add('submit', SubmitType::class,
               array(
                'label' => 'Valider', 
                'attr' => array(
                    'class' => 'btn btn-default btn-round waves-effect p-3 mt-3'))
                    
        );
        return $form->getForm();
    }



            private function inGroupeAction(Groupe $groupe, Request $request){

                $username = 'admin';


                $formInvitation = $this->getFormInvitation($groupe);


                $formInvitation->handleRequest($request);

                if ($formInvitation->isSubmitted()) {


                    $entityManager = $this->getDoctrine()->getManager();

                    $user = $entityManager->getRepository(User::class)
                        ->getUserByUsername(array('username'=> $username));

                    $usergroupe = new UserGroupe($user, $groupe);
                    $entityManager = $this->getDoctrine()->getManager();
                    $entityManager->persist($usergroupe);
                    $entityManager->persist($groupe);
                    $entityManager->flush();

                }

        }








}