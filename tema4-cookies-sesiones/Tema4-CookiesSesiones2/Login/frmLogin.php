<?php
/*
Página de login a la aplicación de login. Es la que se debe utilizar como punto de entrada a nuestro portal
*/
$usuariook = "pepe";
$passok = "123";

// Nos aseguramos de que se han tecleado usuario y contraseña y además que no son vacíos
if ((isset($_POST['usuario']) && isset($_POST['password']))
   && (!empty($_POST['usuario']) && !empty($_POST['password']))
) {
   // Autenticación correcta
   if ($_POST['usuario'] == $usuariook && $_POST['password'] == $passok) {
      // Comienzo sesión y guardo los datos del usuario autenticado
      session_start();
      $_SESSION['logueado'] = 1;
      $_SESSION['usuario'] = $_POST['usuario'];
      // Salto a la página inicial de mi portal
      header("Location: frminicio.php");
   } else { // Autenticación no correcta
      header("Location: frmLogin.php?error=datos");
   }
}
?>
<html>

<head lang="es">
   <?php require 'includes/header.php'; ?>
</head>

<body>
   <?php require 'includes/login.php'; ?>
   <?php require 'includes/footer.php'; ?>
</body>

</html>