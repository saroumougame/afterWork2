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

class ProfilController extends Controller
{


    public function showAction()
    {



        return $this->render('Profile/index.html.twig', array(
            'toto' => 'lol',
        ));
    }



}