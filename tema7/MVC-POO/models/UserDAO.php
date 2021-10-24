<?php
/*
* Interfaz que contiene los métodos propios para manejar los datos de usuario en nuestra app
* Contiene también los métodos de BaseDAO
*/

// require_once("BaseDAO.php"); No es necesario ya que siempre se requiere con el FronController
require_once("User.php");

interface UserDAO extends BaseDAO{
   public function save(User $user);
   public function update(User $user);
}