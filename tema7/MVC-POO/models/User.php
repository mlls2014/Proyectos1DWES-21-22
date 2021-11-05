<?php

/**
 *   Modelo de 'User'. Implementa el modelo de usuarios de nuestra aplicación en una
 *   arquitectura MVC. Define un objeto de tipo User
 */
class User
{
   
   /**
    * id  campo id del usuario
    *
    * @var int
    */
   private $id;
   private $nombre;
   private $email;
   private $password;
   private $imagen;

   public function __construct($nombre = "", $email = "", $password = "", $imagen = "")
   {
      $this->nombre = $nombre;
      $this->email = $email;
      $this->password = $password;
      $this->imagen = $imagen;
   }

   public function getId()
   {
      return $this->id;
   }

   public function setId($id)
   {
      $this->id = $id;
   }

   public function getNombre()
   {
      return $this->nombre;
   }

   public function setNombre($nombre)
   {
      $this->nombre = $nombre;
   }

   public function getEmail()
   {
      return $this->email;
   }

   public function setEmail($email)
   {
      $this->email = $email;
   }

   public function getPassword()
   {
      return $this->password;
   }

   public function setPassword($password)
   {
      $this->password = $password;
   }

   public function getImagen()
   {
      return $this->imagen;
   }

   public function setImagen($imagen)
   {
      $this->imagen = $imagen;
   }

   public function __toString()
   {
      return $this->id . ": " . $this->nombre . " " . $this->email;
   }
}
