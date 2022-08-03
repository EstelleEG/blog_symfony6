<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class CommentController extends AbstractController
{
    #[Route('/ajax/comments', name: 'comment_add')]
    public function index(Request $request): Response
    {
        $commentData = $request->request->all('comment');
        return $this->render('comment/index.html.twig', [
            'controller_name' => 'CommentController',
        ]);
    }


}
