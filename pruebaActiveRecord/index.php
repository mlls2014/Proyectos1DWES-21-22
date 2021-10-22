<?php

require_once("User.php");


abstract class Index{

   public static function run(){
      $user = new User();

      $usuarios = $user->getAll();
      echo "<pre>";
      foreach ($usuarios as $key => $usu) {
         var_dump($usu);  //En este caso $usuarios es un array de stdClass y no de User
      }
      
      $user = new User("Jose","jose@gmail.com", "sdsd", "mifoto");    
      $user->save();
      var_dump($user);
      echo "<pre>";
   }
}


Index::run();