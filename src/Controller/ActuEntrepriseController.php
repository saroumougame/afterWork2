<?php
/**
 * Created by PhpStorm.
 * User: sridar
 * Date: 23/05/2018
 * Time: 09:35
 */

namespace App\Controller;


use App\Entity\ActuEntreprise;
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


class ActuEntrepriseController extends Controller
{

    public function indexAction()
    {



        $entityManager = $this->getDoctrine()->getManager();


        $actus = $entityManager->getRepository(ActuEntreprise::class)->findAll(array(), array('id' => 'desc'));
        

        return $this->render ( 'Entreprise/Actu/home.html.twig', array (
            'actus' => $actus

        ));
    }
















}