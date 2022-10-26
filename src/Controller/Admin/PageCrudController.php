<?php

namespace App\Controller\Admin;

use App\Entity\Page;
use Doctrine\ORM\EntityManagerInterface;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\NumberField;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class PageCrudController extends AbstractCrudController
{

    public const PAGE_BASE_PATH = 'upload/images/Page';
    public const PAGE_UPLOAD_DIR = 'public/upload/images/Page';

    public static function getEntityFqcn(): string
    {
        return Page::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->hideOnForm(),
            TextField::new('PageName', 'Page'),
            TextField::new('title', 'Titre'),
            TextField::new('label', 'Description courte'),
            TextField::new('contentID', 'Content id'),
            TextEditorField::new('content'),
            DateTimeField::new('Modified')->hideOnForm(),
            DateTimeField::new('created')->hideOnForm(),
            ImageField::new('imageUrl', 'Image')
            ->setBasePath(self::PAGE_BASE_PATH)
            ->setUploadDir(self::PAGE_UPLOAD_DIR)
            ->setSortable(false),

        ];
    }

    
    public function persistEntity(EntityManagerInterface $em, $entityInstance): void
    {
        if (!$entityInstance instanceof Page) return;

        $entityInstance->setCreated(new \DateTimeImmutable);

        parent::persistEntity($em, $entityInstance);
    }

    public function updateEntity(EntityManagerInterface $em, $entityInstance): void
    {
        if (!$entityInstance instanceof Page) return;

        $entityInstance->setModified(new \DateTimeImmutable);

        parent::updateEntity($em, $entityInstance);
    }

}
