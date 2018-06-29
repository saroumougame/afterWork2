<?php
/**
 * Created by PhpStorm.
 * User: sridar
 * Date: 18/05/2018
 * Time: 17:38
 */

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class LandingController extends Controller
{


    public function indexAction()
    {


        return $this->render('Landing/index.html.twig', array(
            'toto' => 'lol',
        ));
    }

    public function contributingAction()
    {



        return $this->render('Landing/contribution.html.twig', array(
            'toto' => 'lol',
        ));
    }



}