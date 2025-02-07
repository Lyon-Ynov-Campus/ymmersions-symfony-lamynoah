<?php

namespace App\Controller;

use App\Entity\Equipes;
use App\Entity\Joueur;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

final class TeamController extends AbstractController
{
    #[Route('/team', name: 'app_team')]
    public function index(EntityManagerInterface $entityManager): Response
    {
        $equipes = $entityManager->getRepository(Equipes::class)->findAll();

        return $this->render('team/index.html.twig', [
            'equipes' => $equipes,
        ]);
    }

    #[Route('/team/join/{id}', name: 'team_join', methods: ['POST'])]
    public function joinTeam(int $id, EntityManagerInterface $entityManager, Request $request): Response
    {
        $user = $this->getUser();
        
        if (!$user) {
            $this->addFlash('danger', 'Vous devez être connecté pour rejoindre une équipe.');
            return $this->redirectToRoute('app_login');
        }

        $joueur = $entityManager->getRepository(Joueur::class)->findOneBy(['id_user' => $user]);

        if (!$joueur) {
            $this->addFlash('danger', 'Aucun joueur associé à cet utilisateur.');
            return $this->redirectToRoute('app_team');
        }

        $equipe = $entityManager->getRepository(Equipes::class)->find($id);

        if (!$equipe) {
            $this->addFlash('danger', 'Équipe introuvable.');
            return $this->redirectToRoute('app_team');
        }

        if ($joueur->getIdEquipes()) {
            $this->addFlash('danger', 'Vous faites déjà partie d\'une équipe.');
            return $this->redirectToRoute('app_team');
        }

        
        $joueur->setIdEquipes($equipe);
        $entityManager->persist($joueur);
        $entityManager->flush();

        $this->addFlash('success', 'Vous avez rejoint l\'équipe avec succès.');

        return $this->redirectToRoute('app_team');
    }
}
