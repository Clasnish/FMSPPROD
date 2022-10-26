<?php

namespace App\Controller\Admin;

use App\Entity\File;
use App\Entity\News;
use App\Entity\Page;
use App\Entity\User;
use App\Entity\Result;
use App\Entity\Faculty;
use App\Entity\Gallery;
use App\Entity\Library;
use App\Entity\Product;
use App\Entity\Category;
use App\Entity\Planning;
use App\Entity\Admission;
use App\Entity\Compagnie;
use App\Entity\Professor;
use App\Entity\Department;
use App\Entity\Laboratory;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Router\AdminUrlGenerator;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;

class DashboardController extends AbstractDashboardController
{
    public function __construct(
        private AdminUrlGenerator $adminUrlGenerator
    ) {
    }

    #[Route('/admin', name: 'admin')]
    public function index(): Response
    {
        $url = $this->adminUrlGenerator
            ->setController(CompagnieCrudController::class)
            ->generateUrl();

        return $this->redirect($url);
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('Espace Administration FMSP');
    }

    public function configureMenuItems(): iterable
    {
        
        yield MenuItem::section('');
        yield MenuItem::subMenu('Information Société', 'fas fa-bars')->setSubItems([
            MenuItem::linkToCrud('Information Société', 'fas fa-plus', Compagnie::class)->setAction(Crud::PAGE_NEW),
            MenuItem::linkToCrud('Liste Société', 'fas fa-eye', Compagnie::class)
        ]);

        yield MenuItem::section('');
        yield MenuItem::subMenu('Categories', 'fas fa-bars')->setSubItems([
            MenuItem::linkToCrud('Ajouter Categorie', 'fas fa-plus', Category::class)->setAction(Crud::PAGE_NEW),
            MenuItem::linkToCrud('Liste Categorie', 'fas fa-eye', Category::class)
        ]);

        yield MenuItem::section('');
        yield MenuItem::subMenu('Produits', 'fas fa-bars')->setSubItems([
            MenuItem::linkToCrud('Ajouter Produit', 'fas fa-plus', Product::class)->setAction(Crud::PAGE_NEW),
            MenuItem::linkToCrud('Liste Produits', 'fas fa-eye', Product::class)
        ]);

        yield MenuItem::section('');
        yield MenuItem::subMenu('Evenements', 'fas fa-bars')->setSubItems([
            MenuItem::linkToCrud('Ajoute actu', 'fas fa-plus', News::class)->setAction(Crud::PAGE_NEW),
            MenuItem::linkToCrud('Liste actu', 'fas fa-eye', News::class)
        ]);

        yield MenuItem::section('');
        yield MenuItem::subMenu('Information Page', 'fas fa-bars')->setSubItems([
            MenuItem::linkToCrud('Ajoute actu', 'fas fa-plus', Page::class)->setAction(Crud::PAGE_NEW),
            MenuItem::linkToCrud('Liste actu', 'fas fa-eye', Page::class)
        ]);

        yield MenuItem::section('');
        yield MenuItem::subMenu('Filieres', 'fas fa-bars')->setSubItems([
            MenuItem::linkToCrud('Ajoute actu', 'fas fa-plus', Faculty::class)->setAction(Crud::PAGE_NEW),
            MenuItem::linkToCrud('Liste actu', 'fas fa-eye', Faculty::class)
        ]);

        yield MenuItem::section('');
        yield MenuItem::subMenu('Gestion du Staff', 'fas fa-bars')->setSubItems([
            MenuItem::linkToCrud('Ajoute actu', 'fas fa-plus', Professor::class)->setAction(Crud::PAGE_NEW),
            MenuItem::linkToCrud('Liste actu', 'fas fa-eye', Professor::class)
        ]);

        yield MenuItem::section('');
        yield MenuItem::subMenu('Laboratoires', 'fas fa-bars')->setSubItems([
            MenuItem::linkToCrud('Ajoute actu', 'fas fa-plus', Laboratory::class)->setAction(Crud::PAGE_NEW),
            MenuItem::linkToCrud('Liste actu', 'fas fa-eye', Laboratory::class)
        ]);

        yield MenuItem::section('');
        yield MenuItem::subMenu('Bibliotheque', 'fas fa-bars')->setSubItems([
            MenuItem::linkToCrud('Ajoute actu', 'fas fa-plus', Library::class)->setAction(Crud::PAGE_NEW),
            MenuItem::linkToCrud('Liste actu', 'fas fa-eye', Library::class)
        ]);

        yield MenuItem::section('');
        yield MenuItem::subMenu('Departements', 'fas fa-bars')->setSubItems([
            MenuItem::linkToCrud('Ajouter', 'fas fa-plus', Department::class)->setAction(Crud::PAGE_NEW),
            MenuItem::linkToCrud('Liste departement', 'fas fa-eye', Department::class)
        ]);

        yield MenuItem::section('');
        yield MenuItem::subMenu('Galleries', 'fas fa-bars')->setSubItems([
            MenuItem::linkToCrud('Ajouter', 'fas fa-plus', Gallery::class)->setAction(Crud::PAGE_NEW),
            MenuItem::linkToCrud('Liste departement', 'fas fa-eye', Gallery::class)
        ]);

        yield MenuItem::section('');
        yield MenuItem::subMenu('Examens/Concours', 'fas fa-bars')->setSubItems([
            MenuItem::linkToCrud('Ajouter Session', 'fas fa-plus', Admission::class)->setAction(Crud::PAGE_NEW),
            MenuItem::linkToCrud('Liste Session', 'fas fa-eye', Admission::class),
            MenuItem::linkToCrud('Fichier Session', 'fas fa-plus', File::class)->setAction(Crud::PAGE_NEW),
            MenuItem::linkToCrud('Liste Fichiers Session', 'fas fa-eye', File::class)
            ->setController(FileCrudController::class),
        ]);

        yield MenuItem::section('');
        yield MenuItem::subMenu('Planning Cours', 'fas fa-bars')->setSubItems([
            MenuItem::linkToCrud('Ajouter Annee scolaire', 'fas fa-plus', Planning::class)->setAction(Crud::PAGE_NEW),
            MenuItem::linkToCrud('Liste Annees scolaires', 'fas fa-eye', Planning::class),
        ]);

        yield MenuItem::section('');
        yield MenuItem::subMenu('Resultat Concour', 'fas fa-bars')->setSubItems([
            MenuItem::linkToCrud('Ajouter resultat', 'fas fa-plus', Result::class)->setAction(Crud::PAGE_NEW),
            MenuItem::linkToCrud('Liste resultat', 'fas fa-eye', Result::class),
            MenuItem::linkToCrud('Ajouter Resultat concour', 'fas fa-plus', File::class)->setAction(Crud::PAGE_NEW),
            MenuItem::linkToCrud('Liste Resultats', 'fas fa-eye', File::class)
                ->setController(FileCrudController::class),
        ]);

        yield MenuItem::section('');
        yield MenuItem::subMenu('Activité de recherche', 'fas fa-bars')->setSubItems([
            MenuItem::linkToCrud('Ajouter', 'fas fa-plus', File::class)->setAction(Crud::PAGE_NEW),
            MenuItem::linkToCrud('Liste resultat', 'fas fa-eye', File::class)
                ->setController(FileRechercheCrudController::class),
        ]);


        yield MenuItem::section('');
        yield MenuItem::subMenu('User', 'fas fa-bars')->setSubItems([
            MenuItem::linkToCrud('Ajouter', 'fas fa-plus', User::class)->setAction(Crud::PAGE_NEW),
            MenuItem::linkToCrud('Liste resultat', 'fas fa-eye', User::class)
        ]);
    }
}
