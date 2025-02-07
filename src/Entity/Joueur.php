<?php

namespace App\Entity;

use App\Repository\JoueurRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: JoueurRepository::class)]
class Joueur
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'id_joueur')]
    private ?User $id_user = null;

    #[ORM\ManyToOne(inversedBy: 'id_joueur')]
    private ?Equipes $id_equipes = null;

    /**
     * @var Collection<int, Equipes>
     */
    #[ORM\OneToMany(targetEntity: Equipes::class, mappedBy: 'id_joueur')]
    private Collection $equipes;

    public function __construct()
    {
        $this->equipes = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIdUser(): ?User
    {
        return $this->id_user;
    }

    public function setIdUser(?User $id_user): static
    {
        $this->id_user = $id_user;

        return $this;
    }

    public function getIdEquipes(): ?Equipes
    {
        return $this->id_equipes;
    }

    public function setIdEquipes(?Equipes $id_equipes): static
    {
        $this->id_equipes = $id_equipes;

        return $this;
    }

    /**
     * @return Collection<int, Equipes>
     */
    public function getEquipes(): Collection
    {
        return $this->equipes;
    }

    public function addEquipe(Equipes $equipe): static
    {
        if (!$this->equipes->contains($equipe)) {
            $this->equipes->add($equipe);
            $equipe->setIdJoueur($this);
        }

        return $this;
    }

    public function removeEquipe(Equipes $equipe): static
    {
        if ($this->equipes->removeElement($equipe)) {
            // set the owning side to null (unless already changed)
            if ($equipe->getIdJoueur() === $this) {
                $equipe->setIdJoueur(null);
            }
        }

        return $this;
    }
}
