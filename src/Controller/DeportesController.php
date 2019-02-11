<?php
namespace App\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\Session;

class DeportesController extends Controller {

/**
* @Route("/sports/{section}/{page}", name="lista_paginas",
*      requirements={"page"="\d+"},
*      defaults={"section":"tenis"})
*/
public function lista($page=1, $section) {
 // Simulamos una base de datos de deportes
 $sports=["futbol", "tenis","rugby"];
 // Si el deporte que buscamos no se encuentra lanzamos la
 // excepcion 404 deporte no encontrado
 if(!in_array($section,$sports)) {
     throw $this->createNotFoundException('Error 404 este deporte no está en nuestra Base de Datos');
 }
 return new Response(sprintf( 'Deportes seccion: seccion %s, listado de noticias página %s', $section, $page));
}


/**
* @Route(
*     "/deportes/{_locale}/{date}/{section}/{team}/{slug}.{_format}",
*     defaults={"slug": "1","_format":"html"},
*     requirements={
*         "_locale": "es|en",
*         "_format": "html|json|xml",
*          "date": "[\d+]{8}"
*     }
* )
*/
public function rutaAvanzada($_locale, $date, $section, $team, $slug) {
 // Simulamos una base de datos de equipos o personas
 $sports=["valencia", "barcelona","federer", "rafa-nadal"];

 // Si el equipo o persona que buscamos no se encuentra redirigimos
 // al usuario a la página de inicio
 if(!in_array($team,$sports)) {
    return $this->redirectToRoute('lista_paginas');
 }
 return new Response(sprintf(
     'Mi noticia en idioma=%s,
      fecha=%s,deporte=%s,equipo=%s, noticia=%s ',
     $_locale, $date, $section, $team, $slug));
}


/**
// ...
/**
* @Route("/deportes/usuario", name="usuario" )
*/
public function sesionUsuario(Request $request) {
 $usuario_get=$request->query->get('nombre');
  $session = $request->getSession();
  $session->set('nombre', $usuario_get);
  return $this->redirectToRoute('usuario_session',array('nombre'=>$usuario_get));
}
// …

/**
* @Route("/deportes/usuario/{nombre}", name="usuario_session" )
*/
public function paginaUsuario() {
$session=new Session();
$usuario=$session->get('nombre');
return new Response(sprintf('Sesión iniciada con el atributo nombre: %s', $usuario
));
}


}


