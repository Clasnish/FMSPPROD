<?php

namespace App\Controller\Admin;

use App\Entity\Faculty;
use App\Field\CKEditorField;
use Doctrine\ORM\QueryBuilder;
use Doctrine\ORM\EntityManagerInterface;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ChoiceField;
use EasyCorp\Bundle\EasyAdminBundle\Field\NumberField;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class FacultyCrudController extends AbstractCrudController
{

    public const FACULTIES_BASE_PATH = 'upload/images/Faculty';
    public const FACULTIES_UPLOAD_DIR = 'public/upload/images/Faculty';

    public static function getEntityFqcn(): string
    {
        return Faculty::class;
    }

    
    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->hideOnForm(),
            TextField::new('Name', 'Nom'),
            DateField::new('CreationDate', "Date Creation"),
            AssociationField::new('category', 'Categorie')->setQueryBuilder(function (QueryBuilder $queryBuilder) {
                $queryBuilder->select();
            }),

            TextField::new('Description', 'Description courte'),
            TextEditorField::new('Content'),
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
        if (!$entityInstance instanceof Faculty) return;

        $entityInstance->setCreated(new \DateTimeImmutable);

        parent::persistEntity($em, $entityInstance);
    }

    public function updateEntity(EntityManagerInterface $em, $entityInstance): void
    {
        if (!$entityInstance instanceof Faculty) return;

        $entityInstance->setModified(new \DateTimeImmutable);

        parent::updateEntity($em, $entityInstance);
    }
    
    public function configureCrud(Crud $crud): Crud
    {
        return $crud->addFormTheme('@FOSCKEditor/Form/ckeditor_widget.html.twig');
    }

    
}
