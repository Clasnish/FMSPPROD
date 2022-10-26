<?php

namespace App\Controller;

use App\Entity\File;
use App\Entity\News;
use App\Entity\Page;
use App\Entity\Contact;
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
use App\Form\ContactUsType;
use App\Entity\PropertySearch;
use App\Form\PropertySearchType;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
Use App\Lib\NTLMSoapClient;
Use App\Lib\NTLMStream;

class MyAppController extends AbstractController
{
    #[Route('/', name: 'home')]
    public function index(ManagerRegistry $doctrine): Response
    {
        $activecss = 'active';
        $Compagny = $doctrine->getRepository(Compagnie::Class)->find(4);
        $Pages    =  $doctrine->getRepository(Page::Class)->findByPageName("Home");
        $faculty  =  $doctrine->getRepository(Faculty::Class)->findBy(
            
            ['category' => '2'],
            ['id' => 'ASC'],
            4
        );

        $Categories =  $doctrine->getRepository(category::Class)->findAll();
        $Actualities =  $doctrine->getRepository(News::Class)->findBy(
            
            ['active' => '1'],
            ['id' => 'DESC'],
            6
        );;
        $professor =  $doctrine->getRepository(Professor::Class)->findAll();

        for ($i = 0 ; $i < count($Categories) ; $i++){
            
            $description = $this->TroncRemoveHTML($Categories [$i]->getDescription(), 0, 200);
            $Categories [$i]->setDescription($description);
            
        }

        for ($i = 0 ; $i < count($professor) ; $i++){
            
            $description = $this->TroncRemoveHTML($professor [$i]->getDescription(), 0, 200);
            $professor [$i]->setDescription($description);
            
        }

        for ($i = 0 ; $i < count($Actualities) ; $i++){
            
            $description = $this->TroncRemoveHTML($Actualities [$i]->getDescription(), 0, 200);
            $Actualities [$i]->setDescription($description);
            
        }

        return $this->render('site/index.html.twig', [
            'controller_name' => 'MyAppController',
            'Compagny' => $Compagny,
            'Pages' => $Pages,
            'categories'  => $Categories,
            'Actualities' => $Actualities,
            'activecss'   => $activecss,
            'faculties'     => $faculty,
            'professors'     => $professor,
            'COMPAGNY_BASE_PATH' => 'upload/images/compagny/',
            'CATEGORIES_BASE_PATH' => 'upload/images/Categories/',
            'PRODUCTS_BASE_PATH' => 'upload/images/Products/',
            'NEWS_BASE_PATH' => 'upload/images/News/',
            'PAGE_BASE_PATH' => 'upload/images/Page/',
            'FACULTY_BASE_PATH' => 'upload/images/Faculty/',
            'PROFESSOR_BASE_PATH' => 'upload/images/Professor/'

        ]);

    }
   
    #[Route("/aboutus", name: "aboutus")]    
    public function aboutus(ManagerRegistry $doctrine)
    {
        $activecss = 'active';
        $Compagny= $doctrine->getRepository(Compagnie::Class)->find(4);
        $Pages =  $doctrine->getRepository(Page::Class)->findByPageName("Home");
        $Laboratories =  $doctrine->getRepository(Laboratory::Class)->findAll();
        $Libraries =  $doctrine->getRepository(Library::Class)->findAll();
        
        for ($i = 0 ; $i < count($Pages) ; $i++){
            
            $description = $this->TroncRemoveHTML($Pages[$i]->getContent(), 0, 500);
            $Pages[$i]->setContent($description);
            
        }
        for ($i = 0 ; $i < count($Laboratories) ; $i++){
            
            $description = $this->TroncRemoveHTML($Laboratories[$i]->getDescription(), 0, 500);
            $Laboratories[$i]->setDescription($description);
            
        }
        
        for ($i = 0 ; $i < count($Libraries) ; $i++){
            
            $description = $this->TroncRemoveHTML($Libraries[$i]->getDescription(), 0, 1500);
            $Libraries[$i]->setDescription($description);
            
        }


        return $this->render('site/aboutus.html.twig', [
            'controller_name' => 'MyAppController',
            'Compagny' => $Compagny,
            'activecss'   => $activecss,
            'Pages' => $Pages,
            'Laboratories' => $Laboratories,
            'Libraries' => $Libraries,
            'COMPAGNY_BASE_PATH' => 'upload/images/compagny/',
            'NEWS_BASE_PATH' => 'upload/images/News/',
            'PAGE_BASE_PATH' => 'upload/images/Page/',
            'FACULTY_BASE_PATH' => 'upload/images/Faculty/',
            'PROFESSOR_BASE_PATH' => 'upload/images/Professor/',
            'LABORATORY_BASE_PATH' => 'upload/images/Laboratory/',
            'LIBRARY_BASE_PATH' => 'upload/images/Library/'
        ]);
    }

