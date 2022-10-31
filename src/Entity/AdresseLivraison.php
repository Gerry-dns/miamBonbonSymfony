<?php

namespace App\Entity;

use App\Repository\AdresseLivraisonRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: AdresseLivraisonRepository::class)]
class AdresseLivraison
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 50)]
    private ?string $numeroRue = null;

    #[ORM\Column(length: 150)]
    private ?string $nomRue = null;

    #[ORM\Column(length: 15)]
    private ?string $codePostal = null;

    #[ORM\Column(length: 255)]
    private ?string $ville = null;

    #[ORM\OneToMany(mappedBy: 'adresseLivraison', targetEntity: commande::class)]
    private Collection $relation;

    public function __construct()
    {
        $this->relation = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNumeroRue(): ?string
    {
        return $this->numeroRue;
    }

    public function setNumeroRue(string $numeroRue): self
    {
        $this->numeroRue = $numeroRue;

        return $this;
    }

    public function getNomRue(): ?string
    {
        return $this->nomRue;
    }

    public function setNomRue(string $nomRue): self
    {
        $this->nomRue = $nomRue;

        return $this;
    }

    public function getCodePostal(): ?string
    {
        return $this->codePostal;
    }

    public function setCodePostal(string $codePostal): self
    {
        $this->codePostal = $codePostal;

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

    /**
     * @return Collection<int, commande>
     */
    public function getRelation(): Collection
    {
        return $this->relation;
    }

    public function addRelation(commande $relation): self
    {
        if (!$this->relation->contains($relation)) {
            $this->relation->add($relation);
            $relation->setAdresseLivraison($this);
        }

        return $this;
    }

    public function removeRelation(commande $relation): self
    {
        if ($this->relation->removeElement($relation)) {
            // set the owning side to null (unless already changed)
            if ($relation->getAdresseLivraison() === $this) {
                $relation->setAdresseLivraison(null);
            }
        }

        return $this;
    }
}
