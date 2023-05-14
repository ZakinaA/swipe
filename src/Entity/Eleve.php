<?php

namespace App\Entity;

use App\Repository\EleveRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: EleveRepository::class)]
class Eleve
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 50)]
    private ?string $nom = null;

    #[ORM\Column(length: 50)]
    private ?string $prenom = null;

    #[ORM\ManyToOne(inversedBy: 'eleves')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Responsable $responsable = null;

    #[ORM\OneToOne(inversedBy: 'eleve', cascade: ['persist', 'remove'])]
    private ?Compte $compte = null;

    #[ORM\OneToMany(mappedBy: 'eleve', targetEntity: Emprunter::class)]
    private Collection $emprunters;

    #[ORM\OneToMany(mappedBy: 'eleve', targetEntity: Inscription::class)]
    private Collection $inscriptions;

    #[ORM\Column(type: Types::DATE_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $dateNaiss = null;

    public function __construct()
    {
        $this->emprunters = new ArrayCollection();
        $this->inscriptions = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    public function getPrenom(): ?string
    {
        return $this->prenom;
    }

    public function setPrenom(string $prenom): self
    {
        $this->prenom = $prenom;

        return $this;
    }

    public function getResponsable(): ?Responsable
    {
        return $this->responsable;
    }

    public function setResponsable(?Responsable $responsable): self
    {
        $this->responsable = $responsable;

        return $this;
    }

    public function getCompte(): ?Compte
    {
        return $this->compte;
    }

    public function setCompte(?Compte $compte): self
    {
        $this->compte = $compte;

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
            $emprunter->setEleve($this);
        }

        return $this;
    }

    public function removeEmprunter(Emprunter $emprunter): self
    {
        if ($this->emprunters->removeElement($emprunter)) {
            // set the owning side to null (unless already changed)
            if ($emprunter->getEleve() === $this) {
                $emprunter->setEleve(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Inscription>
     */
    public function getInscriptions(): Collection
    {
        return $this->inscriptions;
    }

    public function addInscription(Inscription $inscription): self
    {
        if (!$this->inscriptions->contains($inscription)) {
            $this->inscriptions->add($inscription);
            $inscription->setEleve($this);
        }

        return $this;
    }

    public function removeInscription(Inscription $inscription): self
    {
        if ($this->inscriptions->removeElement($inscription)) {
            // set the owning side to null (unless already changed)
            if ($inscription->getEleve() === $this) {
                $inscription->setEleve(null);
            }
        }

        return $this;
    }

    public function getDateNaiss(): ?\DateTimeInterface
    {
        return $this->dateNaiss;
    }

    public function setDateNaiss(?\DateTimeInterface $dateNaiss): self
    {
        $this->dateNaiss = $dateNaiss;

        return $this;
    }
}
