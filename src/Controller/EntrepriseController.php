<?php
/**
 * Created by PhpStorm.
 * User: sridar
 * Date: 14/06/2018
 * Time: 14:32
 */

namespace App\Controller;


use App\Entity\ActuEntreprise;
use App\Entity\Entreprise;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use App\Form\EntrepriseType;
use Symfony\Component\HttpFoundation\Request;
use App\Form\ActuEntrepriseType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class EntrepriseController extends Controller
{


    public function addAction(Request $request)
    {

        $entreprise = new Entreprise();

        $form = $this->getForm($entreprise);


        $form->handleRequest($request);

        if ($form->isSubmitted()) {


            $dataEntreprise = $form->getData();

            $user = $this->getUser();


            $entreprise->setNom($dataEntreprise->getNom());
            $entreprise->setDescription($dataEntreprise->getDescription());

                $user->setEntreprise($entreprise);


            $em = $this->getDoctrine()->getManager();
            $em->persist($user);
            $em->persist($entreprise);
            $em->flush();

            return $this->redirect($this->generateUrl('entreprise_show', array('id' => $entreprise->getId())));

        }


        return $this->render('Entreprise/add.html.twig', array(
            'formEntreprise' => $form->createView(),
        ));


    }


    /**
     * Créé le formulaire selon l'objet Entreprise en parametre.
     * @param Entreprise $entreprise
     * @return \Symfony\Component\Form\Form
     */
    private function getForm(Entreprise $entreprise)
    {
        return $this->createForm(EntrepriseType::class, $entreprise);
    }


    public function showAction(Request $request, Entreprise $entreprise)
    {



        $actu = $this->showActuByEntreprise($entreprise);

        $actuEntreprise = new ActuEntreprise();

        $form = $this->getFormActu($actuEntreprise, $entreprise);

        $statue = $this->UserBindEntreprise($entreprise);


        return $this->render('Entreprise/show.html.twig', array(
            'statue' => $statue,
            'entreprise' => $entreprise,
            'actu' => $actu,
            'formActu'  => $form->createView(),
        ));


    }


    public function showActuByEntreprise(Entreprise $entreprise)
    {

        $entityManager = $this->getDoctrine()->getManager();


        $actu = $entityManager->getRepository(ActuEntreprise::class)
            ->findBy(array('entreprise' => $entreprise), array('id' => 'DESC'));

        return  $actu;

    }


    public function addActuByEntreprise(Request $request,Entreprise $entreprise)
    {


        $newactu = new ActuEntreprise();

        $form = $this->getFormActu($newactu, $entreprise);

        $form->handleRequest($request);

        if ($form->isSubmitted()) {

            $actu = $form->getData();

            $actu->setEntreprise($entreprise);

            $actu->setDate(new \DateTime('now'));
            $em = $this->getDoctrine()->getManager();
            $em->persist($actu);
            $em->flush();



            return $this->redirect($this->generateUrl('entreprise_add',array( 'id' => $entreprise->getId())));

        }


            return $form->createView();


    }


    private function getFormActu(ActuEntreprise $actuEntreprise, $entreprise)
    {
        return $this->createForm(ActuEntrepriseType::class, $actuEntreprise, array(
            'action' => $this->generateUrl('entreprise_actu_insert',array('id' => $entreprise->getId())),
            'method' => 'POST',
        ));
    }



    public function actuInsertAction(Request $request, Entreprise $entreprise)
    {



        $newactu = new ActuEntreprise();

        $form = $this->getFormActu($newactu, $entreprise);

        $form->handleRequest($request);

        if ($form->isSubmitted()) {

            $actu = $form->getData();

            $actu->setEntreprise($entreprise);

            $actu->setDate(new \DateTime('now'));
            $em = $this->getDoctrine()->getManager();

            $em->persist($actu);
            $em->flush();

            return $this->redirect($this->generateUrl('entreprise_show', array('id' => $entreprise->getId())));

        }


        return $form->createView();


    }


    private function UserBindEntreprise($entreprise){

       $userEntreprise = $this->getUser()->getEntreprise();


       if ($entreprise == $userEntreprise){
           $statue = true;
       }else{

           $statue = false;
       }


       return $statue;

    }


    public function searchEntreprise(){

        $entreprise = new Entreprise();


        $form = $this->getFormSearch($entreprise);


        return $this->render(
            'Entreprise/search.html.twig',
            array('searchEntreprise' => $form->createView())
        );
    }



    public function getFormSearch($User)
    {
        $form = $this->createFormBuilder($User, array(
            'action' =>$this->generateUrl('entreprise_search'),
            'method' => 'POST',

        ));

        $form->add("nom", TextType::class,
            array(
                'attr' => array(
                    'class' => ''
                )
            )
        )
            ->add('submit', SubmitType::class,
                array(
                    'label' => 'Valider',
                    'attr' => array(
                        'class' => ''))

            );
        return $form->getForm();
    }

    public function searchAction(Request $request){

        $entreprise = new Entreprise();

        $form = $this->getFormSearch($entreprise);

        $form->handleRequest($request);

        if ($form->isSubmitted()) {

            $info = $form->getData();

            $newentreprise = $this->entrepriseBySearch($info->getNom());


           $nbSearch = count($newentreprise);

            return $this->render('Entreprise/searchShow.html.twig', array(
                'entreprise' => $newentreprise,
                'nbresult' => $nbSearch,

            ));

        }


    }



    private function entrepriseBySearch($nom){


        $entityManager = $this->getDoctrine()->getManager();

        $param = array('nom' => $nom);


        $showentreprise = $entityManager->getRepository(Entreprise::class)->getEntrepriseBySearch($param);



        return $showentreprise;


    }






}