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
* @Route("/deportes", name="inicio" )
*/
public function inicio() {
 return $this->render("base.html.twig");
}
/**
* @Route("/deportes/{seccion}/{titular} ",
* defaults={"seccion":"tenis"}, name="verNoticia")
*/
public function noticia($titular, $seccion)
{
 $em=$this->getDoctrine()->getManager();
 $repository = $this->getDoctrine()->getRepository(Noticia::class);
 $noticia= $repository->findOneBy(['textoTitular' => $titular]);
 // Si la noticia que buscamos no se encuentra lanzamos error 404
 if(!$noticia){
         // Ahora que controlamos el manejo de plantilla twig, vamos a
         // redirigir al usuario a la página de inicio
         // y mostraremos el error 404, para así no mostrar la página de
         // errores generica de symfony
         throw $this->createNotFoundException('Error 404 este deporte no está en nuestra Base de Datos');
   return $this->render("base.html.twig",[
             'texto'=>"Error 404 Página no encontrada"
   ]);
 }
   return $this->render('noticias/noticia.html.twig', [
         // Parseamos el titular para quitar los símbolos -
         'titulo' => ucwords(str_replace('-', ' ', $titular)),
         'noticias'=>$noticia

     ]);
}
/**
* @Route("/deportes/{seccion}/{pagina}", name="lista_paginas",
*      requirements={"pagina"="\d+"},
*      defaults={"seccion":"tenis"})
*/
public function lista($pagina = 1, $seccion) {
 $em=$this->getDoctrine()->getManager();
 $repository = $this->getDoctrine()->getRepository(Noticia::class);

 $noticiaSec= $repository->findOneBy(['seccion' => $seccion]);
 // Si el deporte que buscamos no se encuentra lanzamos la
 // excepcion 404 deporte no encontrado
 if(!$noticiaSec) {
     throw $this->createNotFoundException('Error 404 este deporte no está en nuestra Base de Datos');
 }

 // Almacenamos todas las noticias de una sección en una lista
 $noticias = $repository->findBy([
     "seccion"=>$seccion
 ]);

 return $this->render('noticias/listar.html.twig', [
     // La función str_replace elimina los símbolos - de los títulos
     'titulo' => ucwords(str_replace('-', ' ', $seccion)),
     'noticias'=>$noticias
 ]);
}

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


