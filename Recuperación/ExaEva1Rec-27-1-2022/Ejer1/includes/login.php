<div class="encabezado text-center">
  <h1><img class="alineadoTextoImagen" src="images//bombilla.png" />Ejercicio 1. Examen 27/1/2022</h1>
</div>
<div class="centrar">
  <!-- <div class="container cuerpo text-center">	
    <p><h2><img class="alineadoTextoImagen" src="images//user.png" width="50px"/> Login de usuario:</h2></p>
  </div> -->
  <h1>Login de usuario: MLLS</h1>
  <div class="container">
    <form action="index.php" method="POST">
      <label for="name">Usuario:
        <input type="text" name="usuario" class="form-control" value="<?= $usuario; ?>" />
      </label>
      <br />
      <label for="password">Contraseña:
        <input type="password" name="password" class="form-control" value="<?= $password; ?>" />
      </label>
      <br />


      <?php
      foreach ($errores as $valor) {
        print("<p style='color:red;'>$valor </p>");
      }
      ?>
      <input type="submit" value="Enviar" name="submit" class="btn btn-success" />
    </form>
  </div>
</div>