    #[Route("/courses/{id}", name: "courses")]    
    public function courses(ManagerRegistry $doctrine, $id=0)
    {
        $activecss = 'active';
        //$faculties =  $doctrine->getRepository(Faculty::Class)->findAll();
        $Compagny= $doctrine->getRepository(Compagnie::Class)->find(4);
        if ($id == 0){
            $categories = $doctrine->getRepository(category::Class)->findBy(
                ['active' => TRUE],
                ['id' => 'ASC']);
    
        } else {
            $categories = $doctrine->getRepository(category::Class)->find($id);
        }

        if ($id == 0){
            for ( $j = 0 ; $j < count($categories) ; $j++) {
                
                for ($i = 0 ; $i < count ($categories[$j]->getFaculties()) ; $i++){
                    
                    $description = $this->TroncRemoveHTML($categories[$j]->getFaculties()[$i]->getContent(), 0, 250);
                    $categories[$j]->getFaculties()[$i]->setContent($description);
                    
                }
            }
        } else {
            for ($i = 0 ; $i < count ($categories->getFaculties()) ; $i++){
                    
                $description = $this->TroncRemoveHTML($categories->getFaculties()[$i]->getContent(), 0, 250);
                $categories->getFaculties()[$i]->setContent($description);
                
            }
        }


        return $this->render('site/courses.html.twig', [
            'controller_name' => 'MyAppController',
            'Compagny' => $Compagny,
            'active'   => $activecss,
            'categories' => $categories ,
            'COMPAGNY_BASE_PATH' => 'upload/images/compagny/',
            'FACULTY_BASE_PATH' => 'upload/images/Faculty/'
        ]);
    }

    #[Route("/course/{id}", name:"course")]
    public function course(ManagerRegistry $doctrine, $id)
    {
        $activecss = 'active';
        $faculty =  $doctrine->getRepository(Faculty::Class)->find($id);
        $faculties =  $doctrine->getRepository(Faculty::Class)->findAll();
        $Compagny= $doctrine->getRepository(Compagnie::Class)->find(4);
        $events =  $doctrine->getRepository(News::Class)->findBy(
            ['active' => TRUE],
            ['id' => 'DESC'], 
            3,
            null);
        for ($i = 0 ; $i < count($events) ; $i++){
    
            $description = $this->TroncRemoveHTML($events[$i]->getDescription(), 0, 100);
            $events[$i]->setDescription($description);
            
        }

        return $this->render('site/course.html.twig', [
            'controller_name' => 'MyAppController',
            'Compagny' => $Compagny,
            'active'   => $activecss,
            'faculty' => $faculty,
            'faculties' => $faculties,
            'events'    => $events,
            'COMPAGNY_BASE_PATH' => 'upload/images/compagny/',
            'FACULTY_BASE_PATH' => 'upload/images/Faculty/'
        ]);
    }

    #[Route("/staff", name:"staff")]
    public function staff(ManagerRegistry $doctrine)
    {
        $activecss = 'active';
        $staffs =  $doctrine->getRepository(Page::Class)->findBy(
            ['pageName' => "staff"],
            ['id' => 'DESC'], 
            1,
            null);

        $staff = $staffs[0];

        $Compagny= $doctrine->getRepository(Compagnie::Class)->find(4);
        $events =  $doctrine->getRepository(News::Class)->findBy(
            ['active' => TRUE],
            ['id' => 'DESC'], 
            3,
            null);
        for ($i = 0 ; $i < count($events) ; $i++){
    
            $description = $this->TroncRemoveHTML($events[$i]->getDescription(), 0, 100);
            $events[$i]->setDescription($description);
            
        }

        return $this->render('site/staff.html.twig', [
            'controller_name' => 'MyAppController',
            'Compagny' => $Compagny,
            'active'   => $activecss,
            'staff' => $staff,
            'events'    => $events,
            'COMPAGNY_BASE_PATH' => 'upload/images/compagny/',
            'PAGE_BASE_PATH' => 'upload/images/page/'
        ]);
    }


