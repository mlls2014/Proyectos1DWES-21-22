<?php
$ahora= time();
$detallehora= getdate($ahora);
//Convirtió a $detallehoraen una matriz con las diez celdas que acabamos de mencionar
echo "<p>Hora: ".$detallehora["hours"] ."<br />";
echo "Minutos: ".$detallehora["minutes"] ."<br />";
echo "Segundos: ".$detallehora["seconds"] ."</p>";
echo "<p>Día: ".$detallehora["mday"] . "<br />";
echo "Mes: ".$detallehora["mon"] . "<br />";
echo "Año: ".$detallehora["year"] . "</p>";
echo "<p>Día de la semana: ".$detallehora["wday"] . "</p>";
echo "<p>Días desde el principio del año: ".$detallehora["yday"] ."</p>";
echo "<p>Nombre en inglés del día de la semana:". $detallehora["weekday"] . "</p>";
echo "<p>Nombre en inglés del mes del año:" . $detallehora["month"] . "</p>";

setlocale(LC_ALL, 'es_es');

/*
Devuelve una cadena formateada según format empleando el parámetro timestamp 
dado o el instante local actual si no se da una marca temporal. Los nombres del mes 
y del día de la semana y otras cadenas dependientes del lenguaje respetan el localismo
 establecido con setlocale().
*/
echo strftime("%A %d %B %Y", time());