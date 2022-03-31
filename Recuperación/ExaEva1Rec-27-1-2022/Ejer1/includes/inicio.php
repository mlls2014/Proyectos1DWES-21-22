<div class="encabezado text-center">
  <h1><img class="alineadoTextoImagen" src="images//bombilla.png" />DAWES-Práctica#2:Sesiones y Cookies</h1>
</div>
<nav class="navbar navbar-toggleable-md navbar-light bg-faded">
  <a class="navbar-brand" href="index.php">Ir a login</a>
  <a class="navbar-brand" href="includes/logout.php">Cerrar sesión</a>
</nav>
<div class="centrar">
  <div class="container cuerpo text-center">
    <h1><strong>MiSitio-</strong>Resumen de logins</h1>
    <div>
      <?php
      echo "<table class='table table-striped'>";
      echo "<tr><th>Usuario</th><th>Password</th><th>Logins</th></tr>";
      foreach ($_SESSION['usuario'] as $key => $login) {

        print "<tr><td>" . $login . ' </td><td> ' . $_SESSION['password'][$key] . ' </td><td> ' 
        . $_SESSION['contador'][$key]  . "</td></tr>";
      }
      echo "</table>";

      ?>
    </div>
  </div>
</div>