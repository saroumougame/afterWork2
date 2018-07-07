<?php

namespace App\Listener;

use ADesigns\CalendarBundle\Event\CalendarEvent;
use ADesigns\CalendarBundle\Entity\EventEntity;
use App\Entity\Event;
use Doctrine\ORM\EntityManager;
use Symfony\Component\DependencyInjection\Container;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

class CalendarEventListener
{
    private $entityManager;
    private $container;


    public function __construct(EntityManager $entityManager, Container $container)
    {
        $this->entityManager = $entityManager;
        $this->container = $container;

    }

    public function loadEvents(CalendarEvent $calendarEvent )
    {


        $Event = $this->entityManager->getRepository(Event::class)->findAll();

        foreach ($Event as $Events) {

            $titre = $Events->getTitre();
            $datedebut = $Events->getDatedebut();
             $datefin = $Events->getDatefin();
            $url = $this->container->get('router')->generate('event_detail',  array('id' => $Events->getId()), UrlGeneratorInterface::ABSOLUTE_URL);

            //verif getAllDay

            $eventEntity = new EventEntity($titre, $datedebut, $datefin);
            //optional calendar event settings
            $eventEntity->setAllDay(false); // default is false, set to true if this is an all day event
            $eventEntity->setBgColor('#4286f4'); //set the background color of the event's label
            $eventEntity->setFgColor('#ffff'); //set the foreground color of the event's label
            $eventEntity->setUrl($url); // url to send user to when event label is clicked
            //   $eventEntity->setUrl($url); // url to send user to when event label is clicked
            $eventEntity->setCssClass('my-custom-class'); // a custom class you may want to apply to event labels
            //finally, add the event to the CalendarEvent for displaying on the calendar
            $calendarEvent->addEvent($eventEntity);
        }


    }




}