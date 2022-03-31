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

function valida_usuario($usuario, $password)
{
   $errores=[];

   if(!preg_match('/^[A-ZÑ][\w-]{3,}$/', $usuario, $matches, PREG_OFFSET_CAPTURE, 0)){
      $errores[] = "El usuario debe empezar por letra Mayúscula, tener al menos 4 caracteres  y que sólo sean alfanuméricos o el guión.";
   }

   if(!preg_match('/^(?=.*(MLLS|mlls))(?=.*[0-9])(?=.*\W).*$/', $password, $matches, PREG_OFFSET_CAPTURE, 0)){
      $errores[] = "La contraseña debe contener tus iniciales, al menos un carácter numérico y al menos un carácter especial";
   }

   return $errores;
}


?>