<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
* @ORM\Entity(repositoryClass="App\Repository\NoticiaRepository")
*/
class Noticia {
   /**
    * @ORM\Id
    * @ORM\GeneratedValue
    * @ORM\Column(type="integer")
    */
   private $id;
   /**
    * @ORM\Column(type="string", length=50)
    */
   private $seccion;

   /**
    * @ORM\Column(type="string", length=50)
    */
   private $equipo;

   /**
    * @ORM\Column(type="string", length=8)
    */
   private $fecha;

   /**
    * @ORM\Column(type="string", length=255)
    */
   private $textoNoticia;

   /**
    * @ORM\Column(type="string", length=255)
    */
   private $textoTitular;

   /**
    * @ORM\Column(type="string", length=255)
    */
   private $imagen;

   /*Getters&Setters*/
   public function getId() {
       return $this->id;
   }
   public function getSeccion() {
       return $this->seccion;
   }
   public function getEquipo() {
       return $this->equipo;
   }
   public function getFecha() {
       return $this->fecha;
   }
   public function setSeccion($seccion) {
       $this->seccion=$seccion;
   }
   public function setEquipo($equipo) {
       $this->equipo=$equipo;
   }
   public function setFecha($fecha) {
       $this->fecha=$fecha;
   }

   public function getTextoNoticia(): ?string
   {
       return $this->textoNoticia;
   }

   public function setTextoNoticia(string $textoNoticia): self
   {
       $this->textoNoticia = $textoNoticia;

       return $this;
   }

   public function getTextoTitular(): ?string
   {
       return $this->textoTitular;
   }

   public function setTextoTitular(string $textoTitular): self
   {
       $this->textoTitular = $textoTitular;

       return $this;
   }

   public function getImagen(): ?string
   {
       return $this->imagen;
   }

   public function setImagen(string $imagen): self
   {
       $this->imagen = $imagen;

       return $this;
   }
}
