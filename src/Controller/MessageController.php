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
use Symfony\Component\HttpFoundation\Response;


class MessageController extends Controller
{
    public function addAction(Groupe $groupe)
    {

        dump($groupe);


//        $groupe = new Groupe();
//        $groupe->setNom('groupe toto');
//        $groupe->setRelationsUserGroupe(NULL);

        $message = new Message();
        $message->setMessage('JE SUIS');
        $date = new \DateTime('now');
        $message->setDate('2018-05-01');
        $message->setUsername('sridar');

        // relates this product to the category
        $message->setGroupe($groupe);

        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->persist($groupe);
        $entityManager->persist($message);

        $entityManager->flush();

        return new Response(
            'Saved GROUPE product with id: '.$groupe->getIdGroupe()
            .' and new MESSAGE with id: '.$message->getId()
        );
    }
}