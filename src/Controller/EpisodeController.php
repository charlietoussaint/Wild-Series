<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/episode')]
class EpisodeController extends AbstractController
{
    #[Route('/', name: 'app_episode')]
    public function index(): Response
    {
        return $this->render('episode/index.html.twig', [
            'controller_name' => 'EpisodeController',
        ]);
    }
}
