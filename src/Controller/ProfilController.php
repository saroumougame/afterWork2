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


class ProfilController extends Controller
{


    public function indexAction()
    {
        $articles = 'toto';

        return $this->render('Profile/index.html.twig', array(
            'articles' => $articles,
        ));
    }

    public function userAction()
    {
        $articles = 'user';
        dump($articles);

        return $this->render('Profile/index.html.twig', array(
            'articles' => $articles,
        ));
    }

    public function adminAction()
    {
        $articles = 'admin';

        return $this->render('Profile/index.html.twig', array(
            'articles' => $articles,
        ));
    }

}