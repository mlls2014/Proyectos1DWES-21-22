<?php

require_once("Model.php");

/**
 *   Modelo de 'User'. Implementa el modelo de usuarios de nuestra aplicación en una
 *   arquitectura MVC. Define un objeto de tipo User
 */

 /*
 En el patrón ActiveRecord el modelo User contiene los datos del usuario y todas los métodos que me
 permiten operar con el usuario: getAll, save, deleteBy, ...
 En el patrón DAO el modelo sólo contiene los datos propios del usuario y los métodos de BD se sitúan en la clase UserDAO
 */
class User extends Model
{

   private $id;
   private $nombre;
   private $email;
   private $password;
   private $image;

   public function __construct($nombre = "", $email = "", $password = "", $image = "")
   {
      // Se conecta a la BD
      parent::__construct(); //Al efectuar aquí la conexión no podemos usar PDO::FETCH_CLASS ya que el constructor se ejecuta cada vez que recupera una fila de usuario
      $this->table = "usuarios";
      $this->nombre = $nombre;
      $this->email = $email;
      $this->password = $password;
      $this->image = $image;
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

   public function getImage()
   {
      return $this->image;
   }

   public function setImage($image)
   {
      $this->image = $image;
   }

   public function __toString()
   {
      return $this->id . ": " . $this->nombre . " " . $this->email;
   }

   // Tendríamos que pasar estos métodos a la clase BaseModel por medio de la reflexión en la BD
   // O utilizar interfaces para User y BaseModel
   public function save()
   {
      $sql = "INSERT INTO " . $this->table . " (nombre, email, password, image) VALUES (?, ?, ?, ?)";
      try {
         $stmt = $this->db->prepare($sql);
         $stmt->execute(array($this->getNombre(), $this->getEmail(), $this->getPassword(), $this->getImage()));
         $this->setId($this->db->lastInsertId());
      } catch (\PDOException $e) {
         echo "Error al grabar Usuario!: " . $e->getMessage() . "</br>";
      }
   }

   public function update()
   {
      $sql = "UPDATE " . $this->table . " SET nombre = ?, email = ?, password = ?, image = ?";
      try {
         $stmt = $this->db->prepare($sql);
         $stmt->execute(array($this->getNombre(), $this->getEmail(), $this->getPassword(), $this->getImage()));
      } catch (\PDOException $e) {
         echo "Error al modificar Usuario!: " . $e->getMessage() . "</br>";
      }
   }
}
