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
use App\Entity\Event;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\UserRepository;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class ProfilController extends Controller
{



    public function showAction()
    {
        $User = $this->getUser();

    	$entityManager = $this->getDoctrine()->getManager();
        $Groupes = $entityManager->getRepository(Groupe::class);
        $Event = $entityManager->getRepository(Event::class);
        $allUsersGroupes = $entityManager->getRepository(UserGroupe::class)->findAll();
       


        $param = array('user' => $this->getUser());
        // j'ai tout les groupes d'un user
        $groupes = $Groupes->getGroupeByUser($param);

        if(isset($groupes) && !empty($groupes))
             $premierGroupe = $groupes[0]->getIdGroupe();

        // je prend le premier car je sais pas faire de jointure avec un "tableau de groupe"
        // je recupere tout ces events
        if(isset($premierGroupe))
            $allEvents = $Event->getByGroupe($premierGroupe);
        
        $tabEvents = [];
        if(isset($allEvents))
        {
            
        // on récuperer un array avec la data de tout les events récupérés. 
            $countEvents = 0;
            foreach ($allEvents as $UnEvent) {
                $tabEvents[$countEvents]['id'] = $UnEvent->getId();
                $tabEvents[$countEvents]['titre'] = $UnEvent->getTitre();
                $tabEvents[$countEvents]['message'] = $UnEvent->getMessage();
                $tabEvents[$countEvents]['adress'] = $UnEvent->getAdress();
                $tabEvents[$countEvents]['datedebut'] = $UnEvent->getDatedebut();
                $tabEvents[$countEvents]['datefin'] = $UnEvent->getDatefin();
                $countEvents++;
            }
        }


    	$formUser = $this->getForm($User);

        return $this->render('Profile/index.html.twig', array(
            'User' => $User,
            'tabEvent' => $tabEvents,
            'formUser' => $formUser->createView()
        ));
    }

    public function updateAction(Request $request)
    {

        $User = $this->getUser();

        $formUser = $this->getForm($User);
        $formUser->handleRequest($request);

        if ($formUser->isSubmitted()) {

                $UpdateUser = $formUser->getData();
                $User->setUsername($UpdateUser->getUsername());
                $User->setEmail($UpdateUser->getEmail());
                $entityManager = $this->getDoctrine()->getManager();
                $entityManager->persist($User);
                $entityManager->flush();

                return $this->redirect($this->generateUrl('profil_add_groupe'));
        }

    }

    public function getForm($User)
    {
          $form = $this->createFormBuilder($User, array(
            'action' =>$this->generateUrl('profil_update_user'),
            'method' => 'POST',

        ));

        $form->add("username", TextType::class, 
            array(
                'attr' => array(
                    'class' => 'form-control'
                )
            )
        )
        ->add("email", TextType::class, 
            array(
                'attr' => array(
                    'class' => 'form-control'
                )
            )
        )
         ->add('submit', SubmitType::class,
               array(
                'label' => 'Valider', 
                'attr' => array(
                    'class' => 'btn btn-primary btn-round waves-effect p-3 mt-3'))
                    
        );
        return $form->getForm();
    }


}