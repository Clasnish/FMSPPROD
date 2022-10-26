<?php

namespace App\Controller\Admin;

use App\Entity\Department;
use App\Field\CKEditorField;
use Doctrine\ORM\EntityManagerInterface;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
class DepartmentCrudController extends AbstractCrudController
{
    public const DEPATMENTS_BASE_PATH = 'upload/images/Department';
    public const DEPATMENTS_UPLOAD_DIR = 'public/upload/images/Department';

    public static function getEntityFqcn(): string
    {
        return Department::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->hideOnForm(),
            TextField::new('Name', 'Nom'),
            DateField::new('CreationDate', "Date Creation"),
            ImageField::new('imageUrl', 'Image')
            ->setBasePath(self::DEPATMENTS_BASE_PATH)
            ->setUploadDir(self::DEPATMENTS_UPLOAD_DIR)
            ->setSortable(false),
            
            TextEditorField::new('Description', 'Description courte'),
            DateTimeField::new('Modified')->hideOnForm(),
            DateTimeField::new('created')->hideOnForm(),


        ];
    }

    
    public function persistEntity(EntityManagerInterface $em, $entityInstance): void
    {
        if (!$entityInstance instanceof Department) return;

        $entityInstance->setCreated(new \DateTimeImmutable);

        parent::persistEntity($em, $entityInstance);
    }

    public function updateEntity(EntityManagerInterface $em, $entityInstance): void
    {
        if (!$entityInstance instanceof Department) return;

        $entityInstance->setModified(new \DateTimeImmutable);

        parent::updateEntity($em, $entityInstance);
    }
    
    public function configureCrud(Crud $crud): Crud
    {
        return $crud->addFormTheme('@FOSCKEditor/Form/ckeditor_widget.html.twig');
    }
}
