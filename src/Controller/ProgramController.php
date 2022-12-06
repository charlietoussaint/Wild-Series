<?php

namespace App\Controller;

use App\Entity\Episode;
use App\Entity\Program;
use App\Entity\Season;
use App\Repository\SeasonRepository;
use App\Repository\ProgramRepository;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Entity;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ProgramController extends AbstractController
{
    #[Route('/program/', methods: ['GET'], name: 'index')]
    public function index(ProgramRepository $programRepository): Response
    {
        $programs = $programRepository->findAll();

        return $this->render('program/index.html.twig', [
            'programs' => $programs
        ]);
    }

    // #[Route('/show/{id<^[0-9]+$>}', name: 'program_show')]
    // public function show(int $id, ProgramRepository $programRepository, SeasonRepository $seasonRepository): Response
    // {
    //     $program = $programRepository->findOneBy(['id' => $id]);
    //     // same as $program = $programRepository->find($id);

    //     if (!$program) {
    //         throw $this->createNotFoundException(
    //             'No program with id : ' . $id . ' found in program\'s table.'
    //         );
    //     }

    //     $seasons = $seasonRepository->findBy(['id' => $id]);

    //     return $this->render('program/show.html.twig', [
    //         'program' => $program,
    //         'seasons' => $seasons,
    //     ]);
    // }

    #[Route('/show/{id}/', requirements: ['id' => '\d+'], methods: ['GET'], name: 'show')]
    public function show(Program $program, ProgramRepository $programRepository): Response
    {

        if (!$program) {
            throw $this->createNotFoundException(
                'No program with id : ' . $program['id'] . ' found in program\'s table.'
            );
        }

        return $this->render('program/show.html.twig', [
            'program' => $program,
        ]);
    }


    //     #[Route('/program/{programId}/seasons/{seasonId}', name: 'program_season_show')]
    //     public function showSeason(int $programId, ProgramRepository $programRepository, int $seasonId, SeasonRepository $seasonRepository): Response
    //     {
    //         $program = $programRepository->findOneBy(['id' => $programId]);
    //         // same as $program = $programRepository->find($id);

    //         if (!$program) {
    //             throw $this->createNotFoundException(
    //                 'No program with id : ' . $programId . ' found in program\'s table.'
    //             );
    //         }

    //         $seasons = $seasonRepository->findOneBy(['id' => $seasonId]);

    //         return $this->render('program/season_show.html.twig', [
    //             'program' => $program,
    //             'seasons' => $seasons,
    //         ]);
    //     }
    // }

    #[Route('/{program_id}/seasons/{season_id}', methods: ['GET'], name: 'season_show')]
    #[Entity('program', options: ['mapping' => ['program_id' => 'id']])]
    #[Entity('season', options: ['mapping' => ['season_id' => 'id']])]
    public function showSeason(Program $program, Season $season, ProgramRepository $programRepository, SeasonRepository $seasonRepository): Response
    {

        if (!$program) {
            throw $this->createNotFoundException(
                'No program with id : ' . $program['id'] . ' found in program\'s table.'
            );
        }

        if (!$season) {
            throw $this->createNotFoundException(
                'No season with id : ' . $season['id'] . ' found in program\'s table.'
            );
        }
        return $this->render('program/season_show.html.twig', [
            'program' => $program,
            'season' => $season,
        ]);
    }

    #[Route('/{program_id}/season/{season_id}/episode/{episode_id}', methods: ['GET'], name: 'program_episode_show')]
    #[Entity('program', options: ['mapping' => ['program_id' => 'id']])]
    #[Entity('season', options: ['mapping' => ['season_id' => 'id']])]
    #[Entity('episode', options: ['mapping' => ['episode_id' => 'id']])]
    public function showEpisode(Program $program, Season $season, Episode $episode, ProgramRepository $programRepository, SeasonRepository $seasonRepository): Response
    {

        if (!$program) {
            throw $this->createNotFoundException(
                'No program with id : ' . $program['id'] . ' found in program\'s table.'
            );
        }

        if (!$season) {
            throw $this->createNotFoundException(
                'No season with id : ' . $season['id'] . ' found in program\'s table.'
            );
        }

        if (!$episode) {
            throw $this->createNotFoundException(
                'No season with id : ' . $episode['id'] . ' found in program\'s table.'
            );
        }

        return $this->render('program/episode_show.html.twig', [
            'program' => $program,
            'season' => $season,
            'episode' => $episode,
        ]);
    }
}
