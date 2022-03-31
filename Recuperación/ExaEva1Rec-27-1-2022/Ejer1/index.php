<?php

require_once("includes/funciones.php");
session_start();   //Activamos el uso de sesiones
/*
Página de login a la aplicación de login. Es la que se debe utilizar como punto de entrada a nuestro portal
*/
$usuario = "";
$password = "";
$errores = [];

if (isset($_POST['submit'])) {
  // Comprobamos que recibimos los datos y que no están vacíos
  $usuario = recoge('usuario');
  $password = recoge('password');
  $errores = valida_usuario($usuario, $password);
  if (count($errores) == 0) {
    // Hay que ver si el usuario ya hizo algún login antes para incrementar contador
    if (isset($_SESSION['usuario'])) {
      $ind = array_search($usuario, $_SESSION['usuario']);
    } else {
      $ind = false; // si $ind es 0 sería el primer elemento del array, por eso hay que usar el !==
    }

    if ($ind !== false) {
      // Sólo recordamos la última contraseña válida del usuario
      $_SESSION['password'][$ind] = $password;
      $_SESSION['contador'][$ind]++;
    } else {
      $_SESSION['usuario'][] = $usuario;
      $_SESSION['password'][] = $password;
      $_SESSION['contador'][] = 1;
    }
    //Redirigimos a la página resumen
    header("Location: vistaResumen.php");
  } else {
    // Hubo errores en la validación, mostramos el login con memoria e información de los errores
    require('vistaLogin.php');
  }
} else {
  require('vistaLogin.php');
}
