<?php
/*
* Implementación en Mongo de la interfaz BaseDAO
*/

/**
 * Implementa BaseDAO para Mongo. Pendiente de implementar
 */
abstract class BaseDAOImpMongo
{
   protected $table;
   protected $clase; 
   protected $db;

   /**
    * Se conecta a la base de datos
    */
   public function __construct()
   {
      
   }

   public function getAll(): array
   {
      
   }

   public function getById($id)
   {
      
   }

   public function getBy($column, $value): array
   {
      
   }

   public function deleteById($id)
   {
      
   }

   public function deleteBy($column, $value)
   {
      
   }

}
