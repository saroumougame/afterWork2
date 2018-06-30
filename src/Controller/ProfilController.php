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

class ProfilController extends Controller
{


    public function showAction()
    {

    	$entityManager = $this->getDoctrine()->getManager();
        $Groupes = $entityManager->getRepository(Groupe::class);
        $Event = $entityManager->getRepository(Event::class);
        $allUsersGroupes = $entityManager->getRepository(UserGroupe::class)->findAll();
        $User = $this->getUser();


        $param = array('user' => $this->getUser());
        // j'ai tout les groupes d'un user
        $groupes = $Groupes->getGroupeByUser($param);
        // je prend le premier car je sais pas faire de jointure avec un "tableau de groupe"
        $premierGroupe = $groupes[0]->getIdGroupe();

        // je recupere tout ces events
        $allEvents = $Event->getByGroupe($premierGroupe);
        
        // on récuperer un array avec la data de tout les events récupérés. 
        $tabEvents = [];
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


            // il faut faire la jointure sur user et groupes
        //var_dump($allUsersGroupes);

    	$tabUser = [];
    	$tabUser['username'] = $User->getUsername();
    	$tabUser['email'] 	 = $User->getEmail();
    	

        return $this->render('Profile/index.html.twig', array(
            'tabUser' => $tabUser,
            'tabEvent' => $tabEvents
        ));
    }



}