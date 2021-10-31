<?php
/*
* Implementación en PDO de la interfaz BaseDAO
* Si en algún momento tuvieramos que utilizar otro gestor de BD como Postgress u Oracle
* bastaría con añadir una clase BaseDAOImpOracle sin necesidad de cambiar las otras capas de la app
*/
require_once("DBManager.php");

/**
 * Módelo base para las clases de models
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
    * Devuelve un array asociativo con tres campos:
    * -'correcto': indica si el listado se realizó correctamente o no.
    * -'datos': almacena todos los datos obtenidos de la consulta.
    * -'error': almacena el mensaje asociado a una situación errónea (excepción) 
    *
    */
   public function getAll(): array
   {
      $return = ["correcto" => false, "datos" => [], "error" => NULL];
      try {
         $query = $this->db->query("SELECT * FROM $this->table");
         //Devolvemos el resultset en forma de array de objetos
         //PDO::FETCH_PROPS_LATE sirve para que se llame al constructor de la clase antes de asignar los valores de la fila al objeto
         $resultSet = $query->fetchAll(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, $this->clase);
         $return["correcto"] = true;
         $return["datos"] = $resultSet;
      } catch (\PDOException $e) {
         $return["correcto"] = false;
         $return["error"] = "Error al obtener todas las filas en " . $this->table . "!: " . $e->getMessage();
      } finally {
         return $return;
      }
   }

   /**
    * Método genérico para obtener un registro por id en la tabla $table
    * Devuelve un array asociativo con tres campos:
    * -'correcto': indica si el listado se realizó correctamente o no.
    * -'datos': el registro con el id especificado si lo hubiera, null en caso contrario
    * -'error': almacena el mensaje asociado a una situación errónea (excepción) 
    *
    */
   public function getById($id)
   {
      $return = ["correcto" => false, "datos" => NULL, "error" => NULL];
      try {
         $query = $this->db->query("SELECT * FROM $this->table WHERE id = $id");
         $query->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, $this->clase);

         if ($row = $query->fetch()) {
            $return["datos"] = $row;
         }
         $return["correcto"] = true;
      } catch (\PDOException $e) {
         $return["correcto"] = false;
         $return["error"] = "Error al obtener todas la fila con id $id en "  . $this->table . "!: " . $e->getMessage();
      } finally {
         return $return;
      }
   }

   /**
    * Método genérico para obtener los registros de la tabla $table que cumplan la condicion de que column sea igual a value
    * Devuelve un array asociativo con tres campos:
    * -'correcto': indica si el listado se realizó correctamente o no.
    * -'datos': almacena todos los datos obtenidos de la consulta.
    * -'error': almacena el mensaje asociado a una situación errónea (excepción) 
    *
    */
   public function getBy($column, $value): array
   {
      $return = ["correcto" => false, "datos" => [], "error" => NULL];
      try {
         $query = $this->db->query("SELECT * FROM $this->table WHERE $column = '$value'");
         //Devolvemos el resultset en forma de array de objetos
         $resultSet = $query->fetchAll(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, $this->clase);
         $return["correcto"] = true;
         $return["datos"] = $resultSet;
      } catch (\PDOException $e) {
         $return["correcto"] = false;
         $return["error"] = "Error al obtener las filas por columnas en " . $this->table . "!: " . $e->getMessage();
      } finally {
         return $return;
      }
   }

   /**
    * Método genérico para borrar un registro por id en la tabla $table
    * Devuelve un array asociativo con tres campos:
    * -'correcto': indica si el listado se realizó correctamente o no.
    * -'datos': número de filas eliminadas?
    * -'error': almacena el mensaje asociado a una situación errónea (excepción) 
    *
    */
   public function deleteById($id)
   {
      $return = ["correcto" => false, "datos" => null, "error" => NULL];
      try {
         $query = $this->db->query("DELETE FROM $this->table WHERE id = $id");
         $return["correcto"] = true;
         $return["datos"] = $query;
      } catch (\PDOException $e) {
         $return["correcto"] = false;
         $return["error"] = "Error al borrar la fila por id en " . $this->table . "!: " . $e->getMessage();
      } finally {
         return $return;
      }
   }

   /**
    * Método genérico para borrar registros por columnas en la tabla $table
    * Devuelve un array asociativo con tres campos:
    * -'correcto': indica si el listado se realizó correctamente o no.
    * -'datos': número de filas eliminadas?
    * -'error': almacena el mensaje asociado a una situación errónea (excepción) 
    *
    */
   public function deleteBy($column, $value)
   {
      $return = ["correcto" => false, "datos" => null, "error" => NULL];
      try {
         $query = $this->db->query("DELETE FROM $this->table WHERE $column = '$value'");
         $return["correcto"] = true;
         $return["datos"] = $query;
      } catch (\PDOException $e) {
         $return["correcto"] = false;
         $return["error"] = "Error al borrar las filas por columna en " . $this->table . "!: " . $e->getMessage();
      } finally {
         return $return;
      }
   }
}
