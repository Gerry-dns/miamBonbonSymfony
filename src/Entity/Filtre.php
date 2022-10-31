<?php

namespace App\Entity;

use App\Repository\FiltreRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: FiltreRepository::class)]
class Filtre
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?float $poidFiltre = null;

    #[ORM\Column(length: 255)]
    private ?string $typeFiltre = null;

    #[ORM\Column]
    private ?bool $vegan = null;

    #[ORM\Column]
    private ?float $prixFiltre = null;

    #[ORM\Column(length: 255)]
    private ?string $marqueFiltre = null;

    #[ORM\ManyToMany(targetEntity: produits::class, inversedBy: 'filtresProduits')]
    private Collection $filtreRelation;

    public function __construct()
    {
        $this->filtreRelation = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPoidFiltre(): ?float
    {
        return $this->poidFiltre;
    }

    public function setPoidFiltre(float $poidFiltre): self
    {
        $this->poidFiltre = $poidFiltre;

        return $this;
    }

    public function getTypeFiltre(): ?string
    {
        return $this->typeFiltre;
    }

    public function setTypeFiltre(string $typeFiltre): self
    {
        $this->typeFiltre = $typeFiltre;

        return $this;
    }

    public function isVegan(): ?bool
    {
        return $this->vegan;
    }

    public function setVegan(bool $vegan): self
    {
        $this->vegan = $vegan;

        return $this;
    }

    public function getPrixFiltre(): ?float
    {
        return $this->prixFiltre;
    }

    public function setPrixFiltre(float $prixFiltre): self
    {
        $this->prixFiltre = $prixFiltre;

        return $this;
    }

    public function getMarqueFiltre(): ?string
    {
        return $this->marqueFiltre;
    }

    public function setMarqueFiltre(string $marqueFiltre): self
    {
        $this->marqueFiltre = $marqueFiltre;

        return $this;
    }

    /**
     * @return Collection<int, produits>
     */
    public function getFiltreRelation(): Collection
    {
        return $this->filtreRelation;
    }

    public function addFiltreRelation(produits $filtreRelation): self
    {
        if (!$this->filtreRelation->contains($filtreRelation)) {
            $this->filtreRelation->add($filtreRelation);
        }

        return $this;
    }

    public function removeFiltreRelation(produits $filtreRelation): self
    {
        $this->filtreRelation->removeElement($filtreRelation);

        return $this;
    }
}
