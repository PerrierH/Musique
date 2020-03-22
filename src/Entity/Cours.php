<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\CoursRepository")
 */
class Cours
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
     * @ORM\Column(type="integer")
     */
    private $ageMini;

    /**
     * @ORM\Column(type="string", length=5)
     */
    private $heureDebut;

    /**
     * @ORM\Column(type="string", length=5)
     */
    private $heureFin;

    /**
     * @ORM\Column(type="integer")
     */
    private $nbPlaces;

    /**
     * @ORM\Column(type="integer")
     */
    private $ageMaxi;

    /**
     * @ORM\Column(type="boolean")
     */
    private $typeCours;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Tranche", inversedBy="cours")
     */
    private $tranche;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Professeur", inversedBy="cours")
     */
    private $professeur;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Jour", inversedBy="cours")
     */
    private $jour;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Inscription", mappedBy="cours")
     */
    private $inscriptions;

    public function __construct()
    {
        $this->tranche = new ArrayCollection();
        $this->jour = new ArrayCollection();
        $this->inscriptions = new ArrayCollection();
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

    public function getAgeMini(): ?int
    {
        return $this->ageMini;
    }

    public function setAgeMini(int $ageMini): self
    {
        $this->ageMini = $ageMini;

        return $this;
    }

    public function getHeureDebut(): ?string
    {
        return $this->heureDebut;
    }

    public function setHeureDebut(string $heureDebut): self
    {
        $this->heureDebut = $heureDebut;

        return $this;
    }

    public function getHeureFin(): ?string
    {
        return $this->heureFin;
    }

    public function setHeureFin(string $heureFin): self
    {
        $this->heureFin = $heureFin;

        return $this;
    }

    public function getNbPlaces(): ?int
    {
        return $this->nbPlaces;
    }

    public function setNbPlaces(int $nbPlaces): self
    {
        $this->nbPlaces = $nbPlaces;

        return $this;
    }

    public function getAgeMaxi(): ?int
    {
        return $this->ageMaxi;
    }

    public function setAgeMaxi(int $ageMaxi): self
    {
        $this->ageMaxi = $ageMaxi;

        return $this;
    }

    public function getTypeCours(): ?bool
    {
        return $this->typeCours;
    }

    public function setTypeCours(bool $typeCours): self
    {
        $this->typeCours = $typeCours;

        return $this;
    }

    /**
     * @return Collection|Tranche[]
     */
    public function getTranche(): Collection
    {
        return $this->tranche;
    }

    public function addTranche(Tranche $tranche): self
    {
        if (!$this->tranche->contains($tranche)) {
            $this->tranche[] = $tranche;
        }

        return $this;
    }

    public function removeTranche(Tranche $tranche): self
    {
        if ($this->tranche->contains($tranche)) {
            $this->tranche->removeElement($tranche);
        }

        return $this;
    }

    public function getProfesseur(): ?Professeur
    {
        return $this->professeur;
    }

    public function setProfesseur(?Professeur $professeur): self
    {
        $this->professeur = $professeur;

        return $this;
    }

    /**
     * @return Collection|Jour[]
     */
    public function getJour(): Collection
    {
        return $this->jour;
    }

    public function addJour(Jour $jour): self
    {
        if (!$this->jour->contains($jour)) {
            $this->jour[] = $jour;
        }

        return $this;
    }

    public function removeJour(Jour $jour): self
    {
        if ($this->jour->contains($jour)) {
            $this->jour->removeElement($jour);
        }

        return $this;
    }

    /**
     * @return Collection|Inscription[]
     */
    public function getInscriptions(): Collection
    {
        return $this->inscriptions;
    }

    public function addInscription(Inscription $inscription): self
    {
        if (!$this->inscriptions->contains($inscription)) {
            $this->inscriptions[] = $inscription;
            $inscription->setCours($this);
        }

        return $this;
    }

    public function removeInscription(Inscription $inscription): self
    {
        if ($this->inscriptions->contains($inscription)) {
            $this->inscriptions->removeElement($inscription);
            // set the owning side to null (unless already changed)
            if ($inscription->getCours() === $this) {
                $inscription->setCours(null);
            }
        }

        return $this;
    }
}
