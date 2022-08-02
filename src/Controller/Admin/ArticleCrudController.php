<?php

namespace App\Controller\Admin;

use App\Entity\Article;
use EasyCorp\Bundle\EasyAdminBundle\Field\SlugField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class ArticleCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Article::class;
    }

    //to custom inputs 
    public function configureFields(string $pageName): iterable
    {
    
        yield TextField::new('title');//define an array and return the values in it

        yield SlugField::new('slug')
        ->setTargetFieldName('title');

        yield TextEditorField::new('content');

        yield TextField::new('featuredText');

        yield DateTimeField::new('createdAt');
        //->hideOnForm();

        yield DateTimeField::new('updatedAt');

    }
    
}
