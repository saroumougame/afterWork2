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
     * @ORM\Column(name="user", type="integer", nullable=false)
     * @ORM\ManyToOne(targetEntity="App\Entity\User", inversedBy="relationsUserGroupe")
     * @ORM\JoinColumn(nullable=false)
     */
    private $user;


    /**
     * @ORM\Column(name="groupe", type="integer", nullable=false)
     * @ORM\ManyToOne(targetEntity="App\Entity\Groupe", inversedBy="relationsUserGroupe")
     * @ORM\JoinColumn(nullable=false)
     */
    private $groupe;



    //Getters

    /** @return User  */
    public function getUser() { return $this->user; }
    /** @return Groupe  */
    public function getGroupe() { return $this->groupe; }

    //Setters

    /** @param Dotation $user L'agent de la relation agent-syndicat. */
    public function setDotation($user) { $this->user = $user; }
    /** @param Fonction $fonction Le syndicat dans la relation agent-syndicat. */
    public function setFonction($groupe) { $this->groupe = $groupe; }


}
