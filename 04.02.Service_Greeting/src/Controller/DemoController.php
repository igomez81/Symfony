<?php
// src/controller/DemoController.php
namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;

use App\Services\Greeting;

class DemoController extends BaseController
{
   /**
    * @Route("/demo/{name}", name="demo")
    */
   public function index($name)
   {
       dump($this->isMaria($name));
       $greet = $this->greet->greet($name);
       return new Response ($greet);
   }
}





