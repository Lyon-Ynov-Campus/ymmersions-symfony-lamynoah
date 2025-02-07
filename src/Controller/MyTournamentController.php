<?php

namespace App\Controller;

use App\Entity\Tournament;
use App\Entity\Joueur;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Doctrine\ORM\EntityManagerInterface;

final class MyTournamentController extends AbstractController
{
    #[Route('/mytournament', name: 'app_my_tournament')]
    public function index(EntityManagerInterface $entityManager): Response
    {
        $user = $this->getUser();
        
        if (!$user) {
            $this->addFlash('danger', 'Vous devez être connecté pour voir vos tournois.');
            return $this->redirectToRoute('app_login');
        }

        $joueur = $entityManager->getRepository(Joueur::class)->findOneBy(['id_user' => $user]);

        if (!$joueur) {
            $this->addFlash('warning', 'Aucun joueur trouvé pour cet utilisateur.');
            return $this->redirectToRoute('app_tournaments');
        }

        $equipe = $joueur->getIdEquipes();

        if (!$equipe) {
            $this->addFlash('warning', 'Vous n\'avez pas d\'équipe.');
            return $this->redirectToRoute('app_tournaments');
        }

        $tournois = $equipe->getIdTournoi(); 

        return $this->render('my_tournament/index.html.twig', [
            'tournois' => $tournois,
        ]);
    }
}
