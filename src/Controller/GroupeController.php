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
use App\Entity\Groupe;
use App\Entity\User;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\UserRepository;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;


class GroupeController extends Controller
{


    public function showAction()
    {

        $param = array('user' => $this->getUser());


        $entityManager = $this->getDoctrine()->getManager();


        $groupe = $entityManager->getRepository(Groupe::class)

            ->getGroupeByUser($param);

dump($groupe);


        return $this->render('Groupe/mygroupe.html.twig', array(
            'groupe' => $groupe,
        ));
    }


    public function addAction(Request $request) {

        $groupe = new Groupe();

        $formGroupe = $this->getForm($groupe);


        $formGroupe->handleRequest($request);

        if ($formGroupe->isSubmitted()) {
          //  if ($formGroupe->isValid()) {
                $groupe = $formGroupe->getData();
                dump($groupe->getNom());
                $groupe->setNom($groupe->getNom());
                $groupe->setRelationsUserGroupe(NULL);
                $entityManager = $this->getDoctrine()->getManager();
                $entityManager->persist($groupe);
                $entityManager->flush();
                return $this->redirect($this->generateUrl('groupe_add'));
//            } else {
//                return false;
//            }
        }

        return $this->render ( 'Groupe/addGroupe.html.twig', array (
            'formGroupe' => $formGroupe->createView()
        ));

    }

    private function getForm(groupe $groupe){
        $form = $this->createFormBuilder($groupe, array(
            'action' =>$this->generateUrl('groupe_add'),
            'method' => 'POST',

        ));

        $form->add("nom", TextType::class)
            ->add('submit', SubmitType::class, array('label' => 'Update'));
        return $form->getForm();
    }



}