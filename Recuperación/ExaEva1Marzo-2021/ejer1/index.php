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

function validar_info_sensor($controles, &$errores)
{
   if (!preg_match('/^[[:alpha:]]+$/', $controles['ciudad'])) {
      $errores[] = "¡Debe introducir una ciudad con caracteres solo alfabéticos!";
   }

   if (trim($controles['direccion']) == "") {
      $errores[] = "¡Debe introducir una dirección!";
   }

   if (count($controles['unidades'])==0) {
      $errores[] = "¡Debe seleccionar al menos una unidad!";
   }

   if (!preg_match('/^[0-9]{2} del [0-9]{2} de [0-9]{4}$/', trim($controles['fecha']))) {
      $errores[] = "¡Formato de fecha incorrecto!";
   }

   if (count($errores) > 0) return false;
   else return true;
}

function mostrar_datos($controles)
{
   print("<h1>Información del sensor</h1>\n");
   //Pendiente
   print("<p>Estos son los datos introducidos:</p>\n");
   print("<ul>\n");
   print("<li>Ciudad: {$controles['ciudad']}</li>\n");
   print("<li>Dirección: {$controles['direccion']}</li>\n");
   print("<li>Estado del sensor: {$controles['estado']}</li>\n");
   echo "<li>Unidades: ";
   echo in_array('c', $controles['unidades']) ? 'Celsius ' : ' ';
   echo in_array('f', $controles['unidades']) ? 'Fharenheit ' : ' ';
   echo in_array('k', $controles['unidades']) ? 'Kelvin ' : ' ';
   echo "</li>";
   print("<li>Mediciones: ");
   if ($controles['mediciones'] == '0') {
      echo "1 a 10 ";
   } elseif ($controles['mediciones'] == '1') {
      echo "11 a 100 ";
   } else {
      echo "Más de 100 ";
   }

   echo "</li>\n";
   print("<li>Fecha: {$controles['fecha']}</li>\n");
   print("</ul>\n");
   echo "<p>Número de mediciones correctas: " . ++$_SESSION['cont'] . "</p>";

   echo "<p><a href='" . $_SERVER['PHP_SELF'] . "'>Volver a introducir datos</a></p>";

   echo "<p><a href='" . $_SERVER['PHP_SELF'] . "?reiniciar=si'>Reiniciar contador mediciones</a></p>";

}

// Para controlar el número de sesiones
session_start();
if (!isset($_SESSION['cont']) || (isset($_GET['reiniciar']) && $_GET['reiniciar']='si')){
   $_SESSION['cont']=0;
}


$validado = true;
$errores = [];
$datos['ciudad'] = "";
$datos['direccion'] = "";
$datos['estado'] = "Activo";
$datos['unidades'] = [];
$datos['mediciones'] = "";
$datos['fecha'] = "";

if (isset($_POST['enviar'])) {
   // recoger info
   $datos['ciudad'] = recoge('ciudad');
   $datos['direccion'] = recoge('direccion');;
   $datos['estado'] = recoge('estado');;
   $datos['unidades'] = recoge('unidades',[]);;
   $datos['mediciones'] = recoge('mediciones',[]);;
   $datos['fecha'] = recoge('fecha');
   $validado = validar_info_sensor($datos, $errores);
 
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