    #[Route("/departments", name: "departments")]    
    public function departments(ManagerRegistry $doctrine)
    {
        $activecss = 'active';
        $departments =  $doctrine->getRepository(Department::Class)->findAll();
        $Compagny= $doctrine->getRepository(Compagnie::Class)->find(4);
        
        for ($i = 0 ; $i < count($departments) ; $i++){
            
            $description = $this->TroncRemoveHTML($departments[$i]->getDescription(), 0, 250);
            $departments[$i]->setDescription($description);
            
        }

        return $this->render('site/departments.html.twig', [
            'controller_name' => 'MyAppController',
            'Compagny' => $Compagny,
            'active'   => $activecss,
            'departments' => $departments,
            'COMPAGNY_BASE_PATH' => 'upload/images/compagny/',
            'DEPARTMENT_BASE_PATH' => 'upload/images/Department/'
        ]);
    }

    #[Route("/department/{id}", name:"department")]
    public function department(ManagerRegistry $doctrine, $id)
    {
        $activecss = 'active';
        $department =  $doctrine->getRepository(Department::Class)->find($id);
        $departments =  $doctrine->getRepository(Department::Class)->findAll();
        $Compagny= $doctrine->getRepository(Compagnie::Class)->find(4);
        $events =  $doctrine->getRepository(News::Class)->findBy(
            ['active' => TRUE],
            ['id' => 'DESC'], 
            3,
            null);
        
        for ($i = 0 ; $i < count($events) ; $i++){
        
            $description = $this->TroncRemoveHTML($events[$i]->getDescription(), 0, 100);
            $events[$i]->setDescription($description);
            
        }

        return $this->render('site/department.html.twig', [
            'controller_name' => 'MyAppController',
            'Compagny' => $Compagny,
            'active'   => $activecss,
            'department' => $department,
            'departments' => $departments,
            'events' => $events,
            'COMPAGNY_BASE_PATH' => 'upload/images/compagny/',
            'DEPARTMENT_BASE_PATH' => 'upload/images/Department/',
            'NEWS_BASE_PATH' => 'upload/images/News/'
        ]);
    }

    #[Route("/com", name:"communicated")]
    public function communicated (ManagerRegistry $doctrine)
    {
        $activecss = 'active';
        $com =  $doctrine->getRepository(Admission::Class)->findBy(
            ['active' => TRUE,
            'TypeExam'=> 'Concours'],
            ['id' => 'DESC'], 
            1,
            null);

        if ( count($com) > 0)  {
            $exam = $com[0];
        } else {
            $exam = Null ; 
        }
        

        $departments =  $doctrine->getRepository(Department::Class)->findAll();
        $Compagny= $doctrine->getRepository(Compagnie::Class)->find(4);
        $events =  $doctrine->getRepository(News::Class)->findBy(
            ['active' => TRUE],
            ['id' => 'DESC'], 
            3,
            null);
        
        for ($i = 0 ; $i < count($events) ; $i++){
        
            $description = $this->TroncRemoveHTML($events[$i]->getDescription(), 0, 100);
            $events[$i]->setDescription($description);
            
        }

        return $this->render('site/communicated.html.twig', [
            'controller_name' => 'MyAppController',
            'Compagny' => $Compagny,
            'active'   => $activecss,
            'exam'     => $exam,
            'departments' => $departments,
            'events' => $events,
            'COMPAGNY_BASE_PATH' => 'upload/images/compagny/',
            'FILE_BASE_PATH' => 'upload/files/',
            'DEPARTMENT_BASE_PATH' => 'upload/images/Department/',
            'NEWS_BASE_PATH' => 'upload/images/News/'
        ]);
    }

