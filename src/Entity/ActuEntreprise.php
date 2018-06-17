<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ActuEntreprise
 *
 * @ORM\Table(name="actu_entreprise")
 * @ORM\Entity
 */
class ActuEntreprise
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="message", type="string", length=200, nullable=false)
     */
    private $message;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date", type="date", nullable=false)
     */
    private $date;

    
    /**
     * @ORM\ManyToOne(targetEntity="ActuEntreprise", inversedBy="id")
     * @ORM\JoinColumn(name="entreprise", referencedColumnName="id")
     */
    private $Entreprise;



    public function getId(): ?int
    {
        return $this->id;
    }

    public function getMessage(): ?string
    {
        return $this->message;
    }

    public function setMessage(string $message): self
    {
        $this->message = $message;

        return $this;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(\DateTimeInterface $date): self
    {
        $this->date = $date;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getEntreprise()
    {
        return $this->Entreprise;
    }

    /**
     * @param mixed $Entreprise
     */
    public function setEntreprise($Entreprise)
    {
        $this->Entreprise = $Entreprise;
    }







}
