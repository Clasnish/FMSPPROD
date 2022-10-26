<?php

namespace App\Controller\Admin;

use App\Entity\Product;
use Doctrine\ORM\QueryBuilder;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\MoneyField;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Context\AdminContext;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Router\AdminUrlGenerator;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class ProductCrudController extends AbstractCrudController
{

    public const ACTION_DUPLICATE = 'duplicate';
    public const PRODUCTS_BASE_PATH = 'upload/images/product';
    public const PRODUCTS_UPLOAD_DIR = 'public/upload/images/product';

    public static function getEntityFqcn(): string
    {
        return Product::class;
    }

    public function configureActions(Actions $actions): Actions
    {
        $duplicate = Action::new(self::ACTION_DUPLICATE)
            ->linkToCrudAction('duplicateProduct')
            ->setCssClass('btn btn-info');

        return $actions
            ->add(Crud::PAGE_EDIT, $duplicate)
            ->reorder(Crud::PAGE_EDIT, [self::ACTION_DUPLICATE, Action::SAVE_AND_RETURN]);
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->hideOnForm(),
            TextField::new('name', 'Designation'),
            TextField::new('name2', 'Designation 2'),
            TextEditorField::new('description'),
            //MoneyField::new('price')->setCurrency('XAF'),

            ImageField::new('imageUrl')
                ->setBasePath(self::PRODUCTS_BASE_PATH)
                ->setUploadDir(self::PRODUCTS_UPLOAD_DIR)
                ->setSortable(false),

            BooleanField::new('active'),

            AssociationField::new('Category')->setQueryBuilder(function (QueryBuilder $queryBuilder) {
                $queryBuilder->where('entity.active = true');
            }),

            DateTimeField::new('Modified')->hideOnForm(),
            DateTimeField::new('Created')->hideOnForm(),
        ];
    }

    public function persistEntity(EntityManagerInterface $em, $entityInstance): void
    {
        if (!$entityInstance instanceof Product) return;

        $entityInstance->setCreated(new \DateTimeImmutable);

        parent::persistEntity($em, $entityInstance);
    }

    public function updateEntity(EntityManagerInterface $em, $entityInstance): void
    {
        if (!$entityInstance instanceof Product) return;

        $entityInstance->setModified(new \DateTimeImmutable);

        parent::updateEntity($em, $entityInstance);
    }

    public function duplicateProduct(
        AdminContext $context,
        AdminUrlGenerator $adminUrlGenerator,
        EntityManagerInterface $em
    ): Response {
        /** @var Product $product */
        $product = $context->getEntity()->getInstance();

        $duplicatedProduct = clone $product;

        parent::persistEntity($em, $duplicatedProduct);

        $url = $adminUrlGenerator->setController(self::class)
            ->setAction(Action::DETAIL)
            ->setEntityId($duplicatedProduct->getId())
            ->generateUrl();

        return $this->redirect($url);
    }

}
