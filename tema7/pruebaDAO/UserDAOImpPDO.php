<?php

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
      $sql = "UPDATE " . $this->table . " SET nombre = ?, email = ?, password = ?, image = ?";
      try {
         $stmt = $this->db->prepare($sql);
         $stmt->execute(array($user->getNombre(), $user->getEmail(), $user->getPassword(), $user->getImage()));
      } catch (\PDOException $e) {
         echo "Error al modificar Usuario!: " . $e->getMessage() . "</br>";
      }
   }
}
