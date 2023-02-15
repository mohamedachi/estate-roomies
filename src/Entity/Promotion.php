<?php

namespace App\Entity;

use App\Repository\PromotionRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: PromotionRepository::class)]
class Promotion
{  
    #[ORM\Id]
    #[ORM\Column]
    #[Assert\NotBlank(message:"le titre est obligatoire")]    
        public ?int $id = null;
   

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    #[Assert\NotBlank(message:"le titre est obligatoire")]
    private ?\DateTimeInterface $start_date = null;
    
    #[ORM\Column(type: Types::DATE_MUTABLE)]
    #[Assert\NotBlank(message:"le titre est obligatoire")]
    private ?\DateTimeInterface $end_date = null;

    #[ORM\Column]
    #[Assert\Range(
        min: 0,
        max: 99,
        notInRangeMessage: 'You must be between {{ min }} and {{ max }}to enter',
    )]
    private ?float $pourcentage = null;

   // #[ORM\OneToOne(inversedBy: 'id_produit', cascade: ['persist', 'remove'])]
   #[ORM\OneToOne(inversedBy: 'id_produit')]
    private ?Produit $produit_id = null;

    #[ORM\ManyToOne(inversedBy: 'promotions')]
    private ?CategoriePromotion $id_categ = null;



   


    public function getId(): ?int
    {
        return $this->id;
    }


    public function getStartDate(): ?\DateTimeInterface
    {
        return $this->start_date;
    }

    public function setStartDate(\DateTimeInterface $start_date): self
    {
        $this->start_date = $start_date;

        return $this;
    }

    public function getEndDate(): ?\DateTimeInterface
    {
        return $this->end_date;
    }

    public function setEndDate(\DateTimeInterface $end_date): self
    {
        $this->end_date = $end_date;

        return $this;
    }

    public function getPourcentage(): ?float
    {
        return $this->pourcentage;
    }

    public function setPourcentage(float $pourcentage): self
    {
        $this->pourcentage = $pourcentage;

        return $this;
    }

    public function getProduitId(): ?produit
    {
        return $this->produit_id;
    }

    public function setProduitId(?produit $produit_id): self
    {
        $this->produit_id = $produit_id;

        return $this;
    }

    public function getIdCateg(): ?categoriepromotion
    {
        return $this->id_categ;
    }

    public function setIdCateg(?categoriepromotion $id_categ): self
    {
        $this->id_categ = $id_categ;

        return $this;
    }

   

    public function getPromotions(): ?Categ
    {
        return $this->promotions;
    }

    public function setPromotions(?Categ $promotions): self
    {
        $this->promotions = $promotions;

        return $this;
    }

 



   
}
