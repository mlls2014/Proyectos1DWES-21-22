<?php
/*Guardar elemento complejo como cookie
Lo ideal es convertir en cadena de texto el elemento complejo con la función json_encode
Y para recuperar el elemento utilizar json_decode
Estas funciones se utilizan en muchos otros tipos de problemas
*/
if (!isset($_COOKIE['cards'])) {
   //Establecemos la cookie
   $cardArray = [
      'CARD 1' => ['FRONT I', 'BACK I'],
      'CARD 2' => ['FRONT 2', 'BACK 2']
   ];

   //Convierto el array en una cadena json
   $json = json_encode($cardArray);
   setcookie('cards', $json);
} else {
   $cookie = $_COOKIE['cards'];
   // $cookie = stripslashes($cookie); // setcookie incluye \ antes de las comillas y tenemos que quitarlos para que no falle json_decode
   $savedCardArray = json_decode($cookie, true);
   //Para mostrar la matriz correctamente
   echo '<pre>';
   print_r($savedCardArray);
   echo '</pre>';
}
