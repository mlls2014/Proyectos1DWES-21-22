<?php
/*
* Implementación en PDO de la interfaz UserDAO
* Si en algún momento tuvieramos que utilizar otro gestor de BD como Postgress u Oracle
* bastaría con añadir una clase UserDAOImpOracle sin necesidad de cambiar las otras capas de la app
*/

require_once("UserDAO.php");
// require_once("User.php");

class UserDAOImpPDO extends BaseDAOImpPDO implements UserDAO
{
   public function __construct()
   {
      // Se conecta a la BD
      parent::__construct();
      $this->table = "usuarios";
      $this->clase = "User";
   }

   /**
    * Método para grabar un usuario
    * Devuelve un array asociativo con tres campos:
    * -'correcto': indica si el alta se realizó correctamente o no.
    * -'datos': null
    * -'error': almacena el mensaje asociado a una situación errónea (excepción) 
    *
    */
   public function save(User $user)
   {
      $return = ["correcto" => false, "datos" => null, "error" => NULL];
      $sql = "INSERT INTO " . $this->table . " (nombre, email, password, imagen) VALUES (?, ?, ?, ?)";
      try {
         $stmt = $this->db->prepare($sql);
         $stmt->execute(array($user->getNombre(), $user->getEmail(), $user->getPassword(), $user->getImagen()));
         $user->setId($this->db->lastInsertId());
         $return["correcto"] = true;
      } catch (\PDOException $e) {
         $return["correcto"] = false;
         $return["error"] = "Error al grabar Usuario!: " . $this->table . "!: " . $e->getMessage();
      } finally {
         return $return;
      }
   }

   /**
    * Método para modificar un usuario
    * Devuelve un array asociativo con tres campos:
    * -'correcto': indica si la modificación se realizó correctamente o no.
    * -'datos': null
    * -'error': almacena el mensaje asociado a una situación errónea (excepción) 
    *
    */
   public function update(User $user)
   {
      $return = ["correcto" => false, "datos" => null, "error" => NULL];

      if (!empty($user->getId())) {
         $sql = "UPDATE " . $this->table . " SET nombre = ?, email = ?, password = ?, imagen = ? WHERE id = ?";
         try {
            $stmt = $this->db->prepare($sql);
            $stmt->execute(array($user->getNombre(), $user->getEmail(), $user->getPassword(), $user->getImagen(), $user->getId()));
            $return["correcto"] = true;
         } catch (\PDOException $e) {
            $return["correcto"] = false;
            $return["error"] = "Error al modificar Usuario!: " . $this->table . "!: " . $e->getMessage();
         } finally {
            return $return;
         }
      } else {
         $return["correcto"] = false;
         $return["error"] = "Error al modificar Usuario!: No existe id";
         return $return;
      }
   }
}
