<?php

namespace App\Entity;

use Symfony\Component\Uid\Uuid;
use App\Repository\CampagneRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CampagneRepository::class)]
class Campagne
{
    #[ORM\Id]
   // #[ORM\GeneratedValue]
    // #[ORM\Column]
    #[ORM\Column(type:"string",length:50,nullable:false)]
   // private ?int $id = null;
    private ?string $id = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $titre = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $contenu = null;

    #[ORM\Column(type: Types::BIGINT, nullable: true)]
    private ?string $objectif = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $nom = null;

    #[ORM\Column(nullable: true)]
    private ?\DateTimeImmutable $cree_a = null;

    #[ORM\Column(nullable: true)]
    private ?\DateTimeImmutable $mise_a_jour = null;

    /**
     * @var Collection<int, Participants>
     */
    #[ORM\OneToMany(targetEntity: Participants::class, mappedBy: 'campagne')]
    private Collection $participants;

    public function __construct()
    {
        $this->participants = new ArrayCollection(); 
         $this->id = Uuid::v7();
    }

    public function getId(): ?string
    {
        return $this->id;
    }
    
    public function setId():static
    {

      
        return $this ;
    }

    public function getTitre(): ?string
    {
        return $this->titre;
    }

    public function setTitre(?string $titre): static
    {
        $this->titre = $titre;

        return $this;
    }

    public function getContenu(): ?string
    {
        return $this->contenu;
    }

    public function setContenu(?string $contenu): static
    {
        $this->contenu = $contenu;

        return $this;
    }

    public function getObjectif(): ?string
    {
        return $this->objectif;
    }

    public function setObjectif(?string $objectif): static
    {
        $this->objectif = $objectif;

        return $this;
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

    /**
     * @return Collection<int, Participants>
     */
    public function getParticipants(): Collection
    {
        return $this->participants;
    }

    public function addParticipant(Participants $participant): static
    {
        if (!$this->participants->contains($participant)) {
            $this->participants->add($participant);
            $participant->setCampagne($this);
        }

        return $this;
    }

    public function removeParticipant(Participants $participant): static
    {
        if ($this->participants->removeElement($participant)) {
            // set the owning side to null (unless already changed)
            if ($participant->getCampagne() === $this) {
                $participant->setCampagne(null);
            }
        }

        return $this;
    }
}
