<?php

namespace App\Controller\Admin;
//configure the form to add an user

use App\Entity\User;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ChoiceField;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Security\Http\Authenticator\Passport\Passport;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class UserCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return User::class;
    }

    
    public function configureFields(string $pageName): iterable
    {
            yield TextField::new('username');
            yield TextField::new('password')
                ->setFormType(PasswordType::class)
                ->onlyOnForms();

            yield ChoiceField::new('roles') //liste depliante 
                ->allowMultipleChoices()
                ->renderAsBadges([
                    'ROLE_ADMIN' => 'success',
                    'ROLE_AUTHOR' => 'warning',
                ])
                ->setChoices([
                    'Administrateur' => 'ROLE_ADMIN',
                    'Auteur' => 'ROLE_AUTHOR',
                ]);

    }
    
}
