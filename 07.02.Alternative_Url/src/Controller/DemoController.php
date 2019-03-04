<?php
// src/controller/DemoController.php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class DemoController extends AbstractController
{
   public function index()
   {
       return $this->render('demo/index.html.twig', [
           'controller_name' => 'DemoController',
       ]);
   }
}



