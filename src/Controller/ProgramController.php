<?php

namespace App\Controller;

use App\Repository\ProgramRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
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

    #[Route('/show/{id<^[0-9]+$>}', name: 'program_show')]
    public function show(int $id, ProgramRepository $programRepository): Response
    {
        $program = $programRepository->findOneBy(['id' => $id]);
        // same as $program = $programRepository->find($id);

        if (!$program) {
            throw $this->createNotFoundException(
                'No program with id : ' . $id . ' found in program\'s table.'
            );
        }
        return $this->render('program/show.html.twig', [
            'program' => $program,
        ]);
    }

    // #[Route('/category/{id<^[0-9]+$>}', name: 'category_show')]
    // public function showCategory(int $id, ProgramRepository $programRepository): Response
    // {
    //     $programs = $programRepository->findBy(
    //         ['category' => $id],
    //     );
    //     // same as $program = $programRepository->find($id);

    //     if (!$programs) {
    //         throw $this->createNotFoundException(
    //             'No program with id : ' . $id . ' found in program\'s table.'
    //         );
    //     }
    //     return $this->render('category/show.html.twig', [
    //         'programs' => $programs,
    //     ]);
    // }
}
