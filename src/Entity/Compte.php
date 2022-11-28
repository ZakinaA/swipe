<?php

namespace App\Entity;

use App\Repository\CompteRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CompteRepository::class)]
class Compte
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 50)]
    private ?string $mail = null;

    #[ORM\Column(length: 50)]
    private ?string $mdp = null;

    #[ORM\OneToOne(mappedBy: 'compte', cascade: ['persist', 'remove'])]
    private ?Responsable $responsable = null;

    #[ORM\OneToOne(mappedBy: 'compte', cascade: ['persist', 'remove'])]
    private ?Eleve $eleve = null;

    #[ORM\ManyToOne(inversedBy: 'comptes')]
    private ?Role $role = null;



    public function getId(): ?int
    {
        return $this->id;
    }

    public function getMail(): ?string
    {
        return $this->mail;
    }

    public function setMail(string $mail): self
    {
        $this->mail = $mail;

        return $this;
    }

    public function getMdp(): ?string
    {
        return $this->mdp;
    }

    public function setMdp(string $mdp): self
    {
        $this->mdp = $mdp;

        return $this;
    }

    public function getResponsable(): ?Responsable
    {
        return $this->responsable;
    }

    public function setResponsable(?Responsable $responsable): self
    {
        // unset the owning side of the relation if necessary
        if ($responsable === null && $this->responsable !== null) {
            $this->responsable->setCompte(null);
        }

        // set the owning side of the relation if necessary
        if ($responsable !== null && $responsable->getCompte() !== $this) {
            $responsable->setCompte($this);
        }

        $this->responsable = $responsable;

        return $this;
    }

    public function getEleve(): ?Eleve
    {
        return $this->eleve;
    }

    public function setEleve(?Eleve $eleve): self
    {
        // unset the owning side of the relation if necessary
        if ($eleve === null && $this->eleve !== null) {
            $this->eleve->setCompte(null);
        }

        // set the owning side of the relation if necessary
        if ($eleve !== null && $eleve->getCompte() !== $this) {
            $eleve->setCompte($this);
        }

        $this->eleve = $eleve;

        return $this;
    }

    public function getRole(): ?Role
    {
        return $this->role;
    }

    public function setRole(?Role $role): self
    {
        $this->role = $role;

        return $this;
    }


}
