<?php

namespace App\Entity;

use App\Repository\ProduitRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ProduitRepository::class)]
class Produit
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\OneToOne(mappedBy: 'produit_id', cascade: ['persist', 'remove'])]
    private ?Promotion $id_produit = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getIdProduit(): ?Promotion
    {
        return $this->id_produit;
    }

    public function setIdProduit(?Promotion $id_produit): self
    {
        // unset the owning side of the relation if necessary
        if ($id_produit === null && $this->id_produit !== null) {
            $this->id_produit->setProduitId(null);
        }

        // set the owning side of the relation if necessary
        if ($id_produit !== null && $id_produit->getProduitId() !== $this) {
            $id_produit->setProduitId($this);
        }

        $this->id_produit = $id_produit;

        return $this;
    }
    public function __toString(): string {
        return $this->name.' '.$this->id;
    }
}
