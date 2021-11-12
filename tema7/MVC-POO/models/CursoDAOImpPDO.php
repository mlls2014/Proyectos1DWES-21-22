<?php
/*
* Implementación en PDO de la interfaz CursoDAO
*/
require_once MODELS_FOLDER . 'CursoDAO.php';

class CursoDAOImpPDO extends BaseDAOImpPDO implements CursoDAO
{
   public function __construct()
   {
      // Se conecta a la BD
      parent::__construct();
      $this->table = "cursos";
      $this->clase = "Curso";
   }

   /**
    * Método para grabar un curso
    *
    * @param Curso $curso
    *
    * @return array
    * Devuelve un array asociativo con tres campos:
    * -'correcto': indica si el alta se realizó correctamente o no.
    * -'datos': null
    * -'error': almacena el mensaje asociado a una situación errónea (excepción) 
    *
    */
   public function save(Curso $curso)
   {
      $return = ["correcto" => false, "datos" => null, "error" => NULL];
      $sql = "INSERT INTO " . $this->table . " (nombre, profesor_id, fecha_inicio, "
         . "fecha_fin, fecha_sol, duracion, descripcion, coste, participantes) "
         . "VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
      try {
         $stmt = $this->db->prepare($sql);

         $stmt->execute(array(
            $curso->getNombre(), $curso->getProfesorId(),
            $curso->getFechaInicio(), $curso->getFechaFin(), $curso->getFechaSol(),
            $curso->getDuracion(), $curso->getDescripcion(), $curso->getCoste(), $curso->getParticipantes()
         ));
         $curso->setId($this->db->lastInsertId());
         $return["correcto"] = true;
      } catch (\PDOException $e) {
         $return["error"] = "Error al grabar Curso!: " . $this->table . "!: " . $e->getMessage();
      } finally {
         return $return;
      }
   }

   public function update(Curso $curso)
   {
      $return = ["correcto" => false, "datos" => null, "error" => NULL];

      if (!empty($curso->getId())) {
         $sql = "UPDATE " . $this->table . " SET nombre = ?, profesor_id = ?, fecha_inicio = ?, fecha_fin = ? " .
            " fecha_sol = ?, duracion = ?, descripcion = ?, coste = ?, participantes = ? " .
            " WHERE id = ?";
         try {
            $stmt = $this->db->prepare($sql);
            $stmt->execute(array(
               $curso->getNombre(), $curso->getProfesorId(),
               $curso->getFechaInicio(), $curso->getFechaFin(), $curso->getFechaSol(),
               $curso->getDuracion(), $curso->getDescripcion(), $curso->getCoste(), $curso->getParticipantes()
            ));
            $return["correcto"] = true;
         } catch (\PDOException $e) {
            $return["error"] = "Error al modificar Curso!: " . $this->table . "!: " . $e->getMessage();
         } finally {
            return $return;
         }
      } else {
         $return["error"] = "Error al modificar Curso!: No existe id";
         return $return;
      }
   }

   /**
    * Usuarios matriculados en un curso
    *
    * @param $idCurso id del curso
    *
    * @return array  Array del tipo return usado en el modelo. datos será un array de User
    */
    public function usuarios($idCurso){
      // Para este tipo de métodos las propiedades tabla y clase no son suficientes
      // No tengo más remedio que escribir directamente el nombre de las tablas y de las clases
      $return = ["correcto" => false, "datos" => [], "error" => NULL];
      $sql = "SELECT usuarios.* FROM usuarios JOIN inscripciones " . 
             "WHERE usuarios.id = inscripciones.estudiante_id " .
             "AND inscripciones.curso_id = ? ";
      try {
         $stmt = $this->db->prepare($sql);
         $stmt->execute(array($idCurso));
         $resultSet = $stmt->fetchAll(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, 'User');
         $return["datos"] = $resultSet;
         $return["correcto"] = true;
      } catch (\PDOException $e) {
         $return["error"] = "Error al obtener los usuarios del curso!: " . $this->table . "!: " . $e->getMessage();
      } finally {
         return $return;
      }
    }
}