    #[Route("/rconcours/{id}", name:"resultat_concours")]
    public function resultat_concours (ManagerRegistry $doctrine, $id =0)
    {
        $activecss = 'active';
        $exams =  $doctrine->getRepository(Admission::Class)->findBy(
            ['active' => TRUE,
            'TypeExam'=> 'Concours'],
            ['id' => 'DESC'], 
            10,
            null);  
            
        $exam  = NULL;
        if ($id != 0){
            $exam =  $doctrine->getRepository(Admission::Class)->findBy(
                ['active' => TRUE,
                'TypeExam'=> 'Concours',
                'id' => $id],
                ['id' => 'DESC'], 
                1,
                null); 

                if ( count($exam) > 0)  {
                    $exam = $exam[0];
                } else {
                    $exam = Null ; 
                }
        }

        $departments =  $doctrine->getRepository(Department::Class)->findAll();
        $Compagny= $doctrine->getRepository(Compagnie::Class)->find(4);
        $events =  $doctrine->getRepository(News::Class)->findBy(
            ['active' => TRUE],
            ['id' => 'DESC'], 
            3,
            null);
        
        for ($i = 0 ; $i < count($events) ; $i++){
        
            $description = $this->TroncRemoveHTML($events[$i]->getDescription(), 0, 100);
            $events[$i]->setDescription($description);
            
        }

        return $this->render('site/resultat_concours.html.twig', [
            'controller_name' => 'MyAppController',
            'Compagny' => $Compagny,
            'active'   => $activecss,
            'exams'     => $exams,
            'resultat' => $exam,
            'departments' => $departments,
            'events' => $events,
            'COMPAGNY_BASE_PATH' => 'upload/images/compagny/',
            'FILE_BASE_PATH' => 'upload/files/',
            'DEPARTMENT_BASE_PATH' => 'upload/images/Department/',
            'NEWS_BASE_PATH' => 'upload/images/News/'
        ]);
    }

    #[Route("/rexams/{id}", name:"resultat_exams")]
    public function resultat_exams (ManagerRegistry $doctrine, $id =0)
    {
        $activecss = 'active';
        $exams =  $doctrine->getRepository(Admission::Class)->findBy(
            ['active' => TRUE,
            'TypeExam'=> 'Normale'],
            ['id' => 'DESC'], 
            10,
            null);  
            
        $exam  = NULL;
        if ($id != 0){
            $exam =  $doctrine->getRepository(Admission::Class)->findBy(
                ['active' => TRUE,
                'TypeExam'=> 'Normale',
                'id' => $id],
                ['id' => 'DESC'], 
                1,
                null); 

                if ( count($exam) > 0)  {
                    $exam = $exam[0];
                } else {
                    $exam = Null ; 
                }
        }

        $departments =  $doctrine->getRepository(Department::Class)->findAll();
        $Compagny= $doctrine->getRepository(Compagnie::Class)->find(4);
        $events =  $doctrine->getRepository(News::Class)->findBy(
            ['active' => TRUE],
            ['id' => 'DESC'], 
            3,
            null);
        
        for ($i = 0 ; $i < count($events) ; $i++){
        
            $description = $this->TroncRemoveHTML($events[$i]->getDescription(), 0, 100);
            $events[$i]->setDescription($description);
            
        }

        return $this->render('site/resultat_exams.html.twig', [
            'controller_name' => 'MyAppController',
            'Compagny' => $Compagny,
            'active'   => $activecss,
            'exams'     => $exams,
            'resultat' => $exam,
            'departments' => $departments,
            'events' => $events,
            'COMPAGNY_BASE_PATH' => 'upload/images/compagny/',
            'FILE_BASE_PATH' => 'upload/files/',
            'DEPARTMENT_BASE_PATH' => 'upload/images/Department/',
            'NEWS_BASE_PATH' => 'upload/images/News/'
        ]);
    }

