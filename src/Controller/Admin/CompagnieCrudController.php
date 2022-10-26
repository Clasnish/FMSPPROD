<?php

namespace App\Controller\Admin;

use App\Entity\Compagnie;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\UrlField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\EmailField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class CompagnieCrudController extends AbstractCrudController
{

    public const COMPAGNY_BASE_PATH = 'upload/images/compagny';
    public const COMPAGNY_UPLOAD_DIR = 'public/upload/images/compagny';

    public static function getEntityFqcn(): string
    {
        return Compagnie::class;
    }

    
    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->hideOnForm(),
            TextField::new('name', 'Nom'),
            TextField::new('rccm', 'Registre du commerce'),
            TextField::new('vatNumber', 'Numero contribuable'),
            TextField::new('adress1', 'Adresse'),
            TextField::new('adress2', 'Adresse 2'),
            TextField::new('Tel1', 'Telephone'),
            TextField::new('Tel2', 'Telephone 2'),
            TextField::new('fax', 'Fax'),
            EmailField::new('email', 'Email'),
            EmailField::new('email2', 'Email 2'),
            UrlField::new('homeLink', 'Site internet'),
            UrlField::new('facebook', 'Page Facebook'),
            UrlField::new('twitter', 'Page Twitter'),
            UrlField::new('instagram', 'Page instagram'),
            TextField::new('poBox', 'BP'),
            TextField::new('country', 'Pays'),
            TextField::new('city', 'Ville'),
            TextField::new('label', 'Petite description'),
            TextEditorField::new('description', 'Description'),
            DateTimeField::new('Modified')->hideOnForm(),
            DateTimeField::new('Created')->hideOnForm(),
            ImageField::new('imageUrl', 'Logo')
            ->setBasePath(self::COMPAGNY_BASE_PATH)
            ->setUploadDir(self::COMPAGNY_UPLOAD_DIR)
            ->setSortable(false),
            
        ];
    }
    public function configureCrud(Crud $crud): Crud
    {
        return $crud->addFormTheme('@FOSCKEditor/Form/ckeditor_widget.html.twig');
    }
}
