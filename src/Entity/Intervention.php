<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="App\Repository\InterventionRepository")
 */
class Intervention
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\Length(
     *      min = 2,
     *      max = 20,
     *      minMessage = "La date doit comporter au moins 2 caractères",
     *      maxMessage = "La date doit comporter au plus 20 caractères"
     *    )
     * @Assert\NotBlank()
     */
    private $dateDebut;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\Length(
     *      min = 2,
     *      max = 20,
     *      minMessage = "La date doit comporter au moins 2 caractères",
     *      maxMessage = "La date doit comporter au plus 20 caractères"
     *    )
     * @Assert\NotBlank()
     */
    private $dateFin;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\Length(
     *      min = 2,
     *      max = 255,
     *      minMessage = "La description doit comporter au moins 2 caractères",
     *      maxMessage = "La description doit comporter au plus 255 caractères"
     *    )
     * @Assert\NotBlank()
     */
    private $descriptif;

    /**
     * @ORM\Column(type="integer")
     * @Assert\Length(
     *      min = 1,
     *      max = 11,
     *      minMessage = "Le prix doit comporter au moins 1 caractères",
     *      maxMessage = "Le prix doit comporter au plus 11 caractères"
     *    )
     * @Assert\NotBlank()
     */
    private $prix;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\InterPret", mappedBy="intervention")
     */
    private $interPrets;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Professionnel", inversedBy="interventions")
     */
    private $professionnel;

    public function __construct()
    {
        $this->interPret = new ArrayCollection();
        $this->interPrets = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDateDebut(): ?string
    {
        return $this->dateDebut;
    }

    public function setDateDebut(string $dateDebut): self
    {
        $this->dateDebut = $dateDebut;

        return $this;
    }

    public function getDateFin(): ?string
    {
        return $this->dateFin;
    }

    public function setDateFin(string $dateFin): self
    {
        $this->dateFin = $dateFin;

        return $this;
    }

    public function getDescriptif(): ?string
    {
        return $this->descriptif;
    }

    public function setDescriptif(string $descriptif): self
    {
        $this->descriptif = $descriptif;

        return $this;
    }

    public function getPrix(): ?int
    {
        return $this->prix;
    }

    public function setPrix(int $prix): self
    {
        $this->prix = $prix;

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
            $interPret->setIntervention($this);
        }

        return $this;
    }

    public function removeInterPret(InterPret $interPret): self
    {
        if ($this->interPrets->contains($interPret)) {
            $this->interPrets->removeElement($interPret);
            // set the owning side to null (unless already changed)
            if ($interPret->getIntervention() === $this) {
                $interPret->setIntervention(null);
            }
        }

        return $this;
    }

    public function getProfessionnel(): ?Professionnel
    {
        return $this->professionnel;
    }

    public function setProfessionnel(?Professionnel $professionnel): self
    {
        $this->professionnel = $professionnel;

        return $this;
    }
}
