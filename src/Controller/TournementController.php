<?php

namespace App\Controller;

use App\Entity\Equipes;
use App\Entity\Tournament;
use App\Entity\Joueur;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class TournementController extends AbstractController
{
    #[Route('/tournaments', name: 'app_tournaments')]
    public function index(EntityManagerInterface $entityManager): Response
    {
        $tournaments = $entityManager->getRepository(Tournament::class)->findAll();

        return $this->render('tournement/index.html.twig', [
            'tournaments' => $tournaments,
        ]);
    }

    #[Route('/tournament/join/{id}', name: 'tournament_join', methods: ['POST'])]
    public function joinTournament(int $id, EntityManagerInterface $entityManager): Response
    {
        $user = $this->getUser();
        
        if (!$user) {
            $this->addFlash('danger', 'Vous devez être connecté pour inscrire votre équipe.');
            return $this->redirectToRoute('app_login');
        }

        $joueur = $entityManager->getRepository(Joueur::class)->findOneBy(['id_user' => $user]);

        if (!$joueur) {
            $this->addFlash('warning', 'Aucun joueur associé à votre compte.');
            return $this->redirectToRoute('app_tournaments');
        }

        $equipe = $joueur->getIdEquipes();

        if (!$equipe) {
            $this->addFlash('warning', 'Vous devez appartenir à une équipe.');
            return $this->redirectToRoute('app_tournaments');
        }

        $tournoi = $entityManager->getRepository(Tournament::class)->find($id);

        if (!$tournoi) {
            $this->addFlash('danger', 'Tournoi introuveable.');
            return $this->redirectToRoute('app_tournaments');
        }

        if ($tournoi->getIdEquipes()->contains($equipe)) {
            $this->addFlash('warning', 'Votre équipe est déjà inscrite.');
            return $this->redirectToRoute('app_tournaments');
        }

        $tournoi->addIdEquipe($equipe);
        $entityManager->persist($tournoi);
        $entityManager->flush();

        $this->addFlash('success', 'Votre équipe a été inscrite ');

        return $this->redirectToRoute('app_tournaments');
    }
}
