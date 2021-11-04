<?php
/*
* Implementación en PDO de la interfaz BaseDAO
* Si en algún momento tuvieramos que utilizar otro gestor de BD como Postgress u Oracle
* bastaría con añadir una clase BaseDAOImpOracle sin necesidad de cambiar las otras capas de la app
*/
require_once("core/DBManager.php");

/**
 * Implementa BaseDAO para PDO
 */
abstract class BaseDAOImpPDO
{
   /**
    * Tabla asociada al modelo
    *
    * @var string
    */
   protected $table;
   /**
    * Introducimos la dependencia de que las propiedades de la clase deben llamarse como los campos de la tabla.
    * Esto nos permite disponer sin mucho esfuerso de la posibilidad de recuperar las filas de las tablas como objetos del tipo Class que nos interese
    *
    * La alternativa sería devolver un objeto del tipo stdClass o un array lo que me obligaría a copiar manualmente las
    * columnas a las propiedades del objeto de la clase que quisiera. Esto no podría hacerlo en BaseDAOImpPDO de forma sencilla
    * y lo tendría que hacer en cada XXXDAOImp.
    * Otra alternativa sería trabajar en las respuestas de BD sólo con arrays de stdClass, lo que no independiza tampoco la BD
    * de las capas superiores de la app
   */
   protected $clase; 
   protected $db;

   /**
    * Se conecta a la base de datos
    */
   public function __construct()
   {
      $this->db = DBManager::getInstance()->getConnection();
   }

   /**
    * Método genérico para obtener todos los registros de la tabla $table
    *
    */
   public function getAll(): array
   {
      $resultSet = [];
      try {
         $query = $this->db->query("SELECT * FROM $this->table ORDER BY id DESC");
         //Devolvemos el resultset en forma de array de objetos
         //PDO::FETCH_PROPS_LATE sirve para que se llame al constructor de la clase antes de asignar los valores de la fila al objeto
         $resultSet = $query->fetchAll(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, $this->clase);
      } catch (\PDOException $e) {
         echo "Error al obtener todas las filas en " . $this->table . "!: " . $e->getMessage() . "</br>";
      } finally {
         return $resultSet;
      }
   }

   public function getById($id)
   {
      try {
         $query = $this->db->query("SELECT * FROM $this->table WHERE id = $id");
         $query->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, $this->clase);

         if ($row = $query->fetch()) {
            $resultSet = $row;
         }

         return $resultSet;
      } catch (\PDOException $e) {
         echo "Error al obtener por id en " . $this->table . "!: " . $e->getMessage() . "</br>";
      }
   }

   public function getBy($column, $value): array
   {
      $resultSet = [];
      try {
         $query = $this->db->query("SELECT * FROM $this->table WHERE $column = '$value'");
         //Devolvemos el resultset en forma de array de objetos
         $resultSet = $query->fetchAll(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, $this->clase);

         return $resultSet;
      } catch (\PDOException $e) {
         echo "Error al obtener por columna en " . $this->table . "!: " . $e->getMessage() . "</br>";
      } finally {
         return $resultSet;
      }
   }

   public function deleteById($id)
   {
      try {
         $query = $this->db->query("DELETE FROM $this->table WHERE id = $id");
         // $query = $this->db->query("UPDATE $this->table SET deleted_at = NOW() WHERE id = $id");
         return $query;
      } catch (\PDOException $e) {
         echo "Error al borrar por id en " . $this->table . "!: " . $e->getMessage() . "</br>";
      }
   }

   public function deleteBy($column, $value)
   {
      try {
         $query = $this->db->query("DELETE FROM $this->table WHERE $column = '$value'");
         // $query = $this->db->query("UPDATE $this->table SET deleted_at = NOW() WHERE id = $id");
         return $query;
      } catch (\PDOException $e) {
         echo "Error al borrar por columna en " . $this->table . "!: " . $e->getMessage() . "</br>";
      }
   }

}
