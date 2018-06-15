<?php
/**
 * Created by PhpStorm.
 * User: sridar
 * Date: 14/06/2018
 * Time: 14:32
 */

namespace App\Controller;


use App\Entity\Entreprise;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use App\Form\EntrepriseType;
use Symfony\Component\HttpFoundation\Request;

class EntrepriseController extends Controller
{



    public function addAction(Request $request){

        $entreprise = new Entreprise();



        $form = $this->getForm($entreprise);


        $form->handleRequest($request);

        if ($form->isSubmitted()){


            $dataEntreprise = $form->getData();

            $user = $this->getUser();

           // dump($dataEntreprise);
            $entreprise->setNom($dataEntreprise->getNom());
            $entreprise->setDescription($dataEntreprise->getDescription());
            $user->setEntreprise($entreprise);
            $em = $this->getDoctrine()->getManager();
            $em->persist($user);
            $em->persist($entreprise);
            $em->flush();

            return $this->redirect($this->generateUrl('message_add', array('groupe'=> '1')));

        }


        return $this->render ( 'Entreprise/add.html.twig', array (
            'formEntreprise' => $form->createView(),
        ));



    }


    /**
     * Créé le formulaire selon l'objet Entreprise en parametre.
     * @param Entreprise $entreprise
     * @return \Symfony\Component\Form\Form
     */
    private function getForm(Entreprise $entreprise){
        return  $this->createForm(EntrepriseType::class, $entreprise);
    }



    public function showAction(Entreprise $entreprise){

        return $this->render ( 'Entreprise/show.html.twig', array (
            'entreprise' => $entreprise,
        ));


    }








}