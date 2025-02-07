<?php

namespace App\Entity;

use App\Repository\EquipesRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: EquipesRepository::class)]
class Equipes
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column]
    private ?int $max_joueur = null;

    #[ORM\ManyToOne(inversedBy: 'id_equipes')]
    private ?Tournament $id_tournoi = null;

    #[ORM\ManyToOne(inversedBy: 'id_equipe')]
    private ?Versus $id_versus = null;

    #[ORM\ManyToOne(inversedBy: 'equipes')]
    private ?Joueur $id_joueur = null;

    /**
     * @var Collection<int, Joueur>
     */
    #[ORM\OneToMany(targetEntity: Joueur::class, mappedBy: 'id_equipes')]
    

    
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

    public function getMaxJoueur(): ?int
    {
        return $this->max_joueur;
    }

    public function setMaxJoueur(int $max_joueur): static
    {
        $this->max_joueur = $max_joueur;

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

    public function getIdVersus(): ?Versus
    {
        return $this->id_versus;
    }

    public function setIdVersus(?Versus $id_versus): static
    {
        $this->id_versus = $id_versus;

        return $this;
    }

   
    // public function addIdJoueur(Joueur $idJoueur): static
    // {
    //     if (!$this->id_joueur->contains($idJoueur)) {
    //         $this->id_joueur->add($idJoueur);
    //         $idJoueur->setIdEquipes($this);
    //     }

    //     return $this;
    // }

    // public function removeIdJoueur(Joueur $idJoueur): static
    // {
    //     if ($this->id_joueur->removeElement($idJoueur)) {
    //         // set the owning side to null (unless already changed)
    //         if ($idJoueur->getIdEquipes() === $this) {
    //             $idJoueur->setIdEquipes(null);
    //         }
    //     }

    //     return $this;
    // }

    public function getIdJoueur(): ?Joueur
    {
        return $this->id_joueur;
    }

    public function setIdJoueur(?Joueur $id_joueur): static
    {
        $this->id_joueur = $id_joueur;

        return $this;
    }
}
