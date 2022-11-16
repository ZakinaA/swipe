<?php

namespace App\Entity;

use App\Repository\ProfesionnelRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ProfesionnelRepository::class)]
class Profesionnel
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 50)]
    private ?string $nom = null;

    #[ORM\Column(length: 50)]
    private ?string $prenom = null;

    #[ORM\Column(length: 50)]
    private ?string $rue = null;

    #[ORM\Column(length: 50)]
    private ?string $codeP = null;

    #[ORM\Column(length: 50)]
    private ?string $email = null;

    #[ORM\Column(length: 15)]
    private ?string $tel = null;

    #[ORM\OneToMany(mappedBy: 'profesionnel', targetEntity: Intervenir::class)]
    private Collection $intervenirs;

    #[ORM\Column(length: 50)]
    private ?string $ville = null;

    public function __construct()
    {
        $this->intervenirs = new ArrayCollection();
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

    public function getRue(): ?string
    {
        return $this->rue;
    }

    public function setRue(string $rue): self
    {
        $this->rue = $rue;

        return $this;
    }

    public function getCodeP(): ?string
    {
        return $this->codeP;
    }

    public function setCodeP(string $codeP): self
    {
        $this->codeP = $codeP;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getTel(): ?string
    {
        return $this->tel;
    }

    public function setTel(string $tel): self
    {
        $this->tel = $tel;

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
            $intervenir->setProfesionnel($this);
        }

        return $this;
    }

    public function removeIntervenir(Intervenir $intervenir): self
    {
        if ($this->intervenirs->removeElement($intervenir)) {
            // set the owning side to null (unless already changed)
            if ($intervenir->getProfesionnel() === $this) {
                $intervenir->setProfesionnel(null);
            }
        }

        return $this;
    }

    public function getVille(): ?string
    {
        return $this->ville;
    }

    public function setVille(string $ville): self
    {
        $this->ville = $ville;

        return $this;
    }
}