    #[Route("/planning/{id}", name:"planning_cours")]
    public function planning_cours (ManagerRegistry $doctrine, $id =0)
    {
        $activecss = 'active';
        $exams =  $doctrine->getRepository(Planning::Class)->findBy(
            ['Active' => TRUE],
            ['Created' => 'DESC'], 
            10,
            null);  
            
        $exam  = NULL;
        if ($id != 0){
            $exam =  $doctrine->getRepository(Planning::Class)->findBy(
                ['Active' => TRUE,
                'id' => $id],
                ['Created' => 'DESC'], 
                10,
                null);  

                if ( count($exam) > 0)  {
                    $exam = $exam[0];
                } else {
                    $exam = Null ; 
                }
        }

    
        $Compagny= $doctrine->getRepository(Compagnie::Class)->find(4);
        $events =  $doctrine->getRepository(News::Class)->findBy(
            ['active' => TRUE],
            ['id' => 'DESC'], 
            3,
            null);
        
        for ($i = 0 ; $i < count($events) ; $i++){
        
            $description = $this->TroncRemoveHTML($events[$i]->getDescription(), 0, 100);
            $events[$i]->setDescription($description);
            
        }

        return $this->render('site/planning_cours.html.twig', [
            'controller_name' => 'MyAppController',
            'Compagny' => $Compagny,
            'active'   => $activecss,
            'exams'     => $exams,
            'resultat' => $exam,
            'events' => $events,
            'COMPAGNY_BASE_PATH' => 'upload/images/compagny/',
            'FILE_BASE_PATH' => 'upload/files/',
            'NEWS_BASE_PATH' => 'upload/images/News/'
        ]);
    }

    #[Route("/activite_recherche/{DocumentType}", name:"ResearchActivity")]
    public function Research_Activity (ManagerRegistry $doctrine, $DocumentType = "" )
    {
        $activecss = 'active';
        $exams =  $doctrine->getRepository(File::Class)->findBy(
            ['DocumentType' => $DocumentType],
            ['Created' => 'DESC'], 
            10,
            null);              

    
        $Compagny= $doctrine->getRepository(Compagnie::Class)->find(4);
        $events =  $doctrine->getRepository(News::Class)->findBy(
            ['active' => TRUE],
            ['id' => 'DESC'], 
            3,
            null);
        
        for ($i = 0 ; $i < count($events) ; $i++){
        
            $description = $this->TroncRemoveHTML($events[$i]->getDescription(), 0, 100);
            $events[$i]->setDescription($description);
            
        }

        for ($i = 0 ; $i < count($exams) ; $i++){
        
            $description = $this->TroncRemoveHTML($exams[$i]->getDescription(), 0, 100);
            $exams[$i]->setDescription($description);
            
        }

        return $this->render('site/research_activity.html.twig', [
            'controller_name' => 'MyAppController',
            'Compagny' => $Compagny,
            'active'   => $activecss,
            'exams'     => $exams,
            'events' => $events,
            'COMPAGNY_BASE_PATH' => 'upload/images/compagny/',
            'FILE_BASE_PATH' => 'upload/files/',
            'NEWS_BASE_PATH' => 'upload/images/News/'
        ]);
    }

    #[Route("/Subscribe", name:"Subscribe")]
    public function Subscribe (ManagerRegistry $doctrine)
    {
        $activecss = 'active';
        $com =  $doctrine->getRepository(Admission::Class)->findBy(
            ['active' => TRUE],
            ['id' => 'DESC'], 
            1,
            null);

        if ( count($com) > 0)  {
            $exam = $com[0];
        } else {
            $exam = Null ; 
        }
        

        $departments =  $doctrine->getRepository(Department::Class)->findAll();
        $Compagny= $doctrine->getRepository(Compagnie::Class)->find(4);
        $events =  $doctrine->getRepository(News::Class)->findBy(
            ['active' => TRUE],
            ['id' => 'DESC'], 
            3,
            null);
        
        for ($i = 0 ; $i < count($events) ; $i++){
        
            $description = $this->TroncRemoveHTML($events[$i]->getDescription(), 0, 100);
            $events[$i]->setDescription($description);
            
        }

        return $this->render('site/inscription.html.twig', [
            'controller_name' => 'MyAppController',
            'Compagny' => $Compagny,
            'active'   => $activecss,
            'exam'     => $exam,
            'departments' => $departments,
            'events' => $events,
            'COMPAGNY_BASE_PATH' => 'upload/images/compagny/',
            'FILE_BASE_PATH' => 'upload/files/',
            'DEPARTMENT_BASE_PATH' => 'upload/images/Department/',
            'NEWS_BASE_PATH' => 'upload/images/News/'
        ]);
    }

