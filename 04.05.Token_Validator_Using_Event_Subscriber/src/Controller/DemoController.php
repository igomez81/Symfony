<?php
// src/controller/DemoController.php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;

class DemoController extends AbstractController
{
   /**
    * @Route("/demo", name="demo")
    */
   public function index()
   {
       return new JsonResponse(
           [
               'result'=>'ok'
           ]
         );
   }
}

