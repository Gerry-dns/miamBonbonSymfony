<?php

namespace App\Entity;

use App\Repository\PromotionRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PromotionRepository::class)]
class Promotion
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?bool $estEnPromo = null;

    #[ORM\OneToMany(mappedBy: 'promotion', targetEntity: produits::class)]
    private Collection $relations;

    public function __construct()
    {
        $this->relations = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function isEstEnPromo(): ?bool
    {
        return $this->estEnPromo;
    }

    public function setEstEnPromo(bool $estEnPromo): self
    {
        $this->estEnPromo = $estEnPromo;

        return $this;
    }

    /**
     * @return Collection<int, produits>
     */
    public function getRelations(): Collection
    {
        return $this->relations;
    }

    public function addRelation(produits $relation): self
    {
        if (!$this->relations->contains($relation)) {
            $this->relations->add($relation);
            $relation->setPromotion($this);
        }

        return $this;
    }

    public function removeRelation(produits $relation): self
    {
        if ($this->relations->removeElement($relation)) {
            // set the owning side to null (unless already changed)
            if ($relation->getPromotion() === $this) {
                $relation->setPromotion(null);
            }
        }

        return $this;
    }
}
