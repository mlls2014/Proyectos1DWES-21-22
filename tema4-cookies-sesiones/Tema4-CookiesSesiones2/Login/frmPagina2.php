<?php
/*
Otra página de nuestro portal que también exige que estemos logueados de forma correcta. Esto lo comprobamos 
con isset($_SESSION['logueado'])
*/
  session_start();
  if(!isset($_SESSION['logueado'])){
     header ("Location: frmLogin.php?error=fuera");
  }
?>
<html>
  <head lang="es">
    <?php require 'includes/header.php'; ?>
  </head>
  <body>
    <?php require 'includes/pagina2.php'; ?>
    <?php require 'includes/footer.php'; ?>
  </body>
</html>