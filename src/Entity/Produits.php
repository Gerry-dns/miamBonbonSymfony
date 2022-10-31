<?php

namespace App\Entity;

use App\Repository\ProduitsRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: ProduitsRepository::class)]
class Produits
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $nomProduits = null;

    #[ORM\Column(length: 255)]
    private ?string $refProduits = null;

    #[ORM\Column(type: 'float')]
    #[ASSERT\Positive()]
    #[ASSERT\NotNull()]
    private ?float $prixProduits = null;

    #[ORM\Column]
    private ?bool $vegan = null;

    #[ORM\Column]
    private ?float $poidProduits = null;

    #[ORM\Column(length: 255)]
    private ?string $typeProduits = null;

    #[ORM\ManyToOne(inversedBy: 'relation')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Marques $relationProduit = null;

    #[ORM\ManyToMany(targetEntity: Filtre::class, mappedBy: 'filtreRelation')]
    private Collection $filtresProduits;

    #[ORM\ManyToOne(inversedBy: 'relations')]
    private ?Promotion $promotion = null;

    public function __construct()
    {
        $this->filtresProduits = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomProduits(): ?string
    {
        return $this->nomProduits;
    }

    public function setNomProduits(string $nomProduits): self
    {
        $this->nomProduits = $nomProduits;

        return $this;
    }

    public function getRefProduits(): ?string
    {
        return $this->refProduits;
    }

    public function setRefProduits(string $refProduits): self
    {
        $this->refProduits = $refProduits;

        return $this;
    }

    public function getPrixProduits(): ?float
    {
        return $this->prixProduits;
    }

    public function setPrixProduits(float $prixProduits): self
    {
        $this->prixProduits = $prixProduits;

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

    public function getPoidProduits(): ?float
    {
        return $this->poidProduits;
    }

    public function setPoidProduits(float $poidProduits): self
    {
        $this->poidProduits = $poidProduits;

        return $this;
    }

    public function getTypeProduits(): ?string
    {
        return $this->typeProduits;
    }

    public function setTypeProduits(string $typeProduits): self
    {
        $this->typeProduits = $typeProduits;

        return $this;
    }

    public function getRelationProduit(): ?Marques
    {
        return $this->relationProduit;
    }

    public function setRelationProduit(?Marques $relationProduit): self
    {
        $this->relationProduit = $relationProduit;

        return $this;
    }

    /**
     * @return Collection<int, Filtre>
     */
    public function getFiltresProduits(): Collection
    {
        return $this->filtresProduits;
    }

    public function addFiltresProduit(Filtre $filtresProduit): self
    {
        if (!$this->filtresProduits->contains($filtresProduit)) {
            $this->filtresProduits->add($filtresProduit);
            $filtresProduit->addFiltreRelation($this);
        }

        return $this;
    }

    public function removeFiltresProduit(Filtre $filtresProduit): self
    {
        if ($this->filtresProduits->removeElement($filtresProduit)) {
            $filtresProduit->removeFiltreRelation($this);
        }

        return $this;
    }

    public function getPromotion(): ?Promotion
    {
        return $this->promotion;
    }

    public function setPromotion(?Promotion $promotion): self
    {
        $this->promotion = $promotion;

        return $this;
    }
}
