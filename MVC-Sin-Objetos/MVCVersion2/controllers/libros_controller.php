<?php
function listar()
{
   //Incluye el modelo que corresponde
   require 'models/libros_model.php';
   //Le pide al modelo todos los libros
   $libros = getLibros();
   //Pasa a la vista toda la información que se desea representar
   //Estamos dando por sentado que la vista va a trabajar con $libros
   include 'views/libros_listar.php';
}

function ver()
{
   if (!isset($_GET['id']))
      die("No has especificado un identificador de libro.");
   $id = $_GET['id'];
   //Incluimos el modelo correspondiente
   require 'models/libros_model.php';
   //Le pide al modelo el libro con id = $id
   $libro = getLibro($id);
   if ($libro === null)
      die("Identificador de libro incorrecto");
   //Pasamos a la vista toda la información que se desea representar
   //Estamos dando por sentado que la vista va a trabajar con $libro
   include('views/libros_ver.php');
}
