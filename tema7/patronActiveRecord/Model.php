<?php

/**
 * Módelo base para las clases de models
 * Útil para no tener que repetir los métodos que fácilmente se pueden generalizar
 * Se supone que el campo clave en la tabla se llama id
 */

require_once("DBManager.php");

abstract class Model
{
   /**
    * Tabla asociada al modelo
    *
    * @var string
    */
   protected $table;
   protected $db;
   protected $clase; 

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
          $query = $this->db->query("SELECT * FROM $this->table ORDER BY id ASC");
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
 
    /**
    * Método genérico para obtener los registros de la tabla cuya column sea igual a value
    *
    */
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
