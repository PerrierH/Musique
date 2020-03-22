<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\MetierRepository")
 */
class Metier
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $libelle;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Professionnel", mappedBy="metiers")
     */
    private $professionnels;

    public function __construct()
    {
        $this->professionnels = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLibelle(): ?string
    {
        return $this->libelle;
    }

    public function setLibelle(string $libelle): self
    {
        $this->libelle = $libelle;

        return $this;
    }

    /**
     * @return Collection|Professionnel[]
     */
    public function getProfessionnels(): Collection
    {
        return $this->professionnels;
    }

    public function addProfessionnel(Professionnel $professionnel): self
    {
        if (!$this->professionnels->contains($professionnel)) {
            $this->professionnels[] = $professionnel;
            $professionnel->addMetier($this);
        }

        return $this;
    }

    public function removeProfessionnel(Professionnel $professionnel): self
    {
        if ($this->professionnels->contains($professionnel)) {
            $this->professionnels->removeElement($professionnel);
            $professionnel->removeMetier($this);
        }

        return $this;
    }

}
