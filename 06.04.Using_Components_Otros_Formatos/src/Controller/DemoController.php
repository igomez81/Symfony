<?php
// src/Controller/DemoController.php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class DemoController extends AbstractController
{
   //…

   /**
    * @Route("/demoFormat/{_format}", name="demoFormat")
    */
   public function demoFormat($_format)
   {
       $result = ['apple', 'orange', 'melon'];
       return $this->render('demo/format.json.twig', [
           'result'=> $result
       ]);
   }
}


