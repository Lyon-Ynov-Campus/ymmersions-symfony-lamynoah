<?php

namespace App\Entity;

use App\Repository\VersusRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: VersusRepository::class)]
class Versus
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $score = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $date_match = null;

    #[ORM\ManyToOne(inversedBy: 'id_versus')]
    private ?Tournament $id_tournoi = null;

    /**
     * @var Collection<int, equipes>
     */
    #[ORM\OneToMany(targetEntity: Equipes::class, mappedBy: 'id_versus')]
    private Collection $id_equipe;

    public function __construct()
    {
        $this->id_equipe = new ArrayCollection();
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

    public function getScore(): ?string
    {
        return $this->score;
    }

    public function setScore(?string $score): static
    {
        $this->score = $score;

        return $this;
    }

    public function getDateMatch(): ?\DateTimeInterface
    {
        return $this->date_match;
    }

    public function setDateMatch(\DateTimeInterface $date_match): static
    {
        $this->date_match = $date_match;

        return $this;
    }

    public function getIdTournoi(): ?Tournament
    {
        return $this->id_tournoi;
    }

    public function setIdTournoi(?Tournament $id_tournoi): static
    {
        $this->id_tournoi = $id_tournoi;

        return $this;
    }

    /**
     * @return Collection<int, Equipes>
     */
    public function getIdEquipe(): Collection
    {
        return $this->id_equipe;
    }

    public function addIdEquipe(Equipes $idEquipe): static
    {
        if (!$this->id_equipe->contains($idEquipe)) {
            $this->id_equipe->add($idEquipe);
            $idEquipe->setIdVersus($this);
        }

        return $this;
    }

    public function removeIdEquipe(Equipes $idEquipe): static
    {
        if ($this->id_equipe->removeElement($idEquipe)) {
            // set the owning side to null (unless already changed)
            if ($idEquipe->getIdVersus() === $this) {
                $idEquipe->setIdVersus(null);
            }
        }

        return $this;
    }
}
