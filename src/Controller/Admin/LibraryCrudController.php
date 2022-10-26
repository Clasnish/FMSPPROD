<?php

namespace App\Controller\Admin;

use App\Entity\Library;
use Doctrine\ORM\EntityManagerInterface;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class LibraryCrudController extends AbstractCrudController
{
    public const LIBRARIES_BASE_PATH = 'upload/images/Library';
    public const LIBRARIES_UPLOAD_DIR = 'public/upload/images/Library';

    public static function getEntityFqcn(): string
    {
        return Library::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->hideOnForm(),
            DateField::new('CreationDate'),
            TextEditorField::new('Description'),
            DateTimeField::new('Modified')->hideOnForm(),
            DateTimeField::new('created')->hideOnForm(),

            ImageField::new('imageUrl', 'Image')
            ->setBasePath(self::LIBRARIES_BASE_PATH)
            ->setUploadDir(self::LIBRARIES_UPLOAD_DIR)
            ->setSortable(false),
        ];
    }

    
    public function persistEntity(EntityManagerInterface $em, $entityInstance): void
    {
        if (!$entityInstance instanceof Library) return;

        $entityInstance->setCreated(new \DateTimeImmutable);

        parent::persistEntity($em, $entityInstance);
    }

    public function updateEntity(EntityManagerInterface $em, $entityInstance): void
    {
        if (!$entityInstance instanceof Library) return;

        $entityInstance->setModified(new \DateTimeImmutable);

        parent::updateEntity($em, $entityInstance);
    }

}
