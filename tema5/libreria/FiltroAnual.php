<?php
require_once 'CriterioFiltro.php';

class FiltroAnual implements CriterioFiltro
{
   private $_año;

   public function __construct($año)
   {
      $this->_año = $año;
   }

   public function esSeleccionable(Libro $libro)
   {     
      return ($libro->getAño() == $this->_año);
   }
}
