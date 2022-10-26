<?php

namespace App\Controller\Admin;

use App\Entity\Laboratory;
use App\Field\CKEditorField;
use Doctrine\ORM\EntityManagerInterface;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class LaboratoryCrudController extends AbstractCrudController
{

    public const FACULTIES_BASE_PATH = 'upload/images/Laboratory';
    public const FACULTIES_UPLOAD_DIR = 'public/upload/images/Laboratory';

    public static function getEntityFqcn(): string
    {
        return Laboratory::class;
    }

    
    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->hideOnForm(),
            TextField::new('Name', 'Nom'),
            TextEditorField::new('Description', 'Description'),
            DateTimeField::new('Modified')->hideOnForm(),
            DateTimeField::new('created')->hideOnForm(),

            ImageField::new('imageUrl', 'Image')
            ->setBasePath(self::FACULTIES_BASE_PATH)
            ->setUploadDir(self::FACULTIES_UPLOAD_DIR)
            ->setSortable(false),
        ];
    }
    
    
    public function persistEntity(EntityManagerInterface $em, $entityInstance): void
    {
        if (!$entityInstance instanceof Laboratory) return;

        $entityInstance->setCreated(new \DateTimeImmutable);

        parent::persistEntity($em, $entityInstance);
    }

    public function updateEntity(EntityManagerInterface $em, $entityInstance): void
    {
        if (!$entityInstance instanceof Laboratory) return;

        $entityInstance->setModified(new \DateTimeImmutable);

        parent::updateEntity($em, $entityInstance);
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud->addFormTheme('@FOSCKEditor/Form/ckeditor_widget.html.twig');
    }
}
