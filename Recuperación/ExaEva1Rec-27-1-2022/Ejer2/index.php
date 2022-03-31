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

session_start();
$operacion = recoge("operacion");
if(!isset($_SESSION['aciertos']) || $operacion == 'r'){
    $_SESSION['aciertos'] = 0;
    $_SESSION['fallos'] = 0;
}

if(!in_array($operacion, ['+','-','*'])){
   $operacion='+';
}

if(isset($_POST['comprobar'])){
   $resultado = recoge('resultado');
   if($resultado == $_SESSION['resultado']){
      $acierto = true;
      $_SESSION['aciertos']++;
   }else{
      $acierto = false;
      $_SESSION['fallos']++;
   }
   require("vista_res.php");
}else{
   $_SESSION['op1'] = rand(0,99);
   $_SESSION['op2'] = rand(1,10);
   $_SESSION['op'] = $operacion;
   $_SESSION['resultado'] = eval("return {$_SESSION['op1']} {$_SESSION['op']} {$_SESSION['op2']};");
   require("vista_form.php");
}

