<?php
// src/Controller/DemoController.php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class DemoController extends AbstractController
{
   /**
    * @Route("/demo", name="demo")
    */
   public function index()
   {
       $script = '<script>alert("Hello! I am an alert box!!");</script>';
       return $this->render('demo/index.html.twig', [
           'controller_name' => 'DemoController',
           'script'=> $script
       ]);
   }
}

