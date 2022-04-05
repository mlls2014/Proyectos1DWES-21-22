<?php

// Para recoger de forma saneada los datos de los formularios
// Se explica bien en https://www.mclibre.org/consultar/php/lecciones/php-recogida-datos.html
function recoge($var, $m = "")
{
   if (!isset($_REQUEST[$var])) {
      $tmp = (is_array($m)) ? [] : "";
   } elseif (!is_array($_REQUEST[$var])) {
      $tmp = trim(htmlspecialchars($_REQUEST[$var], ENT_QUOTES, "UTF-8"));
   } else {
      $tmp = $_REQUEST[$var];
      array_walk_recursive($tmp, function (&$valor) {
         $valor = trim(htmlspecialchars($valor, ENT_QUOTES, "UTF-8"));
      });
   }
   return $tmp;
}

function validar_info_cita($controles, &$errores)
{
   if ($controles['nombre'] == "") {
      $errores[] = "¡Debe introducir un nombre!";
   }

   if ($controles['dni'] == "") {
      $errores[] = "¡Debe introducir un dni!";
   }

   if (!preg_match('/^[0-9]{9}[A-Za-z]$/', $controles['dni'])) {
      $errores[] = "¡Debe introducir un dni válido!";
   }

  //.............continuar
   

  

   if (count($errores) > 0) return false;
   else return true;
}

function mostrar_datos($controles)
{
   print("<h1>Información de la cita</h1>\n");
   //Pendiente
   print("<p>Estos son los datos introducidos:</p>\n");
   print("<ul>\n");
   print("<li>Nombre: {$controles['nombre']}</li>\n");
   print("<li>Apellido: {$controles['apellidos']}</li>\n");
   print("<li>DNI: {$controles['dni']}</li>\n");
   print("<li>Fecha: {$controles['fecha']}</li>\n");
   print("<li>Urgente: {$controles['urgente']}</li>\n");
   print("<li>Especialidad: {$controles['especialidad']}</li>\n");
   
   echo "</li>\n";
      
   echo "<p><a href='" . $_SERVER['PHP_SELF'] . "'>Volver a introducir datos</a></p>";

}

$validado = true;
$errores = [];
$datos['nombre'] = "";
$datos['apellidos'] = "";
$datos['dni'] = "";
$datos['urgente'] = "";
$datos['especialidad'] = "";
$datos['fecha'] = "";

if (isset($_POST['enviar'])) {
   // recoger info
   $datos['nombre'] = recoge('nombre');
   $datos['apellidos'] = recoge('apellidos');;
   $datos['dni'] = recoge('dni');;
   $datos['urgente'] = recoge('urgente');;
   $datos['especialidad'] = recoge('especialidad');;
   $datos['fecha'] = recoge('fecha');
   $validado = validar_info_cita($datos, $errores);
 
   if ($validado) {
      mostrar_datos($datos);
   } else {
      //Muestro los errores si los hubo. Si no los hubo $errores será un array vacío.
      require("vista.php");
      foreach ($errores as $valor) {
         print("$valor <br>");
      }
   }
} else {
   require("vista.php");
}

?>
</body>

</html>