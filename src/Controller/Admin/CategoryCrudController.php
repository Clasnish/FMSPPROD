<?php

namespace App\Controller\Admin;

use App\Entity\Category;
use Doctrine\ORM\EntityManagerInterface;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\NumberField;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class CategoryCrudController extends AbstractCrudController
{

    public const ACTION_DUPLICATE = 'Duplicate';
    public const PRODUCTS_BASE_PATH = 'upload/images/category';
    public const PRODUCTS_UPLOAD_DIR = 'public/upload/images/category';

    public static function getEntityFqcn(): string
    {
        return Category::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->hideOnForm(),
            TextField::new('Name', 'Designation'),
            TextField::new('Label', 'Description courte'),
            BooleanField::new('active'),
            NumberField::new('Period', 'Duree formation (Année)'),
            TextEditorField::new('description'),
            DateTimeField::new('Modified')->hideOnForm(),
            DateTimeField::new('created')->hideOnForm(),

            /*ImageField::new('imageUrl', 'Image')
            ->setBasePath(self::PRODUCTS_BASE_PATH)
            ->setUploadDir(self::PRODUCTS_UPLOAD_DIR)
            ->setSortable(false),*/
        ];
    }

    public function persistEntity(EntityManagerInterface $em, $entityInstance): void
    {
        if (!$entityInstance instanceof Category) return;

        $entityInstance->setCreated(new \DateTimeImmutable);

        parent::persistEntity($em, $entityInstance);
    }

    public function updateEntity(EntityManagerInterface $em, $entityInstance): void
    {
        if (!$entityInstance instanceof Category) return;

        $entityInstance->setModified(new \DateTimeImmutable);

        parent::updateEntity($em, $entityInstance);
    }


    public function deleteEntity(EntityManagerInterface $em, $entityInstance): void
    {
        if (!$entityInstance instanceof Category) return;

        foreach ($entityInstance->getProducts() as $product) {
            $em->remove($product);
        }

        parent::deleteEntity($em, $entityInstance);
    }
}
