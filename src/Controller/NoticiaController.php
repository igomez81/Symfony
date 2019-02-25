<?php

namespace App\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Entity\Noticia;

class NoticiaController extends Controller
{
/**
* @Route("/deportes/cargarbd", name="noticia")
*/
public function cargarBd() {
   $em=$this->getDoctrine()->getManager();

   $noticia=new Noticia();
   $noticia->setSeccion("Futbol");
   $noticia->setEquipo("Barcelona");
   $noticia->setFecha("21022019");
   $noticia->setTextoTitular("El Barcelona vuelve a ganar en casa del Madrid");
   $noticia->setTextoNoticia("Los cules vencieron 5 a 0 en el segundo encuentro de liga.");
   $noticia->setImagen('clasico.jpg');

   $em->persist($noticia);
   $em->flush();

   return new Response("Noticia guardada con éxito con id:".$noticia->getId());
}
    /**
     * @Route("/deportes/actualizar", name="actualizarNoticia")
     */
    public function actualizarBd(Request $request)
    {
        $em=$this->getDoctrine()->getManager();
        $id=$request->query->get('id');
        $noticia = $em->getRepository(Noticia::class)->find($id);

        $noticia->setTextoTitular("Titular de ejemplo actualizado para la noticia con id:".$noticia->getId());
        $noticia->setTextoNoticia("Texto de ejemplo actualizado para la noticia con id:".$noticia->getId());
        $noticia->setImagen("Nadal-mallorca.jpg".$noticia->getId());
        $em->flush();

        return new Response("Noticia actualizada!");

    }
	/**
* @Route("/deportes/{seccion}/{pagina}", name="lista_paginas",
*      requirements={"pagina"="\d+"},
*      defaults={"seccion":"tenis"})
*/
	/*
public function lista($pagina = 1, $seccion) {
   $em=$this->getDoctrine()->getManager();
   $repository = $this->getDoctrine()->getRepository(Noticia::class);
   //Buscamos las noticias de una sección
   $noticiaSec= $repository->findOneBy(['seccion' => $seccion]);
   // Si la sección no existe saltará una excepción
   if(!$noticiaSec) {
       throw $this->createNotFoundException('Error 404 este deporte no está en nuestra Base de Datos');
   }
   // Almacenamos todas las noticias de una sección en una lista
   $noticias = $repository->findBy([
       "seccion"=>$seccion
   ]);
   return new Response("Hay un total de ".count($noticias)." noticias de la sección de ".$seccion);
}
*/
    /**
* @Route("/deportes/eliminar", name="eliminarNoticia")
*/
public function eliminarBd(Request $request) {
   $em=$this->getDoctrine()->getManager();
   $id=$request->query->get('id');
   $noticia = $em->getRepository(Noticia::class)->find($id);
   $em->remove($noticia);
   $em->flush();
   return new Response("Noticia eliminada!");
}
}
