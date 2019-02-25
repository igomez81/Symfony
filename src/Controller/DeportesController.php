<?php
namespace App\Controller;

use App\Entity\Noticia;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Session\Session;


class DeportesController extends Controller

{
    /**
* @Route("/deportes/cargarbd", name="noticia")
*/
public function cargarBd() {
   $em=$this->getDoctrine()->getManager();

   $noticia=new Noticia();
   $noticia->setSeccion("Tenis");
   $noticia->setEquipo("roger-federer");
   $noticia->setFecha("16022018");

   $em->persist($noticia);
   $em->flush();
   return new Response("Noticia guardada con éxito con id:".$noticia->getId());
}

}


