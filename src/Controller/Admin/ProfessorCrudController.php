<?php

namespace App\Controller\Admin;

use App\Entity\Professor;
use Doctrine\ORM\EntityManagerInterface;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class ProfessorCrudController extends AbstractCrudController
{
    public const PROFESSOR_BASE_PATH = 'upload/images/Professor';
    public const PROFESSOR_UPLOAD_DIR = 'public/upload/images/Professor';
    public static function getEntityFqcn(): string
    {
        return Professor::class;
    }

    
    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->hideOnForm(),
            TextField::new('FirstName', 'Nom'),
            TextField::new('LastName', 'Prenom'),
            DateField::new('BirthDay', "Date Naissance"),
            TextField::new('Fonction', 'Fonction'),
            TextField::new('Phone', 'Tel'),
            TextField::new('Email', 'Email'),
            TextField::new('Linkin', 'Linkin'),
            TextField::new('Facebook', 'Facebook'),
            TextField::new('Twitter', 'Twitter'),
            DateField::new('StartDate', 'Date Debut contrat'),
            DateField::new('EndDate', 'Date Fin contract'),
            BooleanField::new('Active', 'Doyen'),
            TextEditorField::new('Description'),
            DateTimeField::new('Modified')->hideOnForm(),
            DateTimeField::new('created')->hideOnForm(),

            ImageField::new('imageUrl', 'Image')
            ->setBasePath(self::PROFESSOR_BASE_PATH)
            ->setUploadDir(self::PROFESSOR_UPLOAD_DIR)
            ->setSortable(false),
        ];
    }

       
    public function persistEntity(EntityManagerInterface $em, $entityInstance): void
    {
        if (!$entityInstance instanceof Professor) return;

        $entityInstance->setCreated(new \DateTimeImmutable);

        parent::persistEntity($em, $entityInstance);
    }

    public function updateEntity(EntityManagerInterface $em, $entityInstance): void
    {
        if (!$entityInstance instanceof Professor) return;

        $entityInstance->setModified(new \DateTimeImmutable);

        parent::updateEntity($em, $entityInstance);
    }

    
}
