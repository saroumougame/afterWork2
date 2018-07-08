<?php
/**
 * Created by PhpStorm.
 * User: sridar
 * Date: 18/05/2018
 * Time: 17:38
 */

namespace App\Controller;

use App\Entity\Entreprise;
use App\Entity\UserGroupe;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Groupe;
use App\Entity\User;
use App\Entity\Event;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\UserRepository;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Doctrine\ORM\EntityRepository;


class ProfilController extends Controller
{



    public function showAction()
    {
        $User = $this->getUser();

    	$formUser = $this->getForm($User);

        $entityManager = $this->getDoctrine()->getManager();

        $eventUser = $entityManager->getRepository(Event::class)->findBy(array('useradd' => $this->getUser()->getId()), null,5);

        return $this->render('Profile/index.html.twig', array(
            'User' => $User,
            'eventUser' => $eventUser,
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

                return $this->redirect($this->generateUrl('user_profil'));
        }

    }

    public function getForm($User)
    {
          $form = $this->createFormBuilder($User, array(
            'action' =>$this->generateUrl('profil_update_user'),
            'method' => 'POST',

        ));

        $form->add('entreprise', EntityType::class, array(
            'class' => Entreprise::class,
            'query_builder' => function(EntityRepository $repository) {
                return $repository->createQueryBuilder('e')
                    ->select('e')
                    ->orderBy('e.nom', 'ASC');
            },
            'attr' => array('class' => 'form-control show-tick', 'data-live-search' => 'true'),
        ));

        $form->add("email", TextType::class,
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