<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * TjUserGroupe
 *
 * @ORM\Table(name="tj_user_groupe")
 * @ORM\Entity
 */
class UserGroupe
{

    /**
     * UserGroupe constructor.
     * @param User $user
     * @param Groupe $groupe
     */
    public function __construct(User $User, Groupe $groupe) {
        $this->setUser($User);
        $this->setGroupe($groupe);
    }

    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;


    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\User", inversedBy="relationsUserGroupe")
     * @ORM\JoinColumn(name="user", referencedColumnName="id")
     */
    private $user;


    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Groupe", inversedBy="relationsUserGroupe")
     * @ORM\JoinColumn(name="groupe", referencedColumnName="idGroupe")
     */
    private $groupe;

    /**
     * @ORM\Column(type="integer", name="statue")
     */
    private $statue;

    /**
     * @ORM\Column(type="integer", name="inviteur")
     */
    private $inviteur;


    /**
     * @ORM\Column(type="integer", name="roleGroupe")
     */
    private $roleGroupe;

    /**
     * @return mixed
     */
    public function getRoleGroupe()
    {
        return $this->roleGroupe;
    }

    /**
     * @param mixed $roleGroupe
     */
    public function setRoleGroupe($roleGroupe)
    {
        $this->roleGroupe = $roleGroupe;
    }










    /**
     * @return mixed
     */
    public function getStatue()
    {
        return $this->statue;
    }

    /**
     * @param mixed $statue
     */
    public function setStatue($statue)
    {
        $this->statue = $statue;
    }

    /**
     * @return mixed
     */
    public function getInviteur()
    {
        return $this->inviteur;
    }

    /**
     * @param mixed $inviteur
     */
    public function setInviteur($inviteur)
    {
        $this->inviteur = $inviteur;
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId(int $id)
    {
        $this->id = $id;
    }




    //Getters

    /** @return User  */
    public function getUser() { return $this->user; }
    /** @return Groupe  */
    public function getGroupe() { return $this->groupe; }

    //Setters

    /** @param Dotation $user L'agent de la relation agent-syndicat. */
    public function setUser($user) { $this->user = $user; }
    /** @param Fonction $fonction Le syndicat dans la relation agent-syndicat. */
    public function setGroupe($groupe) { $this->groupe = $groupe; }


}
