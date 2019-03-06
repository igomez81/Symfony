<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

use App\Entity\Usuario;

class DefaultController extends AbstractController
{
    /**
     * @Route("/", name="index")
     */
    public function index()
    {
        return $this->render('default/index.html.twig');
    }
    
    /**
     * @Route("/rutaprivada", name="rutaprivada")
     */
    public function rutaprivada()
    {
        return $this->render('default/rutaprivada.html.twig');
    }
    
    
    /**
     * 
     * @Route("/login", name="login")
     */
    public function login(AuthenticationUtils $authUtils)
    {
        // get the login error if there is one
        $error = $authUtils->getLastAuthenticationError();

        // last username entered by the user
        $lastUsername = $authUtils->getLastUsername();

        return $this->render('security/login.html.twig', array(
            'last_username' => $lastUsername,
            'error'         => $error,
        ));
    }

    /**
     * @Route("/first-user", name="firstUser")
     */
    public function firstUser( UserPasswordEncoderInterface $passwordEncoder )
    {
        $user = new Usuario();
        $password = $passwordEncoder->encodePassword($user, 'admin');
        $user->setPassword($password);
        $user->setUsername('admin');
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->persist($user);
        $entityManager->flush();
        return $this->redirectToRoute('login');
    }   
}