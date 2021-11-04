<?php

require_once("user/UserDAOImpPDO.php");
require_once("user/User.php");
require_once("core/CreatorDAO.php");

abstract class Index{

   public static function run(){
      $userDAO = DBManager::getInstance()->getCreator()->factoryUserDAO();
 
      // Queda muy claro dónde tienes que hacer la operativa con la BD. En el DAO
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