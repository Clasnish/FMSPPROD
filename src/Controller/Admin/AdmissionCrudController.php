<?php

namespace App\Controller\Admin;

use App\Entity\Admission;
use Doctrine\ORM\EntityManagerInterface;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ChoiceField;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class AdmissionCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Admission::class;
    }


    public const ACTION_DUPLICATE = 'Duplicate';
    public const PRODUCTS_BASE_PATH = 'upload/images/Files';
    public const PRODUCTS_UPLOAD_DIR = 'public/upload/Files';

    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->hideOnForm(),
            TextField::new('session', 'Session de'),
            BooleanField::new('active'),
            DateTimeField::new('Modified')->hideOnForm(),
            DateTimeField::new('created')->hideOnForm(),
            ChoiceField::new('TypeExam')
            ->autocomplete()
            ->setChoices ([
                'Concours' => 'Concours',
                'Normale' => 'Normale',
            ]),
            ImageField::new('communicated', 'Fichier communique')
            ->setBasePath(self::PRODUCTS_BASE_PATH)
            ->setUploadDir(self::PRODUCTS_UPLOAD_DIR)
            ->setSortable(false),
            TextEditorField::new('description', 'Procedure Incription Concour'),
        ];
    }

    public function persistEntity(EntityManagerInterface $em, $entityInstance): void
    {
        if (!$entityInstance instanceof Admission) return;

        $entityInstance->setCreated(new \DateTimeImmutable);

        parent::persistEntity($em, $entityInstance);
    }

    public function updateEntity(EntityManagerInterface $em, $entityInstance): void
    {
        if (!$entityInstance instanceof Admission) return;

        $entityInstance->setModified(new \DateTimeImmutable);

        parent::updateEntity($em, $entityInstance);
    }
}
