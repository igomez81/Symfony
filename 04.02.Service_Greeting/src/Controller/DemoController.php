<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
use App\Services\Greeting;

class DemoController extends AbstractController
{
    /**
     * @Route("/demo/{name}", name="demo")
     */
    public function index($name, Greeting $greeting)
    {
        dump($name);
        $greet = $greeting->greet($name);
        return new Response ($greet);
    }
}


