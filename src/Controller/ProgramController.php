<?php

namespace App\Controller;

use App\Entity\Episode;
use App\Entity\Program;
use App\Form\ProgramType;
use App\Entity\Season;
use App\Repository\EpisodeRepository;
use App\Repository\SeasonRepository;
use App\Repository\ProgramRepository;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Entity;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\String\Slugger\SluggerInterface;
use App\Service\ProgramDuration;

#[Route('/program', name: 'program_')]
class ProgramController extends AbstractController
{
    #[Route('/', methods: ['GET'], name: 'index')]
    public function index(ProgramRepository $programRepository): Response
    {
        $programs = $programRepository->findAll();

        return $this->render('program/index.html.twig', [
            'programs' => $programs
        ]);
    }

    #[Route('/new', name: 'new')]
    public function new(Request $request, ProgramRepository $programRepository, SluggerInterface $slugger): Response
    {
        // Create a new Porgram Object
        $program = new Program();

        // Create the form, linked with $program
        $form = $this->createForm(ProgramType::class, $program);

        // Get data from HTTP request
        $form->handleRequest($request);

        // Was the form submitted ?
        if ($form->isSubmitted() && $form->isValid()) {

            // Add the slug
            $slug = $slugger->slug($program->getTitle());
            $program->setSlug($slug);

            // Deal with the submitted data
            $programRepository->save($program, true);

            $this->addFlash('sucessColor', 'La nouvelle série a bien été créée');
            // Redirect to categories list
            return $this->redirectToRoute('program_index');
        }

        // Render the form (best practice)
        return $this->renderForm('program/new.html.twig', [
            'form' => $form,
        ]);
    }

    #[Route('/{slug}', methods: ['GET'], name: 'show')]
    public function show(Program $program, ProgramRepository $programRepository, ProgramDuration $programDuration): Response
    {

        if (!$program) {
            throw $this->createNotFoundException(
                'No program with id : ' . $program['id'] . ' found in program\'s table.'
            );
        }

        return $this->render('program/show.html.twig', [
            'program' => $program,
            'programDuration' => $programDuration->calculate($program)
        ]);
    }

    #[Route('/{slug}/seasons/{season_id}', methods: ['GET'], name: 'season_show')]
    #[Entity('program', options: ['mapping' => ['slug' => 'slug']])]
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

    #[Route('/{programSlug}/season/{season_id}/episode/{episodeSlug}', methods: ['GET'], name: 'episode_show')]
    #[Entity('program', options: ['mapping' => ['programSlug' => 'slug']])]
    #[Entity('season', options: ['mapping' => ['season_id' => 'id']])]
    #[Entity('episode', options: ['mapping' => ['episodeSlug' => 'slug']])]
    public function showEpisode(Program $program, Season $season, Episode $episode, ProgramRepository $programRepository, SeasonRepository $seasonRepository, EpisodeRepository $episodeRepository): Response
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


    // #LE GRAND CIMETIERE DES FONCTIONS

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
