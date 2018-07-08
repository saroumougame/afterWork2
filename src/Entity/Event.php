<?php
/**
 * Created by PhpStorm.
 * User: sridar
 * Date: 29/05/2018
 * Time: 15:37
 */


namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Message
 *
 * @ORM\Table(name="event")
 * @ORM\Entity(repositoryClass="App\Repository\EventRepository")
 */
class Event
{

    public function __construct()
    {
        $this->groupe = new ArrayCollection();
    }

    /**
     * @ORM\Id
     * @ORM\Column(type="integer", name="id")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\Column(type="string", name="titre")
     */
    private $titre;

    /**
     * @ORM\Column(type="string", name="message")
     */
    private $message;

    /**
     * @ORM\Column(type="string", name="adress")
     */
    private $adress;


    /**
     * @ORM\Column(type="datetime", name="datedebut")
     */
    private $datedebut;


    /**
     * @ORM\Column(type="datetime", name="datefin")
     */
    private $datefin;


    /**
     * @ORM\ManyToOne(targetEntity="Groupe", inversedBy="message")
     * @ORM\JoinColumn(name="groupe_id", referencedColumnName="idGroupe")
     */
    private $groupe;

    /**
     * @ORM\Column(type="integer", name="user_add")
     */
    private $useradd;

    /**
     * @return mixed
     */
    public function getUseradd()
    {
        return $this->useradd;
    }

    /**
     * @param mixed $useradd
     */
    public function setUseradd($useradd)
    {
        $this->useradd = $useradd;
    }



    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getTitre()
    {
        return $this->titre;
    }

    /**
     * @param mixed $titre
     */
    public function setTitre($titre)
    {
        $this->titre = $titre;
    }

    /**
     * @return mixed
     */
    public function getMessage()
    {
        return $this->message;
    }

    /**
     * @param mixed $message
     */
    public function setMessage($message)
    {
        $this->message = $message;
    }

    /**
     * @return mixed
     */
    public function getAdress()
    {
        return $this->adress;
    }

    /**
     * @param mixed $adress
     */
    public function setAdress($adress)
    {
        $this->adress = $adress;
    }






    /**
     * @return mixed
     */
    public function getDatedebut()
    {
        return $this->datedebut;
    }

    /**
     * @param mixed $datedebut
     */
    public function setDatedebut($datedebut)
    {
        $this->datedebut = $datedebut;
    }

    /**
     * @return mixed
     */
    public function getDatefin()
    {
        return $this->datefin;
    }

    /**
     * @param mixed $datefin
     */
    public function setDatefin($datefin)
    {
        $this->datefin = $datefin;
    }

    /**
     * @return mixed
     */
    public function getGroupe()
    {
        return $this->groupe;
    }

    /**
     * @param mixed $groupe
     */
    public function setGroupe($groupe)
    {
        $this->groupe = $groupe;
    }





}
