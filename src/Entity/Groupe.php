<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Groupe
 *
 * @ORM\Table(name="groupe")
 * @ORM\Entity(repositoryClass="App\Repository\GroupeRepository")
 */
class Groupe
{

    public function __construct() {
        $this->relationsUserGroupe = new ArrayCollection();
    }

    public function __toString()
    {
        return (string) $this->getNom();
    }


    /**
     * @ORM\Id
     * @ORM\Column(type="integer", name="idGroupe")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $idGroupe;

    /**
     * @ORM\Column(type="string", name="nom")
     */
    private $nom;


    /**
     * @var ArrayCollection
     *
     * @ORM\OneToMany(targetEntity="App\Entity\UserGroupe", mappedBy="groupe", orphanRemoval=true)
     */
    private $relationsUserGroupe;



    /**
     * @ORM\OneToMany(targetEntity="Message", mappedBy="groupe")
     */
    private $message;

    /**
     * @param mixed $message
     */
    public function setMessage($message)
    {
        $this->message = $message;
    }

    /**
     * @return ArrayCollection
     */
    public function getRelationsUserGroupe(): ArrayCollection
    {
        return $this->relationsUserGroupe;
    }

    /**
     * @return mixed
     */
    public function getMessage()
    {
        return $this->message;
    }




    //Getters

    /** @return int L'identifiant technique. */
    public function getIdGroupe() { return $this->idGroupe; }
    /** @return string Le code du syndicat. */
    public function getNom() { return $this->nom; }


    /** @return ArrayCollection Une liste de relation fonctionuser.  */
    public function getRelationsUserGoupe() { return $this->relationsUserGroupe; }


    //Setters

    public function setIdgroupe($idGroupe) { $this->Idgroupe = $idGroupe; }

    /** @param ArrayCollection $relationUserGroupe */
    public function setRelationsUserGroupe($relationUserGroupe) {
        $this->relationsUserGroupe = $relationUserGroupe;
    }

    /**
     * @param mixed $nom
     */
    public function setNom($nom)
    {
        $this->nom = $nom;
    }





    //FUNCTIONS

    /**
     * Ajoute à la groupe une relation user-groupe
     * @param
     * usergroupe $relation La relation groupe-user à ajouter à l'agent
     */
    public function addRelationUserGroupe(UserGroupe $relation) {
        // Si l'objet fait déjà partie de la collection on ne l'ajoute pas
        if (!$this->relationsUserGroupe->contains($relation)) {
            $this->relationsUserGroupe->add($relation);
            $relation->setGroupe($this);
        }
    }

    /**
     * Retire une relation user-groupe .
     * @param usergroupe $relation La relation groupe-user a retirer de l'agent.
     */
    public function removeUserGroupe(UserGroupe $relation) {
        $this->relationsUserGroupe->removeElement($relation);
    }

    public function remouveAllUserGroupe(){
        foreach ($this->getRelationsUserGroupe() as $d){
            $this->removeUserGroupe($d);
        }
    }


    /**
     * @return mixed
     */
    public function getCategory()
    {
        return $this->category;
    }

    /**
     * @param mixed $category
     */
    public function setCategory($category)
    {
        $this->category = $category;
    }

}