    #[Route("/library", name:"library")]
    public function library(ManagerRegistry $doctrine)
    {
        $activecss = 'active';
        $Compagny = $doctrine->getRepository(Compagnie::Class)->find(4);
        $libraries = $doctrine->getRepository(Library::Class)->findAll();
        $library = $libraries[0];
        $events =  $doctrine->getRepository(News::Class)->findBy(
            ['active' => TRUE],
            ['id' => 'DESC'], 
            3,
            null);
        
        for ($i = 0 ; $i < count($events) ; $i++){
        
            $description = $this->TroncRemoveHTML($events[$i]->getDescription(), 0, 100);
            $events[$i]->setDescription($description);
            
        }

        return $this->render('site/library.html.twig', [
            'controller_name' => 'MyAppController',
            'Compagny' => $Compagny,
            'library'     => $library,
            'active'   => $activecss,
            'events' => $events,
            'COMPAGNY_BASE_PATH' => 'upload/images/compagny/',
            'LIBRARY_BASE_PATH' => 'upload/images/Library/'
        ]);
    }

    #[Route("/gallery", name:"gallery")]
    public function gallery (ManagerRegistry $doctrine)
    {
        $activecss = 'active';
        $Compagny = $doctrine->getRepository(Compagnie::Class)->find(4);
        $galleries = $doctrine->getRepository(Gallery::Class)->findAll();
        
        return $this->render('site/gallery.html.twig', [
            'controller_name' => 'MyAppController',
            'Compagny' => $Compagny,
            'galleries'     => $galleries,
            'active'   => $activecss,
            'COMPAGNY_BASE_PATH' => 'upload/images/compagny/',
            'GALLERY_BASE_PATH' => 'upload/images/gallery/'
        ]);
    }

    #[Route("/laboratories", name:"laboratories")]
    public function laboratories(ManagerRegistry $doctrine)
    {
        $activecss = 'active';
        $Compagny= $doctrine->getRepository(Compagnie::Class)->find(4);
        $laboratories = $doctrine->getRepository(Laboratory::Class)->findAll();
        
        for ($i = 0 ; $i < count($laboratories) ; $i++){
            
            $description = $this->TroncRemoveHTML($laboratories[$i]->getDescription(), 0, 200);
            $laboratories[$i]->setDescription($description);
            
        }
        return $this->render('site/laboratories.html.twig', [
            'controller_name' => 'MyAppController',
            'Compagny' => $Compagny,
            'laboratories'     => $laboratories,
            'active'   => $activecss,
            'COMPAGNY_BASE_PATH' => 'upload/images/compagny/',
            'LABORATORY_BASE_PATH' => 'upload/images/Laboratory/'
        ]);
    }

    #[Route("/laboratory/{id}", name:"laboratory")]
    public function laboratory(ManagerRegistry $doctrine, $id)
    {
        $activecss = 'active';
        $laboratory =  $doctrine->getRepository(Laboratory::Class)->find($id);
        $laboratories =  $doctrine->getRepository(Laboratory::Class)->findAll();
        $compagny= $doctrine->getRepository(Compagnie::Class)->find(4);

        return $this->render('site/laboratory.html.twig', [
            'controller_name' => 'MyAppController',
            'Compagny' => $compagny,
            'active'   => $activecss,
            'laboratories' => $laboratories,
            'laboratory' => $laboratory,
            'COMPAGNY_BASE_PATH' => 'upload/images/compagny/',
            'LABORATORY_BASE_PATH' => 'upload/images/Laboratory/',
            'GALLERY_BASE_PATH' => 'upload/images/gallery/'
        ]);
    }


    #[Route("/news", name:"news")]
    public function news(ManagerRegistry $doctrine)
    {
        $activecss = 'active';
        $Compagny= $doctrine->getRepository(Compagnie::Class)->find(4);
        $news = $doctrine->getRepository(News::Class)->findAll();
        
        for ($i = 0 ; $i < count($news) ; $i++){
            
            $description = $this->TroncRemoveHTML($news[$i]->getDescription(), 0, 200);
            $news[$i]->setDescription($description);
            
        }
        return $this->render('site/news.html.twig', [
            'controller_name' => 'MyAppController',
            'Compagny' => $Compagny,
            'news'     => $news,
            'active'   => $activecss,
            'COMPAGNY_BASE_PATH' => 'upload/images/compagny/',
            'NEWS_BASE_PATH' => 'upload/images/News/'
        ]);
    }

