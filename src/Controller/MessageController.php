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
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;


class MessageController extends Controller
{

    public function addAction(Groupe $groupe)
    {


        $message = new Message();

        $allMessage =$this->showMessage($groupe->getIdGroupe());

        $formMessage = $this->getForm($message,$groupe);

        return $this->render ( 'Message/add.html.twig', array (
            'formMessage' => $formMessage->createView(),
            'allMessage' => $allMessage
        ));
    }


    public function insertAction(Groupe $groupe, Request $request)
    {
        $message = new Message();


        $allMessage =$this->showMessage($groupe->getIdGroupe());
          $formMessage = $this->getForm($message,$groupe);


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


        return $this->render ( 'Message/add.html.twig', array (
            'formMessage' => $formMessage->createView(),
            'allMessage' => $allMessage
        ));
    }



    private function getForm(Message $message,Groupe $groupe){
        $form = $this->createFormBuilder($message, array(
            'action' =>$this->generateUrl('message_insert', array('groupe' => $groupe->getIdGroupe())),
            'method' => 'POST',

        ));

        $form->add("message", TextareaType::class)
            ->add('submit', SubmitType::class, array('label' => 'Envoyer'));
        return $form->getForm();
    }


    private function showMessage($idGroupe){




        $entityManager = $this->getDoctrine()->getManager();


        $Message = $entityManager->getRepository(Message::class)->findBy(
            ['groupe' => $idGroupe]
        );

       // $serializer = $this->get('serializer');
      //  $response = $serializer->serialize($Message,'json');

        return $Message;



    }




}