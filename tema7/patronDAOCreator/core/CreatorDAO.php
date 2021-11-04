<?php
/* 
* Esta clase sería la clase creadora en el patrón Factory 
* Estas clases sirven para la explicación del patrón factory, en vuestra aplicación no tenéis que utilizarla de forma obligatoria
* https://refactoring.guru/es/design-patterns/factory-method
*/
// La clase creadora declara el método fábrica que debe devolver
// un objeto de una clase de UserDAO, CursoDAO, etc. Normalmente, las
// subclases de la creadora proporcionan la implementación de
// este método.

require_once("user/UserDAO.php");
require_once("user/UserDAOImpPDO.php");
require_once("user/UserDAOImpMongo.php");

abstract class CreatorDAO {

   abstract public function factoryUserDAO(): UserDAO; 
   // añadir otros métodos factorys
   
}

class CreatorDAOImpPDO extends CreatorDAO
{
    public function factoryUserDAO(): UserDAO
    {
        return new UserDAOImpPDO();
    }
}

class CreatorDAOImpMongo extends CreatorDAO
{
    public function factoryUserDAO(): UserDAO
    {
        return new UserDAOImpMongo();
    }
}
