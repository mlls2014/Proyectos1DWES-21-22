<?php

require_once("UserDAOImpPDO.php");
require_once("User.php");


abstract class Index{

   public static function run(){
      $userDAO = new UserDAOImpPDO();

      $user = new User("Jose","jose@gmail.com", "sdsd", "mifoto");

      $userDAO->save($user);
      echo $user;

      echo "<br> Ahora borro al usuario<br>";
      $userDAO->deleteById($user->getId());

      $usuarios = $userDAO->getBy("nombre", "pepe");
      // $usuarios = $userDAO->getAll();
      foreach ($usuarios as $key => $usu) {
         echo $usu;
      }
   }
}


Index::run();