<?php

namespace App\Controller;

use App\Repository\SeasonRepository;
use App\Repository\ProgramRepository;
use App\Repository\EpisodeRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class SeasonController extends AbstractController
{
    #[Route('/season', name: 'app_season')]
    public function index(): Response
    {
        return $this->render('season/index.html.twig', [
            'controller_name' => 'SeasonController',
        ]);
    }

    // #[Route('/program/{programId}/seasons/{seasonId}', name: 'program_season_show')]
    // public function showSeason(int $programId, EpisodeRepository $episodeRepository, int $seasonId, SeasonRepository $seasonRepository): Response
    // {
    //     $season = $seasonRepository->findOneBy(['seasonId' => $seasonId]);
    //     // same as $season = $seasonRepository->find($id);
    //     if (!$season) {
    //         throw $this->createNotFoundException(
    //             'No season with id : ' . $seasonId . ' found in program\'s table.'
    //         );
    //     }

    //     $episodes = $episodeRepository->findBy(['programId' => $programId]);

    //     return $this->render('program/season_show.html.twig', [
    //         'season' => $season,
    //         'episodes' => $episodes,
    //     ]);
    // }
}
