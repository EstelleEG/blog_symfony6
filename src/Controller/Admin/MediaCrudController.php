<?php
// Media form to add an image

namespace App\Controller\Admin;

use App\Entity\Media;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class MediaCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Media::class;
    }

    
    public function configureFields(string $pageName): iterable
    {
    
        $mediasDir = $this->getParameter('medias_directory');
        $uploadsDir = $this->getParameter('uploads_directory');

           yield TextField::new('name');

           yield TextField::new('altText', 'Texte alternatif');

           $imageField = ImageField::new('filename', 'Média')
                ->setBasePath($uploadsDir)
                ->setUploadDir($mediasDir) //path where we store the img
                ->setUploadedFileNamePattern('[slug]--[uuid].[extension]'); //uuid is unique id

           if (Crud::PAGE_EDIT == $pageName) {
               $imageField->setRequired(false);//img not compulsory when we edit 
           }

           yield $imageField;
    }
    
}
