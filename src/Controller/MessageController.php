<?php
/**
 * Created by PhpStorm.
 * User: sridar
 * Date: 23/05/2018
 * Time: 09:35
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


class MessageController extends Controller
{

    public function addAction(Groupe $groupe)
    {


        if ($this->VerifMembreGroupe($groupe) == true){

       $isAdmin = $this->IsAdmin($groupe);



        $message = new Message();

        $allMessage = $this->showMessage($groupe->getIdGroupe());

        $formMessage = $this->getForm($message, $groupe);

        $formInvitationUser = $this->getFormInvitation($groupe, $formMessage, $allMessage);


        return $this->render('Message/add.html.twig', array(
            'formInviteUser' => $formInvitationUser->createView(),
            'formMessage' => $formMessage->createView(),
            'allMessage' => $allMessage,
            'isAdmin' => $isAdmin,
            'groupe' => $groupe,
        ));

        }else {
            return $this->redirectToRoute('groupe_show');

        }
    }


    public function insertAction(Groupe $groupe, Request $request)
    {
        $message = new Message();


        $allMessage = $this->showMessage($groupe->getIdGroupe());
        $formMessage = $this->getForm($message, $groupe);

        $formInvitationUser = $this->getFormInvitation($groupe, $formMessage, $allMessage);
        $formMessage->handleRequest($request);


        if ($formMessage->isSubmitted()) {

            $message = $formMessage->getData();
            $message->setMessage($message->getMessage());
            $date = new \DateTime('now');
            // $dateresult = $date->format('Y-m-d H:i:s');
            $message->setDate($date);
            $message->setUsername($this->getUser()->getUsername());
            // relates this product to the category
            $message->setGroupe($groupe);

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($groupe);
            $entityManager->persist($message);

            $entityManager->flush();

            return $this->redirectToRoute('message_add', array('groupe' => $groupe->getIdGroupe()));
        }


        return $this->render('Message/add.html.twig', array(
            'formInviteUser' => $formInvitationUser->createView(),
            'formMessage' => $formMessage->createView(),
            'allMessage' => $allMessage
        ));
    }


    private function getForm(Message $message, Groupe $groupe)
    {
        $form = $this->createFormBuilder($message, array(
            'action' => $this->generateUrl('message_insert', array('groupe' => $groupe->getIdGroupe())),
            'method' => 'POST',

        ));

        $form->add("message", TextareaType::class);
        $form->add('submit', SubmitType::class, array('label' => 'Envoyer'));
        return $form->getForm();
    }


    private function showMessage($idGroupe)
    {


        $entityManager = $this->getDoctrine()->getManager();


        $Message = $entityManager->getRepository(Message::class)->findBy(
            ['groupe' => $idGroupe]
        );

        // $serializer = $this->get('serializer');
        //  $response = $serializer->serialize($Message,'json');

        return $Message;


    }


    private function getFormInvitation(groupe $groupe)
    {
        $defaultData = array('user' => 'User a inviter');
        $form = $this->createFormBuilder($defaultData, array(
            'action' => $this->generateUrl('user_invite', array('groupe' => $groupe->getIdGroupe())),
            'method' => 'POST',

        ));


        $form
            ->add('username', TextType::class)
            ->add('submit', SubmitType::class);
        return $form->getForm();
    }


    public function userInviteAction(Groupe $groupe, Request $request)
    {

        $formInvitationUser = $this->getFormInvitation($groupe);

        $formInvitationUser->handleRequest($request);

        if ($formInvitationUser->isSubmitted()) {

            $username = $formInvitationUser->getData();

            $entityManager = $this->getDoctrine()->getManager();


            $user = $entityManager->getRepository(User::class)
                ->findOneBy(array('username' => $username['username']));

            if (!isset($user)) {

                $usergroupe = new UserGroupe($user, $groupe);

                $entityManager->persist($usergroupe);
                $entityManager->flush();

            }


            return $this->redirectToRoute('message_add', array('groupe' => $groupe->getIdGroupe()));
        }


        return $this->redirectToRoute('message_add', array('groupe' => $groupe->getIdGroupe()));
    }


    public function quitterAction(Groupe $groupe)
    {

        $user = $this->getUser();
        $entityManager = $this->getDoctrine()->getManager();
        $usergroupe =  $entityManager->getRepository(UserGroupe::class)->findOneBy(array('user' => $user, 'groupe' => $groupe));


        $entityManager->remove($usergroupe);
        $entityManager->flush();

        return $this->redirectToRoute('groupe_show');



    }



    private function VerifMembreGroupe($groupe){

        $user = $this->getUser();

        $entityManager = $this->getDoctrine()->getManager();
        $membreGroupe = $entityManager->getRepository(UserGroupe::class)->findOneBy(array('groupe' => $groupe, 'user' => $user));

        if (is_null($membreGroupe)){

            return false;

        }else{
            return true;
        }



    }


    private function IsAdmin($groupe){
        $user = $this->getUser();

        $entityManager = $this->getDoctrine()->getManager();
        $usergroupe =  $entityManager->getRepository(UserGroupe::class)->findOneBy(array('groupe' => $groupe, 'user' => $user, 'roleGroupe' => 1));

        if (is_null($usergroupe)){
            return false;
        }else{
            return true;
        }


    }


}