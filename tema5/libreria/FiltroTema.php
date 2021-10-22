<?php
require_once 'CriterioFiltro.php';

class FiltroTema implements CriterioFiltro
{
   private $_tema;

   public function __construct($tema)
   {
      $this->_tema = $tema;
   }

   public function esSeleccionable(Libro $libro)
   {     
      return (strpos($libro->getTema(),$this->_tema)!==false);
   }
}
