<?php

namespace App\Controller;

use App\Entity\Actor;
use App\Repository\ActorRepository;
use App\Repository\CategoryRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/actor')]
class ActorController extends AbstractController
{
    #[Route('/actor', name: 'app_actor')]
    public function index(): Response
    {
        return $this->render('actor/index.html.twig', [
            'controller_name' => 'ActorController',
        ]);
    }

    #[Route('/{id}', name: 'app_actor_show', methods: ['GET'])]
    public function show(Actor $actor, CategoryRepository $categoryRepository): Response
    {
        $categories = $categoryRepository->findAll();

        return $this->render('actor/show.html.twig', [
            'actor' => $actor,
            'categories' => $categories

        ]);
    }
}
