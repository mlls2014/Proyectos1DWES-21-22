<?php
try {
   $db = new PDO('mysql:host=127.0.0.1;dbname=tema6', 'root', '');
   $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
   echo "La conexión se realizó correctamente!! :)";
} catch (Exception $e) {
   echo 'Error : ' .  $e->GetMessage();
} finally {
   echo "<br>";
}      

$edad=29;
// Datos FETCH_ASSOC 
$stmt = $db->prepare("SELECT * FROM clientes WHERE edad > :edad");
// Especificamos el fetch mode antes de llamar a fetch() 
// $stmt->setFetchMode(PDO::FETCH_ASSOC);
$stmt->bindParam(":edad", $edad);
// Ejecutamos la sentencia
$stmt->execute();
// Mostramos los resultados 
while ($row = $stmt->fetch()) {
   echo "Nombre: {$row[1]} <br>";
   echo "Ciudad: {$row[7]} <br>";
}

$edad=15;
$stmt->execute();
// Mostramos los resultados 
while ($row = $stmt->fetch()) {
   echo "Nombre: {$row["nombre"]} <br>";
   echo "Ciudad: {$row["ciudad"]} <br>";
}

