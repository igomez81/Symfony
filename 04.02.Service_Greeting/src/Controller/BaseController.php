<?php
// src/controller/BaseController.php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

use App\Services\Greeting;

class BaseController extends AbstractController
{
    private $greeting;

    function __construct(Greeting $greeting)
    {
        $this->greet = $greeting;
    }

    function isMaria($name)
    {
        $result = ($name === 'María')?true:false;
        return $result;
    }
}


