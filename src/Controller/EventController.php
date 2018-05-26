<?php
/**
 * Created by PhpStorm.
 * User: sridar
 * Date: 26/05/2018
 * Time: 14:52
 */


namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class EventController extends Controller
{


    public function indexAction()
    {



        return $this->render('Event/calendar.html.twig', array(
            'toto' => 'lol',
        ));
    }



}