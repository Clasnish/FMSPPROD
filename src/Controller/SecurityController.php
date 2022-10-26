<?php

namespace App\Controller;
use App\Entity\User;
use App\Entity\Compagnie;
use App\Form\RegistrationType;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\PasswordHasher\PasswordHasherInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class SecurityController extends AbstractController
{
    
    #[Route("/registration", name:"inscription")]
    public function registration(ManagerRegistry $doctrine, Request $request, UserPasswordHasherInterface $encoder)
    {
        $activecss = 'active';
        $user = new User();
        $Compagny = $doctrine->getRepository(Compagnie::Class)->find(4);
        $registrationform = $this->createForm(RegistrationType::class, $user);
        $registrationform->handleRequest($request);
        if ($registrationform->isSubmitted() && $registrationform->isValid()) {
            //holds the submitted values
            // but, the original `$task` variable has also been updated
            $hash = $encoder->hash($user->getPassword());
            $user->setPassword($hash);
            $user->setconfirmpassword($hash);
            $user = $registrationform->getData();
            $user->setcreated(new \Datetime());
            $user->setmodified(new \Datetime());
            
            // ... perform some action, such as saving the task to the database
            // for example, if Task is a Doctrine entity, save it!
            $entityManager = $doctrine->getManager();
            $entityManager->persist($user);
            $entityManager->flush();
    
            return $this->redirectToRoute('home');
        }
        
        return $this->render('security/registration.html.twig', [
            'controller_name' => 'SecurityController',
            'Compagny'  => $Compagny,
            'COMPAGNY_BASE_PATH' => 'upload/images/compagny/',
            'registrationform' => $registrationform->createView()
        ]);
    }

    #[Route("/connexion", name:"login")]
    public function login (ManagerRegistry $doctrine, AuthenticationUtils $authenticationUtils)//Request $request, UserPasswordEncoderInterface $encoder)
    {
        $activecss = 'active';
        $user = new User();
        $Compagny = $doctrine->getRepository(Compagnie::Class)->find(4);
        $error = $authenticationUtils->getLastAuthenticationError();
        $lastUsername = $authenticationUtils->getLastUsername();
        return $this->render('security/login.html.twig', [
            'controller_name' => 'SecurityController',
            'Compagny'  => $Compagny,
            'lastusername' => $lastUsername,
            'COMPAGNY_BASE_PATH' => 'upload/images/compagny/',
            'error' => $error
        ]);

    }


    #[Route("/deconnexion", name:"logout")]
    public function logout ()//Request $request, UserPasswordEncoderInterface $encoder)
    {

    }
}
