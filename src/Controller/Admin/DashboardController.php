<?php
namespace App\Controller\Admin;
//configuration of menu items

use App\Entity\Menu;
use App\Entity\User;
use App\Entity\Article;
use App\Entity\Comment;
use App\Entity\Category;
use App\Controller\CommentController;
use Symfony\Component\HttpFoundation\Response;
use App\Controller\Admin\ArticleCrudController;
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

        if($this->isGranted('ROLE_ADMIN')) {
            yield MenuItem::subMenu('Menus', 'fas fa-list')->setSubItems([
                MenuItem::linkToCrud('Pages', 'fas fa-file', Menu::class),
                MenuItem::linkToCrud('Articles', 'fas fa-newspaper', Menu::class), 
                MenuItem::linkToCrud('Liens personnalisés', 'fas fa-link', Menu::class),
                MenuItem::linkToCrud('Catégories', 'fab fa-delicious', Menu::class)
            ]);
        }

        if($this->isGranted('ROLE_AUTHOR')) {
            yield MenuItem::subMenu('Articles', 'fas fa-newspaper')->setSubItems([
                MenuItem::linkToCrud('Tous les articles', 'fas fa-newspaper', Article::class),
                MenuItem::linkToCrud('Add', 'fas fa-plus', Article::class)->setAction(Crud::PAGE_NEW), 
                MenuItem::linkToCrud('Categories', 'fas fa-list', Category::class)
            ]);
        }

        if($this->isGranted('ROLE_ADMIN')) {         
            yield MenuItem::linkToCrud('Commentaires', 'fas fa-comment', Comment::class);

            yield MenuItem::subMenu('Comptes', 'fas fa-user')->setSubItems([
                MenuItem::linkToCrud('All comptes', 'fas fa-user-friends', User::class),
                MenuItem::linkToCrud('Add', 'fas fa-plus', User::class)->setAction(Crud::PAGE_NEW)
            ]);
        }
    }
}
