<?php
/*
* Implementación en PDO de la interfaz UserDAO
* Si en algún momento tuvieramos que utilizar otro gestor de BD como Postgress u Oracle
* bastaría con añadir una clase UserDAOImpOracle sin necesidad de cambiar las otras capas de la app
*/

require_once MODELS_FOLDER . 'UserDAO.php';

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
            $return["error"] = "Error al modificar Usuario!: " . $this->table . "!: " . $e->getMessage();
         } finally {
            return $return;
         }
      } else {
         $return["error"] = "Error al modificar Usuario!: No existe id";
         return $return;
      }
   }

   /**
    * Devuelve el array de objetos con $user en el elemento datos
    * si existe un usuario con el login y la contraseña dadas, null en caso contrario.
    * @param string $login
    * @param string $password
    * @return Array
    *       El elemento correcto es true cuando no hay error en la consulta y false en c.c.
    *       El elemento datos tiene el usuario validado
    *       El elemento error contiene el mensaje de error en su caso
    */
   public function validarUsuario($login, $password)
   {
      $return = ["correcto" => false, "datos" => null, "error" => NULL];    
      $sql = "SELECT * FROM " . $this->table . " WHERE nombre = ? AND password = ?";
      try {
         $stmt = $this->db->prepare($sql);
         $stmt->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, $this->clase);
         // Con cifrado podría ser así
         // $stmt->execute(array($login, sha1($password)));
         $stmt->execute(array($login, $password));
         if ($row = $stmt->fetch()) {
            $return['datos'] = $row;
         }
         $return["correcto"] = true; 
      } catch (\PDOException $e) { 
         $return["error"] = "Error al validar login de Usuario!";
      } finally {
         return $return;
      }
   }
}
