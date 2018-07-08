<?php
/**
 * Created by PhpStorm.
 * User: sridar
 * Date: 23/05/2018
 * Time: 09:35
 */

namespace App\Controller;



use App\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use App\Entity\Groupe;
use App\Entity\Message;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use App\Entity\Event;
use DateTime;


class EventController extends Controller
{


    public function indexAction(Groupe $groupe)
    {



        $entityManager = $this->getDoctrine()->getManager();

        $event = $entityManager->getRepository(Event::class)->findBy(array('groupe' => $groupe), null,5);


        return $this->render('Event/calendar.html.twig', array(
            'idgroupe' => $groupe->getIdGroupe(),
            'event' => $event,
        ));
    }


    public function addAction(Groupe $groupe, Request $request)
    {
        $event = new Event();

        $formEvent = $this->getForm($event,$groupe);
        $formEvent->handleRequest($request);

        if ($formEvent->isSubmitted()) {

            $event = $formEvent->getData();
            $event->setGroupe($groupe);
            $event->setUseradd($this->getUser()->getId());
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($event);
            $entityManager->flush();

            return $this->redirectToRoute(' event_show', array('groupe' => $groupe->getIdGroupe()));
        }


        return $this->render ( 'Event/add.html.twig', array (
            'formEvent' => $formEvent->createView(),
            'nom_groupe' => $groupe->getNom()

        ));
    }



    private function getForm(Event $event,Groupe $groupe){
        $form = $this->createFormBuilder($event, array(
            'action' =>$this->generateUrl('event_add', array('groupe' => $groupe->getIdGroupe())),
            'method' => 'POST',

        ));

        $form->add("titre", TextType::class, array('label' => false))
            ->add("message", TextareaType::class, array('label' => false))
            ->add("adress", TextType::class, array('label' => false))
            ->add('datedebut', DateTimeType::class, array(
                'widget' => 'single_text',
                'input' => 'datetime',
                'format' => 'dd/MM/yyyy - HH:mm',
                'label' => false))

            ->add("datefin", DateTimeType::class, array(
                'widget' => 'single_text',
                'input' => 'datetime',
                'format' => 'dd/MM/yyyy - HH:mm',
                'label' => false))
            ->add('submit', SubmitType::class, array('label' => 'Envoyer'));


        return $form->getForm();
    }


    public function detailAction(Event $event)
    {


        return $this->render('Event/detail.html.twig', array(
            'event' => $event,
        ));
    }

}