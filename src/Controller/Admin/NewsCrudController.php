<?php

namespace App\Controller\Admin;

use App\Entity\News;
use Doctrine\ORM\EntityManagerInterface;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class NewsCrudController extends AbstractCrudController
{

    public const ACTION_DUPLICATE = 'Duplicate';
    public const PRODUCTS_BASE_PATH = 'upload/images/News';
    public const PRODUCTS_UPLOAD_DIR = 'public/upload/images/News';

    public static function getEntityFqcn(): string
    {
        return News::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->hideOnForm(),
            TextField::new('title', 'Titre'),
            TextField::new('Label', 'Description courte'),
            TextEditorField::new('description'),
            BooleanField::new('active'),
            
            DateTimeField::new('Modified')->hideOnForm(),
            DateTimeField::new('created')->hideOnForm(),

            ImageField::new('imageUrl', 'Image')
            ->setBasePath(self::PRODUCTS_BASE_PATH)
            ->setUploadDir(self::PRODUCTS_UPLOAD_DIR)
            ->setSortable(false),
        ];
    }

    public function persistEntity(EntityManagerInterface $em, $entityInstance): void
    {
        if (!$entityInstance instanceof News) return;

        $entityInstance->setCreated(new \DateTimeImmutable);

        parent::persistEntity($em, $entityInstance);
    }

    public function updateEntity(EntityManagerInterface $em, $entityInstance): void
    {
        if (!$entityInstance instanceof News) return;

        $entityInstance->setModified(new \DateTimeImmutable);

        parent::updateEntity($em, $entityInstance);
    }

}
