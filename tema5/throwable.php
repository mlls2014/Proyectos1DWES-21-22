<?php
function inverso($x)
{
   return 1 / $x;
}

try {
   echo inverso(5) . "<br />";
   echo inverso(0) . "<br />";
   echo inverso(8) . "<br />";
} catch (Throwable $e) {
   echo 'Excepción capturada: ',  $e->getMessage(), "<br />";
}

// Continuar la ejecución
echo 'Hola Mundo';