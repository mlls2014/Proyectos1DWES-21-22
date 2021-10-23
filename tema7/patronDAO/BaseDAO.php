<?php
/*
  Interfaz base para todas la interfaces DAO. Contiene métodos genéricos. Podríamos programar alguno más utilizando reflexión sobre la BD
  pero no queremos complicar más la solución
*/

interface BaseDAO {
   public function getById($id);
   public function getBy($column, $value): array;
   public function getAll(): array;  
   public function deleteById($id);
   public function deleteBy($column, $value);
}