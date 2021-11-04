<?php
require_once("user/User.php");
require_once("user/UserDAO.php");
require_once("core/BaseDAO.php");

/*
* Interfaz que contiene los métodos propios para manejar los datos de usuario en nuestra app
* Contiene también los métodos de BaseDAO
*/

interface UserDAO extends BaseDAO{
   public function save(User $user);
   public function update(User $user);
}