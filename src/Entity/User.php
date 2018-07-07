<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use FOS\UserBundle\FOSUserBundle;
use Doctrine\Common\Collections\ArrayCollection;
use FOS\UserBundle\Model\User as FOSUser;

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
