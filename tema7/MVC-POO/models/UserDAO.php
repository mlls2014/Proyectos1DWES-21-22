<?php
require_once("User.php");

/**
 * UserDAO
 * Interfaz que contiene los métodos propios para manejar los datos de usuario en nuestra app
 * Contiene también los métodos de BaseDAO
 */
interface UserDAO extends BaseDAO{
      
   /**
    * Method save
    *
    * @param User $user 
    *
    * @return void
    */
   public function save(User $user);
      
   /**
    * Method update
    *
    * @param User $user
    *
    * @return void
    */
   public function update(User $user);

   /**
    * Devuelve el objeto $user si existe un usuario con el login 
    * y la contraseña dadas, null en caso contrario
    *
    * @param string $login
    * @param string $password
    * @return User
    */
   // public function validarUsuario(login , password);

   /* Devuelve el array de objetos Curso a los que está apuntado el $user
   *  Array vacío en c.c.
   *  @$user User
   *  @return array
   */
   // public function cursos(User $user);   
   
   /**
    * Method estadoUsuario
    *
    * @param User $user [explicite description]
    * @param $estado $estado [explicite description]
    *
    * @return void
    */
   //public function estadoUsuario (User $user, $estado);
}