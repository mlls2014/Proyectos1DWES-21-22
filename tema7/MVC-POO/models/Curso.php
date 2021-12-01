<?php

/**
 *   Modelo de 'Curso'. Implementa el modelo de cursos de nuestra aplicación en una
 *   arquitectura MVC. Define un objeto de tipo Curso
 */
class Curso
{

   /**
    * id  campo id del curso
    *
    * @var int
    */
   private $id;
   private $nombre;
   private $profesor_id;
   private $fecha_inicio;
   private $fecha_fin;
   private $fecha_sol;
   private $duracion;
   private $descripcion;
   private $coste;
   private $participantes;  // Número máximo de participantes en el curso
   private $profesor;  // Objeto de tipo User correspondiente al profesor que imparte el curso

   public function __construct($nombre = "", $fecha_inicio = "2021-11-11")
   {
      $this->nombre = $nombre;
      $this->fecha_inicio = $fecha_inicio;
      $this->profesor = null;
   }

   public function getProfesor()
   {
      return $this->profesor;
   }

   public function setProfesor($profesor)
   {
      $this->profesor = $profesor;
   }

   public function getId()
   {
      return $this->id;
   }

   public function setId($id)
   {
      $this->id = $id;
   }

   public function getNombre()
   {
      return $this->nombre;
   }

   public function setNombre($nombre)
   {
      $this->nombre = $nombre;
   }

   /**
    * Get the value of profesor_id
    */
   public function getProfesorId()
   {
      return $this->profesor_id;
   }

   /**
    * Set the value of profesor_id
    *
    */
   public function setProfesorId($profesor_id)
   {
      $this->profesor_id = $profesor_id;
   }

   /**
    * Get the value of fecha_inicio
    */
   public function getFechaInicio()
   {
      return $this->fecha_inicio;
   }

   /**
    * Set the value of fecha_inicio
    *
    */
   public function setFechaInicio($fecha_inicio)
   {
      $this->fecha_inicio = $fecha_inicio;
   }

   /**
    * Get the value of fecha_fin
    */
   public function getFechaFin()
   {
      return $this->fecha_fin;
   }

   /**
    * Set the value of fecha_fin
    *
    */
   public function setFechaFin($fecha_fin)
   {
      $this->fecha_fin = $fecha_fin;
   }

   /**
    * Get the value of fecha_sol
    */
   public function getFechaSol()
   {
      return $this->fecha_sol;
   }

   /**
    * Set the value of fecha_sol
    *
    */
   public function setFechaSol($fecha_sol)
   {
      $this->fecha_sol = $fecha_sol;
   }

   /**
    * Get the value of duracion
    */
   public function getDuracion()
   {
      return $this->duracion;
   }

   /**
    * Set the value of duracion
    *
    */
   public function setDuracion($duracion)
   {
      $this->duracion = $duracion;
   }

   /**
    * Get the value of descripcion
    */
   public function getDescripcion()
   {
      return $this->descripcion;
   }

   /**
    * Set the value of descripcion
    *
    */
   public function setDescripcion($descripcion)
   {
      $this->descripcion = $descripcion;
   }

   /**
    * Get the value of coste
    */
   public function getCoste()
   {
      return $this->coste;
   }

   /**
    * Set the value of coste
    *
    */
   public function setCoste($coste)
   {
      $this->coste = $coste;
   }

   /**
    * Get the value of participantes
    */
   public function getParticipantes()
   {
      return $this->participantes;
   }

   /**
    * Set the value of participantes
    *
    */
   public function setParticipantes($participantes)
   {
      $this->participantes = $participantes;
   }

   public function __toString()
   {
      // Para mostrar la fecha en el formato dia-mes-año ya que
      // de MySQL siempre obtengo la fecha como cadena 'Y-m-d'
      $fechaInicio = DateTime::createFromFormat('Y-m-d', $this->fecha_inicio);
      return $this->id . ": " . $this->nombre . " " . $fechaInicio->format('d-m-Y');;
   }
}
