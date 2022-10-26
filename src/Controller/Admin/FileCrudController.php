<?php

namespace App\Controller\Admin;


use App\Entity\File;
use App\Field\CKEditorField;
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

class FileCrudController extends AbstractCrudController
{

    public const FILE_BASE_PATH = 'upload/files';
    public const FILE_UPLOAD_DIR = 'public/upload/files';

    public static function getEntityFqcn(): string
    {
        return File::class;
    }

    
    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->hideOnForm(),
            
            AssociationField::new('admission', 'Fichier Examen')->setQueryBuilder(function (QueryBuilder $queryBuilder) {
                $queryBuilder->select();
            }),
            AssociationField::new('faculty', 'Resultat Normale Filiere')->setQueryBuilder(function (QueryBuilder $queryBuilder) {
                $queryBuilder->select();
            }),
            AssociationField::new('Planning', 'Emplois du Temps')->setQueryBuilder(function (QueryBuilder $queryBuilder) {
                $queryBuilder->select();
            }),
            BooleanField::new('resultat', 'Resultat Examen/Concours'),
            DateTimeField::new('Modified')->hideOnForm(),
            DateTimeField::new('created')->hideOnForm(),

            ImageField::new('Name', 'Fichier (pdf)')
            ->setBasePath(self::FILE_BASE_PATH)
            ->setUploadDir(self::FILE_UPLOAD_DIR)
            ->setSortable(false),
        ];
    }
    
    public function persistEntity(EntityManagerInterface $em, $entityInstance): void
    {
        if (!$entityInstance instanceof File) return;

        $entityInstance->setCreated(new \DateTimeImmutable);

        parent::persistEntity($em, $entityInstance);
    }

    public function updateEntity(EntityManagerInterface $em, $entityInstance): void
    {
        if (!$entityInstance instanceof File) return;

        $entityInstance->setModified(new \DateTimeImmutable);

        parent::updateEntity($em, $entityInstance);
    }
    
    public function configureCrud(Crud $crud): Crud
    {
        return $crud->addFormTheme('@FOSCKEditor/Form/ckeditor_widget.html.twig');
    }

}