    #[Route("/event/{id}", name:"event")]
    public function event(ManagerRegistry $doctrine, $id)
    {
        $activecss = 'active';
        $event =  $doctrine->getRepository(News::Class)->find($id);
        $news =  $doctrine->getRepository(News::Class)->findAll();
        $Compagny= $doctrine->getRepository(Compagnie::Class)->find(4);
        

        return $this->render('site/event.html.twig', [
            'controller_name' => 'MyAppController',
            'Compagny' => $Compagny,
            'active'   => $activecss,
            'news' => $news,
            'event' => $event,
            'COMPAGNY_BASE_PATH' => 'upload/images/compagny/',
            'NEWS_BASE_PATH' => 'upload/images/News/'
        ]);
    }

    #[Route("/contatus", name: "contactus")]
    public function contactus(ManagerRegistry $doctrine, Request $request)
    {
        $activecss = 'active';
        $Compagny= $doctrine->getRepository(Compagnie::Class)->find(4);
        $contact = new Contact();
        $contactform = $this->createForm(ContactUsType::class, $contact);

        $contactform->handleRequest($request);
        if ($contactform->isSubmitted() && $contactform->isValid()) {
            //holds the submitted values
            // but, the original `$task` variable has also been updated
            $contact = $contactform->getData();
            $contact->setcreated(new \Datetime());
            $contact->setmodified(new \Datetime());
            
            // ... perform some action, such as saving the task to the database
            // for example, if Task is a Doctrine entity, save it!
            $entityManager = $doctrine->getManager();
            $entityManager->persist($contact);
            $entityManager->flush();
    
            return $this->redirectToRoute('home');
        }

        return $this->render('site/contactus.html.twig', [
            'controller_name' => 'MyAppController',
            'Compagny' => $Compagny,
            'contactform' => $contactform->createView(),
            'activecss'   => $activecss,
            'COMPAGNY_BASE_PATH' => 'upload/images/compagny/'
        ]);
    }


    #[Route("/Votre_devis", name:"quote_edit")]
    public function quote(ManagerRegistry $doctrine, )
    {
        $activecss = 'active';
        $Compagny= $doctrine->getRepository(Compagnie::Class)->find(4);
        $Category = $Compagny= $doctrine->getRepository(category::Class)->findAll();
        return $this->render('site/Category.html.twig', [
            'controller_name' => 'MyAppController',
            'Compagny' => $Compagny,
            'category' => $Category,
            'activecss'   => $activecss
        ]);
    }

    #[Route("/categories", name:"category_list")]
    public function product_list(ManagerRegistry $doctrine)
    {
        $activecss = 'active';
        $Compagny = $doctrine->getRepository(Compagnie::Class)->find(4);
        $Category = $doctrine->getRepository(category::Class)->findAll();
        $Pages = $doctrine->getRepository(Page::Class)->findByPageName("Categorytlist");
        return $this->render('site/categorylist.html.twig', [
            'controller_name' => 'MyAppController',
            'Compagny' => $Compagny,
            'category' => $Category,
            'Pages'     => $Pages,
            'activecss'   => $activecss,
            'COMPAGNY_BASE_PATH' => 'upload/images/compagny/',
            'CATEGORIES_BASE_PATH' => 'upload/images/Category/'
        ]);
    }

    #[Route("/category/{id}", name:"category_show")]
    public function category(ManagerRegistry $doctrine, $id)
    {
        $activecss = 'active';
        $Compagny = $doctrine->getRepository(Compagnie::Class)->find(4);
        $Category = $doctrine->getRepository(category::Class)->find($id);
        $products = $doctrine->getRepository(product::Class)->find(4);
        $pages = $doctrine->getRepository(page::Class)->findByPageName('category');
        return $this->render('site/Category.html.twig', [
            'controller_name' => 'MyAppController',
            'Compagny' => $Compagny,
            'category' => $Category,
            'products' => $products,
            'pages'    => $pages,
            'activecss'   => $activecss,
            'COMPAGNY_BASE_PATH' => 'upload/images/compagny/',
            'CATEGORIES_BASE_PATH' => 'upload/images/Category/',
            'PRODUCTS_BASE_PATH' => 'upload/images/Product/'
        ]);
    }

