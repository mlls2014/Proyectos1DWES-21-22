<?php
$host = "localhost";
$db = "pruebadao";
$usuario = "root";
$password = "";
try {
   $conex = new PDO("mysql:host=$host;dbname=$db", $usuario, $password);
   $conex->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
   $sql = 'CALL seleccionar_persona(:id)'; // Utilizando consultas preparadas
   $resultado = $conex->prepare($sql);
   $idsel = 12;
   $resultado->bindparam(':id',$idsel,PDO::PARAM_INT);
   $resultado->execute(); // Utilizando directamente query()
   $resultado->setFetchMode(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
   die("Error al consultar :( !!:" .  $e->getMessage());
}
while ($r = $resultado->fetch()) {
   echo "Nombre : "  .  $r['nombre'];
   echo "Apellidos: "  .  $r['apellidos'];
   echo "Edad          : "  . $r['edad'];
}