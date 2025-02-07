<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class RegisterPageController extends AbstractController
{
    #[Route('/register_page', name: 'app_register_page')]
    public function index(): Response
    {
        return $this->render('register_page/index.html.twig', [
            'controller_name' => 'RegisterPageController',
        ]);
    }
}
