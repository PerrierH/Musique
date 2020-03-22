<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ContratPretRepository")
 */
class ContratPret
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="date")
     */
    private $dateDebut;

    /**
     * @ORM\Column(type="date")
     */
    private $dateFin;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $attestationAssurance;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $etatDetailleDebut;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $etatDetailleRetour;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\InterPret", mappedBy="contratPret")
     */
    private $interPrets;

    public function __construct()
    {
        $this->interPrets = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDateDebut(): ?\DateTimeInterface
    {
        return $this->dateDebut;
    }

    public function setDateDebut(\DateTimeInterface $dateDebut): self
    {
        $this->dateDebut = $dateDebut;

        return $this;
    }

    public function getDateFin(): ?\DateTimeInterface
    {
        return $this->dateFin;
    }

    public function setDateFin(\DateTimeInterface $dateFin): self
    {
        $this->dateFin = $dateFin;

        return $this;
    }

    public function getAttestationAssurance(): ?string
    {
        return $this->attestationAssurance;
    }

    public function setAttestationAssurance(string $attestationAssurance): self
    {
        $this->attestationAssurance = $attestationAssurance;

        return $this;
    }

    public function getEtatDetailleDebut(): ?string
    {
        return $this->etatDetailleDebut;
    }

    public function setEtatDetailleDebut(string $etatDetailleDebut): self
    {
        $this->etatDetailleDebut = $etatDetailleDebut;

        return $this;
    }

    public function getEtatDetailleRetour(): ?string
    {
        return $this->etatDetailleRetour;
    }

    public function setEtatDetailleRetour(string $etatDetailleRetour): self
    {
        $this->etatDetailleRetour = $etatDetailleRetour;

        return $this;
    }

    /**
     * @return Collection|InterPret[]
     */
    public function getInterPrets(): Collection
    {
        return $this->interPrets;
    }

    public function addInterPret(InterPret $interPret): self
    {
        if (!$this->interPrets->contains($interPret)) {
            $this->interPrets[] = $interPret;
            $interPret->setContratPret($this);
        }

        return $this;
    }

    public function removeInterPret(InterPret $interPret): self
    {
        if ($this->interPrets->contains($interPret)) {
            $this->interPrets->removeElement($interPret);
            // set the owning side to null (unless already changed)
            if ($interPret->getContratPret() === $this) {
                $interPret->setContratPret(null);
            }
        }

        return $this;
    }
}
