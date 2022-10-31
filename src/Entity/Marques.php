<?php

namespace App\Entity;

use App\Repository\MarquesRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: MarquesRepository::class)]
class Marques
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $nomMarques = null;

    #[ORM\Column(length: 255)]
    private ?string $referenceMarque = null;

    #[ORM\OneToMany(mappedBy: 'relationProduit', targetEntity: Produits::class)]
    private Collection $relation;

    public function __construct()
    {
        $this->relation = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomMarques(): ?string
    {
        return $this->nomMarques;
    }

    public function setNomMarques(string $nomMarques): self
    {
        $this->nomMarques = $nomMarques;

        return $this;
    }

    public function getReferenceMarque(): ?string
    {
        return $this->referenceMarque;
    }

    public function setReferenceMarque(string $referenceMarque): self
    {
        $this->referenceMarque = $referenceMarque;

        return $this;
    }

    /**
     * @return Collection<int, Produits>
     */
    public function getRelation(): Collection
    {
        return $this->relation;
    }

    public function addRelation(Produits $relation): self
    {
        if (!$this->relation->contains($relation)) {
            $this->relation->add($relation);
            $relation->setRelationProduit($this);
        }

        return $this;
    }

    public function removeRelation(Produits $relation): self
    {
        if ($this->relation->removeElement($relation)) {
            // set the owning side to null (unless already changed)
            if ($relation->getRelationProduit() === $this) {
                $relation->setRelationProduit(null);
            }
        }

        return $this;
    }
}
