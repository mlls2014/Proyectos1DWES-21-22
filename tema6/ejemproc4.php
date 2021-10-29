<?php
$host = "localhost";
$db = "pruebadao";
$usuario = "root";
$password = "";
try {
   $conex = new PDO("mysql:host=$host;dbname=$db", $usuario, $password);
   $conex->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
   $sql = 'CALL obtener_persona(:idSel,@nombreSel)'; 
   $idsel=13;
   $resultado = $conex->prepare($sql);
   $resultado= $conex->prepare($sql);
   $resultado->bindparam(':idSel', $idsel,PDO::PARAM_INT);

   $resultado->execute();
   // Recuperamos el valor del parámetro de salida
   $resultado->closeCursor(); //Permite limpiar y ejecutar la segunda query

   $result= $conex->query('SELECT @nombreSel AS nombreSel');
   $nombreSel= $result->fetchColumn();
   echo "Nombre de la persona con Id " . $idsel . ":" .  $nombreSel;
} catch (PDOException $e) {
   die("Error al consultar :( !!:" .  $e->getMessage());
}