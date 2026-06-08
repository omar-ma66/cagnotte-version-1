<?php

namespace App\Entity;

use App\Repository\ParticipantsRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\component\validator\constraints as Assert;
#[ORM\Entity(repositoryClass: ParticipantsRepository::class)]
class Participants
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255, nullable: true)]
    #[Assert\NotBlank]
    private ?string $nom = null;

    #[ORM\Column(length: 255, nullable: true)]
    #[Assert\NotBlank]
    private ?string $email = null;

    #[ORM\Column(nullable: true)]
    private ?\DateTimeImmutable $cree_a = null;

    #[ORM\Column(nullable: true)]
    private ?\DateTimeImmutable $mise_a_jour = null;

    #[ORM\ManyToOne(inversedBy: 'participants')]
    #[ORM\JoinColumn(name: "campagne_id", referencedColumnName: "id", columnDefinition: "VARCHAR(50) NULL")]
    private ?Campagne $campagne = null;

    #[ORM\Column]
    private ?bool $etreAnonyme = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(?string $nom): static
    {
        $this->nom = $nom;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(?string $email): static
    {
        $this->email = $email;

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

    public function getCampagne(): ?Campagne
    {
        return $this->campagne;
    }

    public function setCampagne(?Campagne $campagne): static
    {
        $this->campagne = $campagne;

        return $this;
    }

    public function isEtreAnonyme(): ?bool
    {
        return $this->etreAnonyme;
    }

    public function setEtreAnonyme(bool $etreAnonyme): static
    {
        $this->etreAnonyme = $etreAnonyme;

        return $this;
    }
}
