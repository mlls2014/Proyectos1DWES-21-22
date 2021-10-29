<?php
$host = "localhost";
$db = "tema6";
$usuario = "root";
$password = "";
try {
   $conex = new PDO("mysql:host=$host;dbname=$db", $usuario, $password);
   $conex->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
   $sql = 'CALL crear_persona()'; // Utilizando consultas preparadas
   $resultado = $conex->prepare($sql);
   $resultado->execute(); // Utilizando directamente query()

   $resultado = $conex->query($sql);
   $resultado->setFetchMode(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
   die("Error al crear la persona :( !!:" .  $e->getMessage());
}
$sql = "SELECT * FROM clientes";
$resultado = $conex->query($sql);
while ($r = $resultado->fetch()) {
   echo "Nombre : "  .  $r['nombre'];
   echo "Apellidos: "  .  $r['apellidos'];
   echo "Edad          : "  . $r['edad'] ."<br>";
}
