<?php

namespace App\Controller\Admin;
//configuration of menu items

use App\Entity\Article;
use App\Entity\Comment;
use Symfony\Component\HttpFoundation\Response;
use App\Controller\Admin\ArticleCrudController;
use App\Controller\CommentController;
use App\Entity\Category;
use Symfony\Component\Routing\Annotation\Route;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Router\AdminUrlGenerator;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;

class DashboardController extends AbstractDashboardController
{
    public function __construct(
        private AdminUrlGenerator $adminUrlGenerator)
    {

    }

    #[Route('/admin', name: 'admin')]
    public function index(): Response
    {
        $url = $this->adminUrlGenerator->setController(ArticleCrudController::class)
        ->generateUrl();

        return $this->redirect($url);

    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('MyBlog');
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linkToRoute('Go to website', 'fa fa-undo', 'home');

        yield MenuItem::subMenu('Articles', 'fas fa-newspaper')->setSubItems([
            MenuItem::linkToCrud('Tous les articles', 'fas fa-newspaper', Article::class),
            MenuItem::linkToCrud('Add', 'fas fa-plus', Article::class)->setAction(Crud::PAGE_NEW), 
            MenuItem::linkToCrud('Categories', 'fas fa-list', Category::class)
        ]);

        yield MenuItem::linkToCrud('Commentaires', 'fas fa-comment', Comment::class);

    }
}
