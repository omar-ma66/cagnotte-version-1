<?php

namespace App\Entity;

use App\Repository\PaiementRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PaiementRepository::class)]
class Paiement
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(nullable: true)]
    private ?float $montant = null;

    #[ORM\Column(nullable: true)]
    private ?\DateTimeImmutable $cree_a = null;

    #[ORM\Column(nullable: true)]
    private ?\DateTimeImmutable $mise_a_jour = null;

    #[ORM\OneToOne(cascade: ['persist', 'remove'])]
    private ?Participants $participant = null;

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
}
