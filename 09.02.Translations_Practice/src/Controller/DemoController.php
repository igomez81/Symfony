<?php
//src/Controller/DemoController.php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

use Symfony\Component\Translation\TranslatorInterface;

class DemoController extends AbstractController
{
   /**
    * @Route("/demo", name="demo")
    */
   public function index(TranslatorInterface $translator)
   {
       $translated = $translator->trans ('Hello');
       dump($translated);
       $name = 'Manolo';
       $count = 2;
       $translated = $translator->trans (
           'Hello %name%',
           [ '%name%' => $name ]
       );
       dump($translated);
       return $this->render('demo/index.html.twig', [
           'controller_name' => 'DemoController',
           'name'=> $name,
           'count' => $count
       ]);
   }
}

