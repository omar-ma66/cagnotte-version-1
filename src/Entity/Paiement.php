<?php

namespace App\Entity;

use App\Repository\PaiementRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
#[ORM\Entity(repositoryClass: PaiementRepository::class)]
class Paiement
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(nullable: true)]
    #[Assert\Positive()]
    private ?float $montant = null;

    #[ORM\Column(nullable: true)]
    private ?\DateTimeImmutable $cree_a = null;

    #[ORM\Column(nullable: true)]
    private ?\DateTimeImmutable $mise_a_jour = null;

    #[ORM\OneToOne(cascade: ['persist', 'remove'])]
    private ?Participants $participant = null;

   
    #[ORM\ManyToOne(targetEntity: Campagne::class)]

    #[ORM\JoinColumn(nullable: false)] 
    private ?Campagne $campagne = null ;
    
    public function getId(): ?int
    {
        return $this->id;
    }

    public function getMontant(): ?float
    {
        return $this->montant;
    }

    public function setMontant(?float $montant): static
    {
        $this->montant = $montant;

        return $this;
    }

    public function getCreeA(): ?\DateTimeImmutable
    {
        return $this->cree_a;
    }

    public function setCreeA(?\DateTimeImmutable $cree_a): static
    {
        $this->cree_a = $cree_a;

        return $this;
    }

    public function getMiseAJour(): ?\DateTimeImmutable
    {
        return $this->mise_a_jour;
    }

    public function setMiseAJour(?\DateTimeImmutable $mise_a_jour): static
    {
        $this->mise_a_jour = $mise_a_jour;

        return $this;
    }

    public function getParticipant(): ?Participants
    {
        return $this->participant;
    }

    public function setParticipant(?Participants $participant): static
    {
        $this->participant = $participant;

        return $this;
    }

   
    public function getCampagne(): ?Campagne
    {
        return $this->campagne;
    }

    public function setCampagne(?Campagne $campagne): static
    {
        $this->campagne = $campagne;
        return $this;
    }
}
