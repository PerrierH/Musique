<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\InterPretRepository")
 */
class InterPret
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $quotite;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\ContratPret", inversedBy="interPrets")
     */
    private $contratPret;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Intervention", inversedBy="interPrets")
     */
    private $intervention;

    public function __construct()
    {

        $this->contratPrets = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getQuotite(): ?string
    {
        return $this->quotite;
    }

    public function setQuotite(string $quotite): self
    {
        $this->quotite = $quotite;

        return $this;
    }

    public function getContratPret(): ?ContratPret
    {
        return $this->contratPret;
    }

    public function setContratPret(?ContratPret $contratPret): self
    {
        $this->contratPret = $contratPret;

        return $this;
    }

    public function getIntervention(): ?Intervention
    {
        return $this->intervention;
    }

    public function setIntervention(?Intervention $intervention): self
    {
        $this->intervention = $intervention;

        return $this;
    }
}
