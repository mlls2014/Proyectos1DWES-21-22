<?php

// Siempre ejecutamos desde index.php => los includes siempren deben suponer que la ruta actual es la de index.php
// Esto lo conseguiremos en la práctica con el patrón FrontController
require_once("user/UserDAO.php");
require_once("core/BaseDAOImpPDO.php");
require_once("user/User.php");

/*
* Clase que implementa el acceso a base de datos MongoDB 
* No es necesario implementarla por ahora 
*/
class UserDAOImpMongo extends BaseDAOImpPDO implements UserDAO{
   public function __construct()
   {
      // Se conecta a la BD
      parent::__construct();
      $this->table = "usuarios";
      $this->clase = "User";
   }

   public function save(User $user)
   {
   
   }

   public function update(User $user)
   {
      
   }
}