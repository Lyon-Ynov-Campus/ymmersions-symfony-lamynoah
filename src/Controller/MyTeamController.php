<?php

namespace App\Controller;

use App\Entity\Joueur;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;

class MyTeamController extends AbstractController
{
    #[Route('/my-team', name: 'app_my_team')]
    public function index(EntityManagerInterface $entityManager): Response
    {
        
        $user = $this->getUser();

        if (!$user) {
            $this->addFlash('danger', 'Vous devez être connecté pour voir votre équipe.');
            return $this->redirectToRoute('app_login');
        }

        $joueur = $entityManager->getRepository(Joueur::class)->findOneBy(['id_user' => $user]);

        if (!$joueur) {
            $this->addFlash('warning', 'Aucun joueur trouvé pour cet utilisateur.');
            return $this->redirectToRoute('app_team');
        }

        $equipe = $joueur->getIdEquipes();

        return $this->render('my_team/index.html.twig', [
            'equipe' => $equipe,
        ]);
    }
}
?>
