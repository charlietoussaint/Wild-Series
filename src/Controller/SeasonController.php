<?php

namespace App\Controller;

use App\Entity\Season;
use App\Repository\SeasonRepository;
use App\Repository\ProgramRepository;
use App\Repository\EpisodeRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/season')]
class SeasonController extends AbstractController
{
    #[Route('/', name: 'app_season_index', methods: ['GET'])]
    public function index(SeasonRepository $seasonRepository): Response
    {
        return $this->render('season/index.html.twig', [
            'seasons' => $seasonRepository->findAll(),
        ]);
    }

    #[Route('/{id}', name: 'app_season_show', methods: ['GET'])]
    public function show(Season $season): Response
    {
        return $this->render('season/show.html.twig', [
            'season' => $season,
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
