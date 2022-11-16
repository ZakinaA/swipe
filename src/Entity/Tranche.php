<?php

namespace App\Entity;

use App\Repository\TrancheRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: TrancheRepository::class)]
class Tranche
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 50)]
    private ?string $quotient = null;

    #[ORM\OneToMany(mappedBy: 'tranche', targetEntity: Responsable::class)]
    private Collection $responsables;

    #[ORM\OneToMany(mappedBy: 'tranche', targetEntity: Couter::class)]
    private Collection $couters;

    public function __construct()
    {
        $this->responsables = new ArrayCollection();
        $this->couters = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getQuotient(): ?string
    {
        return $this->quotient;
    }

    public function setQuotient(string $quotient): self
    {
        $this->quotient = $quotient;

        return $this;
    }

    /**
     * @return Collection<int, Responsable>
     */
    public function getResponsables(): Collection
    {
        return $this->responsables;
    }

    public function addResponsable(Responsable $responsable): self
    {
        if (!$this->responsables->contains($responsable)) {
            $this->responsables->add($responsable);
            $responsable->setTranche($this);
        }

        return $this;
    }

    public function removeResponsable(Responsable $responsable): self
    {
        if ($this->responsables->removeElement($responsable)) {
            // set the owning side to null (unless already changed)
            if ($responsable->getTranche() === $this) {
                $responsable->setTranche(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Couter>
     */
    public function getCouters(): Collection
    {
        return $this->couters;
    }

    public function addCouter(Couter $couter): self
    {
        if (!$this->couters->contains($couter)) {
            $this->couters->add($couter);
            $couter->setTranche($this);
        }

        return $this;
    }

    public function removeCouter(Couter $couter): self
    {
        if ($this->couters->removeElement($couter)) {
            // set the owning side to null (unless already changed)
            if ($couter->getTranche() === $this) {
                $couter->setTranche(null);
            }
        }

        return $this;
    }
}
