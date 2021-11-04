<?php

require_once("User.php");


abstract class Index{
   //Pequeña prueba de uso
   public static function run(){
      //Creo y grabo en la BD cuatro usuarios
      $user = new User("Jose","jose@gmail.com", "sdsd", "mifoto");
      $user->save();
      $user = new User("Ana","ana@gmail.com", "sd323sd", "mifoto");
      $user->save();
      $user = new User("David","david@gmail.com", "sds2rd", "mifoto");
      $user->save();
      $user = new User("Luis","luis@gmail.com", "sdffesd", "mifoto");
      $user->save();

      //Obtengo todos los usuarios y los muestro
      $usuarios = $user->getAll();
      foreach ($usuarios as $user) {
         echo $user . "<br>";  
      }
      
      echo "Borro a los usuarios con el nombre igual a Ana<br>";

      //Borro a los usuarios con el nombre igual a Ana
      $user->deleteBy('nombre',"Ana");

      echo "Borro a los usuarios con la password igual a sds2rd<br>";
      //Borro a los usuarios con la password igual a sds2rd
      $user->deleteBy('password', "sds2rd");

      //Muestro los usuarios que quedan
      echo "Muestro los usuarios que quedan<br>";
      $usuarios = $user->getAll();
      foreach ($usuarios as $user) {
         echo $user . "<br>";  
      }

      //Obtengo a todos los usuarios cuyo nombre sea Luis
      $usuarios = $user->getBy('nombre',"Luis");
      foreach ($usuarios as $user) {
      
         $user->setNombre('Juan'); 
         $user->update(); 
      }
   }
}


Index::run();