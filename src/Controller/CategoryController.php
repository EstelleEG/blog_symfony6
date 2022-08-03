<?php

namespace App\Controller;
//my route and my array of existing categories
use App\Entity\Category;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class CategoryController extends AbstractController
{
    #[Route('/category/{slug}', name: 'category_show')]
    public function show(?Category $category): Response
    {
        if (!$category){ //if no category, go to homepage
            return $this->redirectToRoute('home');
        }
        return $this->render('category/show.html.twig', [
            'category' => $category
        ]);
    }
}
