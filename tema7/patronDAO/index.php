<?php

require_once("UserDAOImpPDO.php");
require_once("User.php");


abstract class Index{

   public static function run(){
      // Queda muy claro dónde tienes que hacer la operativa con la BD. En el DAO
      $userDAO = new UserDAOImpPDO();

      $user = new User("Jose","jose@gmail.com", "sdsd", "mifoto");
      $userDAO->save($user);
      $user = new User("Ana","ana@gmail.com", "sd323sd", "mifoto");
      $userDAO->save($user);
      $user = new User("David","david@gmail.com", "sds2rd", "mifoto");
      $userDAO->save($user);
      $user = new User("Luis","luis@gmail.com", "sdffesd", "mifoto");
      $userDAO->save($user);

      $usuarios = $userDAO->getAll();
      foreach ($usuarios as $user) {
         echo $user . "<br>";  
      }
      
      $userDAO->deleteBy('nombre',"Ana");
      $userDAO->deleteBy('password', "sds2rd");
      $usuarios = $userDAO->getAll();
      foreach ($usuarios as $user) {
         echo $user . "<br>";  
      }

      $usuarios = $userDAO->getBy('nombre',"Luis");
      foreach ($usuarios as $user) {
         $user->setNombre('Juan');
         $userDAO->update($user);  
      }
   }
}


Index::run();