<?php
for($i=0;$i< 10; $i++){
   if($i == 5) continue;
   // En la iteración 5 se salta a la siguiente iteración
   if($i == 8)break;
   // En la iteración 8 queremos que termine el bucle
   echo "Iteración número: $i <br>"; // Código a ejecutar
}
echo"El bucle ha terminado.";
   