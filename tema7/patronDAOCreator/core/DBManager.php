<?php

/**
 * DBManager implementa el patron Singleton para mantener una única instancia de PDO
 */
define('DBDRIVER', 'mysql');
define('DBHOST', 'localhost');
define('DBNAME', 'pruebadao');
define('DBUSER', 'root');
define('DBPASS', '');

define("GESTORDB", "PDO");

class DBManager
{
   /**
    * Contenedor de la instancia de la Clase
    *
    * @var DBManager
    */
   private static $instance;
   /**
    * Manejador de la base de datos
    *
    * @var PDO
    */
   private $db;
   private $creator;  // Instancia al creador de los DAO
   private function __construct()
   {
   }
   /**
    * Garantiza que se crea una sóla instancia de Config
    *
    * @return DBManager
    */
   public static function getInstance()
   {
      if (is_null(self::$instance)) {
         self::$instance = new self();
      }
      return self::$instance;
   }
   /**
    * Se conecta a la base de datos con los valores de configuración de la app
    *
    * @return CreatorDAO
    */
   public function getConnection()
   {
      if (is_null($this->db)) {
         if (GESTORDB == "MONGO") {
            // Por hacer
         } else {
            try {
               $this->db = new \PDO(DBDRIVER . ":host=" . DBHOST . ";dbname=" . DBNAME, DBUSER, DBPASS);
               $this->db->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
               $this->db->setAttribute(\PDO::ATTR_DEFAULT_FETCH_MODE, \PDO::FETCH_ASSOC);
            } catch (\PDOException $ex) {
               return $ex->getMessage();
            }
         }
      }
      return $this->db;
   }

   public function getCreator()
   {
      if (is_null($this->creator)) {
         if (GESTORDB == "MONGO") {
            $this->creator = new CreatorDAOImpMongo();
         } else {  // se supone PDO
            $this->creator = new CreatorDAOImpPDO();
         }
      }
      return $this->creator;
   }
}
