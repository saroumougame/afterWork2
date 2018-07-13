<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use FOS\UserBundle\FOSUserBundle;
use Doctrine\Common\Collections\ArrayCollection;
use FOS\UserBundle\Model\User as FOSUser;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * User
 *
 * @ORM\Table(name="user")
 * @ORM\Entity
 */
class User extends FOSUser
{


    public function __construct()
    {
        parent::__construct();
        $this->relationsUserGroupe = new ArrayCollection();

    }
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @var int
     *
     * @ORM\OneToMany(targetEntity="App\Entity\UserGroupe", mappedBy="User", orphanRemoval=false)
     */
    protected $relationsUserGroupe;


    /**
     * @Assert\Image(
     *     allowLandscape = false,
     *     allowPortrait = false
     * )
     */
    protected $photo;


    public function setPhoto(File $file = null)
    {
        $this->photo = $file;
    }

    public function getPhoto()
    {
        return $this->photo;
    }

    /**
     * @var string
     *
     * @ORM\Column(name="namephoto", type="string", length=20, nullable=true)
     */
    protected $namePhoto;


    public function setNamePhoto($namePhoto)
    {
        $this->namePhoto = $namePhoto;
    }

    public function getNamePhoto()
    {
        return $this->namePhoto;
    }


    /**
     * @return int
     */
    public function getRelationsUserGroupe()
    {
        return $this->relationsUserGroupe;
    }

    /**
     * @param $relationsUserGroupe
     */
    public function setRelationsUserGroupe($relationsUserGroupe)
    {
        $this->relationsUserGroupe = $relationsUserGroupe;
    }


    public function getIdUserGroupe(): ?int
    {
        return $this->id;
    }

    public function setIdUserGroupe(string $idUserGroupe): self
    {
        $this->idUserGroupe = $idUserGroupe;

        return $this;
    }




    public function getId(): ?int
    {
        return $this->id;
    }




    /**
     * @ORM\ManyToOne(targetEntity="Entreprise", inversedBy="user")
     * @ORM\JoinColumn(name="entreprise", referencedColumnName="id")
     */
    private $entreprise;

    /**
     * @return mixed
     */
    public function getEntreprise()
    {
        return $this->entreprise;
    }

    /**
     * @param mixed $entreprise
     */
    public function setEntreprise($entreprise)
    {
        $this->entreprise = $entreprise;
    }






}
