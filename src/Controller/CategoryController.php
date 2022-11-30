<?php

namespace App\Controller;

use App\Repository\CategoryRepository;
use App\Repository\ProgramRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CategoryController extends AbstractController
{
    #[Route('/category/', methods: ['GET'], name: 'category_index')]
    public function index(CategoryRepository $categoryRepository): Response
    {
        $categorys = $categoryRepository->findAll();

        return $this->render('category/index.html.twig', [
            'categorys' => $categorys
        ]);
    }

    #[Route('/category/{id<^[0-9]+$>}', name: 'category_show')]
    public function show(int $id, CategoryRepository $categoryRepository, ProgramRepository $programRepository): Response
    {
        $category = $categoryRepository->findOneBy(['id' => $id]);
        // same as $category = $categoryRepository->find($id);

        if (!$category) {
            throw $this->createNotFoundException(
                'No category with id : ' . $id . ' found in category\'s table.'
            );
        }

        $programs = $programRepository->findBy(
            ['category' => $id],
            ['id' => 'DESC'],
            3,
            0
        );

        return $this->render('category/show.html.twig', [
            'category' => $category,
            'programs' => $programs,
        ]);
    }
}
