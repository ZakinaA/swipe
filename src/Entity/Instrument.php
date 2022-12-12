<?php

namespace App\Entity;

use App\Repository\InstrumentRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: InstrumentRepository::class)]
class Instrument
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 50)]
    private ?string $intitule = null;

    #[ORM\Column]
    private ?float $prixAchat = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $dateAchat = null;

    #[ORM\Column(length: 50)]
    private ?string $utilisation = null;

    #[ORM\OneToMany(mappedBy: 'instrument', targetEntity: Emprunter::class)]
    private Collection $emprunters;

    #[ORM\OneToMany(mappedBy: 'instrument', targetEntity: Cours::class)]
    private Collection $cours;

    #[ORM\ManyToOne(inversedBy: 'instruments')]
    private ?Marque $marque = null;

    #[ORM\ManyToOne(inversedBy: 'instruments')]
    private ?Couleur $couleur = null;

    #[ORM\ManyToOne(inversedBy: 'instruments')]
    private ?Etat $etat = null;

    #[ORM\ManyToOne(inversedBy: 'instruments')]
    private ?TypeInstrument $typeInstrument = null;

    #[ORM\OneToMany(mappedBy: 'instrument', targetEntity: Intervenir::class)]
    private Collection $intervenirs;

    #[ORM\OneToMany(mappedBy: 'instrument', targetEntity: Accessoire::class)]
    private Collection $accessoires;
    

    public function __construct()
    {
        $this->emprunters = new ArrayCollection();
        $this->cours = new ArrayCollection();
        $this->intervenirs = new ArrayCollection();
        $this->accessoires = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIntitule(): ?string
    {
        return $this->intitule;
    }

    public function setIntitule(string $intitule): self
    {
        $this->intitule = $intitule;

        return $this;
    }

    public function getPrixAchat(): ?float
    {
        return $this->prixAchat;
    }

    public function setPrixAchat(float $prixAchat): self
    {
        $this->prixAchat = $prixAchat;

        return $this;
    }

    public function getDateAchat(): ?\DateTimeInterface
    {
        return $this->dateAchat;
    }

    public function setDateAchat(\DateTimeInterface $dateAchat): self
    {
        $this->dateAchat = $dateAchat;

        return $this;
    }

    public function getUtilisation(): ?string
    {
        return $this->utilisation;
    }

    public function setUtilisation(string $utilisation): self
    {
        $this->utilisation = $utilisation;

        return $this;
    }

    /**
     * @return Collection<int, Emprunter>
     */
    public function getEmprunters(): Collection
    {
        return $this->emprunters;
    }

    public function addEmprunter(Emprunter $emprunter): self
    {
        if (!$this->emprunters->contains($emprunter)) {
            $this->emprunters->add($emprunter);
            $emprunter->setInstrument($this);
        }

        return $this;
    }

    public function removeEmprunter(Emprunter $emprunter): self
    {
        if ($this->emprunters->removeElement($emprunter)) {
            // set the owning side to null (unless already changed)
            if ($emprunter->getInstrument() === $this) {
                $emprunter->setInstrument(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Cours>
     */
    public function getCours(): Collection
    {
        return $this->cours;
    }

    public function addCour(Cours $cour): self
    {
        if (!$this->cours->contains($cour)) {
            $this->cours->add($cour);
            $cour->setInstrument($this);
        }

        return $this;
    }

    public function removeCour(Cours $cour): self
    {
        if ($this->cours->removeElement($cour)) {
            // set the owning side to null (unless already changed)
            if ($cour->getInstrument() === $this) {
                $cour->setInstrument(null);
            }
        }

        return $this;
    }

    public function getMarque(): ?Marque
    {
        return $this->marque;
    }

    public function setMarque(?Marque $marque): self
    {
        $this->marque = $marque;

        return $this;
    }

    public function getCouleur(): ?Couleur
    {
        return $this->couleur;
    }

    public function setCouleur(?Couleur $couleur): self
    {
        $this->couleur = $couleur;

        return $this;
    }

    public function getEtat(): ?Etat
    {
        return $this->etat;
    }

    public function setEtat(?Etat $etat): self
    {
        $this->etat = $etat;

        return $this;
    }

    public function getTypeInstrument(): ?TypeInstrument
    {
        return $this->typeInstrument;
    }

    public function setTypeInstrument(?TypeInstrument $typeInstrument): self
    {
        $this->typeInstrument = $typeInstrument;

        return $this;
    }

    /**
     * @return Collection<int, Intervenir>
     */
    public function getIntervenirs(): Collection
    {
        return $this->intervenirs;
    }

    public function addIntervenir(Intervenir $intervenir): self
    {
        if (!$this->intervenirs->contains($intervenir)) {
            $this->intervenirs->add($intervenir);
            $intervenir->setInstrument($this);
        }

        return $this;
    }

    public function removeIntervenir(Intervenir $intervenir): self
    {
        if ($this->intervenirs->removeElement($intervenir)) {
            // set the owning side to null (unless already changed)
            if ($intervenir->getInstrument() === $this) {
                $intervenir->setInstrument(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Accessoire>
     */
    public function getAccessoires(): Collection
    {
        return $this->accessoires;
    }

    public function addAccessoire(Accessoire $accessoire): self
    {
        if (!$this->accessoires->contains($accessoire)) {
            $this->accessoires->add($accessoire);
            $accessoire->setInstrument($this);
        }

        return $this;
    }

    public function removeAccessoire(Accessoire $accessoire): self
    {
        if ($this->accessoires->removeElement($accessoire)) {
            // set the owning side to null (unless already changed)
            if ($accessoire->getInstrument() === $this) {
                $accessoire->setInstrument(null);
            }
        }

        return $this;
    }
    
}
