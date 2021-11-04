<?php
/**
 *   Modelo de 'User'. Implementa el modelo de usuarios de nuestra aplicación en una
 *   arquitectura MVC. Define un objeto de tipo User
 */

 /*
 En el patrón ActiveRecord el modelo User contiene los datos del usuario y todos los métodos que me
 permiten operar con el usuario: getAll, save, deleteBy, ...
 En el patrón DAO el modelo sólo contiene los datos propios del usuario y los métodos de BD se sitúan en la clase UserDAO
 */
require_once("Model.php");

class User extends Model
{
   private $id;
   private $nombre;
   private $email;
   private $password;
   private $imagen;

   public function __construct($nombre = "", $email = "", $password = "", $imagen = "")
   {
      // Se conecta a la BD
      parent::__construct(); 
      $this->table = "usuarios";
      $this->clase = "User";
      $this->nombre = $nombre;
      $this->email = $email;
      $this->password = $password;
      $this->imagen = $imagen;
   }

   public function getId()
   {
      return $this->id;
   }

   public function setId($id)
   {
      $this->id = $id;
   }

   public function getNombre()
   {
      return $this->nombre;
   }

   public function setNombre($nombre)
   {
      $this->nombre = $nombre;
   }

   public function getEmail()
   {
      return $this->email;
   }

   public function setEmail($email)
   {
      $this->email = $email;
   }

   public function getPassword()
   {
      return $this->password;
   }

   public function setPassword($password)
   {
      $this->password = $password;
   }

   public function getimagen()
   {
      return $this->imagen;
   }

   public function setimagen($imagen)
   {
      $this->imagen = $imagen;
   }

   public function __toString()
   {
      return $this->id . ": " . $this->nombre . " " . $this->email;
   }

   // Tendríamos que pasar estos métodos a la clase BaseModel por medio de la reflexión en la BD
   // Este modelo no es independiente del acceso a datos ya que no utilizamos interfaces para User y BaseModel
   /*
     Inserta un registro en la tabla con los datos contenidos en el objeto
   */
   public function save()
   {
      $sql = "INSERT INTO " . $this->table . " (nombre, email, password, imagen) VALUES (?, ?, ?, ?)";
      try {
         $stmt = $this->db->prepare($sql);
         $stmt->execute(array($this->nombre, $this->email, $this->password, $this->imagen));
         $this->setId($this->db->lastInsertId());
      } catch (\PDOException $e) {
         echo "Error al grabar Usuario!: " . $e->getMessage() . "</br>";
      }
   }

   /*
     Actualiza el registro User en la tabla con los datos contenidos en el objeto
   */
   public function update()
   {
      if (!empty($this->id)){
         $sql = "UPDATE " . $this->table . " SET nombre = ?, email = ?, password = ?, imagen = ? WHERE id = ?";
         try {
            $stmt = $this->db->prepare($sql);
            $stmt->execute(array($this->nombre, $this->email, $this->password, $this->imagen, $this->id));
         } catch (\PDOException $e) {
            echo "Error al modificar Usuario!: " . $e->getMessage() . "</br>";
         }
      }else{
            echo "Error al modificar Usuario!: No existe id</br>";
      }
   }

   
}
