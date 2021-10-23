<?php
/*
* Implementación en PDO de la interfaz UserDAO
* Si en algún momento tuvieramos que utilizar otro gestor de BD como Postgress u Oracle
* bastaría con añadir una clase UserDAOImpOracle sin necesidad de cambiar las otras capas de la app
*/

require_once("UserDAO.php");
require_once("BaseDAOImpPDO.php");
require_once("User.php");


class UserDAOImpPDO extends BaseDAOImpPDO implements UserDAO
{
   public function __construct()
   {
      // Se conecta a la BD
      parent::__construct();
      $this->table = "usuarios";
      $this->clase = "User";
   }

   public function save(User $user)
   {
      $sql = "INSERT INTO " . $this->table . " (nombre, email, password, image) VALUES (?, ?, ?, ?)";
      try {
         $stmt = $this->db->prepare($sql);
         $stmt->execute(array($user->getNombre(), $user->getEmail(), $user->getPassword(), $user->getImage()));
         $user->setId($this->db->lastInsertId());
      } catch (\PDOException $e) {
         echo "Error al grabar Usuario!: " . $e->getMessage() . "</br>";
      }
   }

   public function update(User $user)
   {
      if (!empty($user->getId())){
         $sql = "UPDATE " . $this->table . " SET nombre = ?, email = ?, password = ?, image = ? WHERE id = ?";
         try {
            $stmt = $this->db->prepare($sql);
            $stmt->execute(array($user->getNombre(), $user->getEmail(), $user->getPassword(), $user->getImage(), $user->getId()));
         } catch (\PDOException $e) {
            echo "Error al modificar Usuario!: " . $e->getMessage() . "</br>";
         }
      }else{
            echo "Error al modificar Usuario!: No existe id</br>";
      }
   }
}