    #[Route("/anciens_dirigeants", name: "oldmaster")]    
    public function oldmaster(ManagerRegistry $doctrine)
    {
        $activecss = 'active';
        //$faculties =  $doctrine->getRepository(Faculty::Class)->findAll();
        $Compagny= $doctrine->getRepository(Compagnie::Class)->find(4);
        $professor =  $doctrine->getRepository(Professor::Class)->findBy(
            ['Active' => TRUE],
            ['StartDate' => 'DESC']);

        return $this->render('site/old_master.html.twig', [
            'controller_name' => 'MyAppController',
            'Compagny' => $Compagny,
            'active'   => $activecss,
            'professors' => $professor ,
            'COMPAGNY_BASE_PATH' => 'upload/images/compagny/',
            'PROFESSOR_BASE_PATH' => 'upload/images/Professor/'
        ]);
    }


    #[Route("/product/{id}", name:"product_show")]
    public function product($id)
    {

        $doctrine = New ManagerRegistry;
        $activecss = 'active';
        $Compagny = $doctrine->getRepository(Compagnie::Class)->find(4);
        $product =  $doctrine()->getRepository(product::Class)->find($id);
        return $this->render('site/product.html.twig', [
            'controller_name' => 'MyAppController',
            'Compagny' => $Compagny,
            'product' => $product,
            'activecss'   => $activecss
            
        ]);
    }


    #[Route("/DynamicsNav", name:"checknav")]
    public function checkNav(Request $request)
    {

        $activecss = 'active';
        $respo = $this->getDoctrine()->getRepository(Compagnie::Class);
        $Compagny = $respo->find(4);
        $serialNo = '';
        // Read Single Record
        stream_wrapper_unregister('http');
        stream_wrapper_register('http', 'App\Lib\NTLMStream') or die("Failed to register protocol");
        $baseURL = 'http://dqclt02:7148/yoomee2/WS/'; 
        $CompanyName = "YMC_LIVE"; 
        $pageURL = $baseURL.rawurlencode($CompanyName);
        $Psearch = new PropertySearch();
        $searchform = $this->createForm(PropertySearchType::class, $Psearch);
        $searchform->handleRequest($request);
        if ($searchform->isSubmitted() && $searchform->isValid()) {
            //holds the submitted values
            // but, the original `$task` variable has also been updated
            $Psearch = $searchform->getData();
            $serialNo = $Psearch->getSerialNo();
                  
                
        }

        try{
            $service = new NTLMSoapClient($pageURL.'/Page/ItemLedgerEntries');
            $params = array('filter' => array( 
                    array('Field' => 'Entry_No', 
                            'Criteria' => '>=0'),               
                    array('Field' => 'Open', 
                            'Criteria' => True),
                    array('Field' => 'Serial_No', 
                            'Criteria' => $serialNo)    
                        ), 
                            'setSize' => 20); 

            $response = $service->ReadMultiple($params); 
            $response = $response->ReadMultiple_Result->ItemLedgerEntries;

            $service = new NTLMSoapClient($pageURL.'/Page/ItemCard');
            $params = array('filter' => array( 
                array('Field' => 'No', 
                        'Criteria' => '>=0'),                
                    ), 
                        'setSize' => 100);  
            $result = $service->ReadMultiple($params); 
            $result = $result->ReadMultiple_Result->ItemCard;           

        }
        catch (Exception $e) {
           // echo "<hr><b>ERROR: SoapException:</b> [".$e."]<hr>";
            //echo "<pre>".htmlentities(print_r($service->__getLastRequest(),1))."</pre>";
            //$response = $e;

        }
        
        return $this->render('site/navsales.html.twig', [
            'controller_name' => 'MyAppController',
            'Compagny' => $Compagny,
            'searchform' => $searchform->createView(),
            'activecss'   => $activecss,
            'items' => $response,
            'iteminfos' => $result,
            'serialno' => $serialNo
        ]);


    }

    public function TroncRemoveHTML(string $description, int $startPos, int $nbchar):string
    {
        try{
            return (substr(strip_tags ($description), $startPos, $nbchar) . '...');

        }catch (Exception $e){

        }
    }
}
