<?php require 'Autor.php';

class Libro
{
   private $_titulo;
   private $_tema;
   private $_año;
   private $_colAutores = array();

   public function __construct($titulo, $tema, $año)
   {
      $this->_titulo = $titulo;
      $this->_tema = $tema;
      $this->_año = $año;
   }

   public function addAutor($nombre, $apellido)
   {
      $this->_colAutores[] = new Autor($nombre, $apellido);
   }

   public function getTitulo()
   {
      return $this->_titulo;
   }

   public function getTema()
   {
      return $this->_tema;
   }

   public function getAño()
   {
      return $this->_año;
   }

   public function getAutores()
   {
      return $this->_colAutores;
   }
   
   public function __toString()
   {
      return $this->_titulo;
   }
}
