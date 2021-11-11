<?php

/**
 * CursoDAO
 * Interfaz que contiene los métodos propios para manejar los datos de cursos en nuestra app
 * Contiene también los métodos de BaseDAO
 */

require_once MODELS_FOLDER . 'Curso.php';

interface CursoDAO extends BaseDAO{
      
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
   public function save(Curso $curso);
      
   public function update(Curso $curso);

      
   /**
    * Usuarios matriculados en un curso
    *
    * @param $idCurso id del curso
    *
    * @return void
    */
   public function usuarios($idCurso);
}