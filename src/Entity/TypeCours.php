<?php

namespace App\Entity;

use App\Repository\TypeCoursRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: TypeCoursRepository::class)]
class TypeCours
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 50)]
    private ?string $libelle = null;

    #[ORM\OneToMany(mappedBy: 'typeCours', targetEntity: Cours::class)]
    private Collection $cours;

    #[ORM\OneToMany(mappedBy: 'typeCours', targetEntity: Couter::class)]
    private Collection $couters;

    public function __construct()
    {
        $this->cours = new ArrayCollection();
        $this->couters = new ArrayCollection();
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
            $cour->setTypeCours($this);
        }

        return $this;
    }

    public function removeCour(Cours $cour): self
    {
        if ($this->cours->removeElement($cour)) {
            // set the owning side to null (unless already changed)
            if ($cour->getTypeCours() === $this) {
                $cour->setTypeCours(null);
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
            $couter->setTypeCours($this);
        }

        return $this;
    }

    public function removeCouter(Couter $couter): self
    {
        if ($this->couters->removeElement($couter)) {
            // set the owning side to null (unless already changed)
            if ($couter->getTypeCours() === $this) {
                $couter->setTypeCours(null);
            }
        }

        return $this;
    }
}
