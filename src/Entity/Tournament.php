<?php

namespace App\Entity;

use App\Repository\TournamentRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: TournamentRepository::class)]
class Tournament
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column(nullable: true)]
    private ?float $cashprice = null;

    #[ORM\Column]
    private ?int $max_equipes = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $date_debut = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $date_fin = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $created_at = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $description = null;

    #[ORM\Column(length: 255)]
    private ?string $status = null;

    /**
     * @var Collection<int, Equipes>
     */
    #[ORM\OneToMany(targetEntity: Equipes::class, mappedBy: 'id_tournoi')]
    private Collection $id_equipes;

    /**
     * @var Collection<int, Versus>
     */
    #[ORM\OneToMany(targetEntity: Versus::class, mappedBy: 'id_tournoi')]
    private Collection $id_versus;

    public function __construct()
    {
        $this->id_equipes = new ArrayCollection();
        $this->id_versus = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    public function getCashprice(): ?float
    {
        return $this->cashprice;
    }

    public function setCashprice(?float $cashprice): static
    {
        $this->cashprice = $cashprice;

        return $this;
    }

    public function getMaxEquipes(): ?int
    {
        return $this->max_equipes;
    }

    public function setMaxEquipes(int $max_equipes): static
    {
        $this->max_equipes = $max_equipes;

        return $this;
    }

    public function getDateDebut(): ?\DateTimeInterface
    {
        return $this->date_debut;
    }

    public function setDateDebut(\DateTimeInterface $date_debut): static
    {
        $this->date_debut = $date_debut;

        return $this;
    }

    public function getDateFin(): ?\DateTimeInterface
    {
        return $this->date_fin;
    }

    public function setDateFin(\DateTimeInterface $date_fin): static
    {
        $this->date_fin = $date_fin;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->created_at;
    }

    public function setCreatedAt(\DateTimeInterface $created_at): static
    {
        $this->created_at = $created_at;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): static
    {
        $this->description = $description;

        return $this;
    }

    public function getStatus(): ?string
    {
        return $this->status;
    }

    public function setStatus(string $status): static
    {
        $this->status = $status;

        return $this;
    }

    /**
     * @return Collection<int, Equipes>
     */
    public function getIdEquipes(): Collection
    {
        return $this->id_equipes;
    }

    public function addIdEquipe(Equipes $idEquipe): static
    {
        if (!$this->id_equipes->contains($idEquipe)) {
            $this->id_equipes->add($idEquipe);
            $idEquipe->setIdTournoi($this);
        }

        return $this;
    }

    public function removeIdEquipe(Equipes $idEquipe): static
    {
        if ($this->id_equipes->removeElement($idEquipe)) {
            // set the owning side to null (unless already changed)
            if ($idEquipe->getIdTournoi() === $this) {
                $idEquipe->setIdTournoi(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Versus>
     */
    public function getIdVersus(): Collection
    {
        return $this->id_versus;
    }

    public function addIdVersu(Versus $idVersu): static
    {
        if (!$this->id_versus->contains($idVersu)) {
            $this->id_versus->add($idVersu);
            $idVersu->setIdTournoi($this);
        }

        return $this;
    }

    public function removeIdVersu(Versus $idVersu): static
    {
        if ($this->id_versus->removeElement($idVersu)) {
            // set the owning side to null (unless already changed)
            if ($idVersu->getIdTournoi() === $this) {
                $idVersu->setIdTournoi(null);
            }
        }

        return $this;
    }
}
