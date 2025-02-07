<?php

namespace App\DataFixtures;

use App\Entity\User;
use App\Entity\Versus;
use App\Entity\Tournament;
use App\Entity\Joueur;
use App\Entity\Equipes;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class AppFixtures extends Fixture
{
    private UserPasswordHasherInterface $passwordHasher;

    public function __construct(UserPasswordHasherInterface $passwordHasher)
    {
        $this->passwordHasher = $passwordHasher;
    }

    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create('fr_FR');

        $users = [];
        $equipes = [];
        $tournaments = [];
        $versusList = [];

        // === Créer 10 utilisateurs ===
        for ($i = 0; $i < 10; $i++) {
            $user = new User();
            $user->setEmail(email:$faker->unique()->email);
            $user->setRoles($faker->boolean(20) ? ['ROLE_ADMIN'] : ['ROLE_USER']); // 20% chance d'être admin
            $user->setPassword($this->passwordHasher->hashPassword($user, 'password123')); // Hash du mot de passe
            $user->setDateOfBirth($faker->dateTimeBetween('-40 years', '-18 years'));
            $user->setName($faker->name);

            $manager->persist($user);
            $users[] = $user;
        }

        // === Créer 5 tournois ===
        for ($i = 0; $i < 5; $i++) {
            $tournament = new Tournament();
            $tournament->setName($faker->word);
            $tournament->setCashprice($faker->numberBetween(500, 5000));
            $tournament->setMaxEquipes($faker->numberBetween(4, 10));
            $tournament->setDateDebut($faker->dateTimeThisYear('+1 month'));
            $tournament->setDateFin($faker->dateTimeThisYear('+2 months'));
            $tournament->setCreatedAt($faker->dateTimeThisYear());
            $tournament->setDescription($faker->sentence);
            $tournament->setStatus($faker->randomElement(['pas commencé', 'en cours', 'terminé']));

            $manager->persist($tournament);
            $tournaments[] = $tournament;
        }

        // === Créer 10 équipes (2 par tournoi) ===
        foreach ($tournaments as $tournament) {
            for ($i = 0; $i < 2; $i++) {
                $equipe = new Equipes();
                $equipe->setName($faker->word);
                $equipe->setMaxJoueur(5);
                $equipe->setIdTournoi($tournament);
                $equipe->setIdVersus(null);
                $manager->persist($equipe);
                $equipes[] = $equipe;
            }
        }

        // === Assigner des joueurs aux équipes ===
        foreach ($users as $user) {
            $joueur = new Joueur();
            $joueur->setIdUser($user);
            $joueur->setIdEquipes($faker->randomElement($equipes));
            $manager->persist($joueur);
        }

        // === Créer 10 matchs ===
        for ($i = 0; $i < 10; $i++) {
            $match = new Versus();
            $match->setName("Match " . ($i + 1));
            $match->setDateMatch($faker->dateTimeThisYear());
            $match->setScore($faker->numberBetween(0, 10));
            $match->setIdTournoi($faker->randomElement($tournaments));
            $manager->persist($match);
            $versusList[] = $match;
        }

        $manager->flush();
    }
}

