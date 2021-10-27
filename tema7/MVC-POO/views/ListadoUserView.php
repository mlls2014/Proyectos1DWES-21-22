<?php require 'includes/head.php'; ?>
<?php require 'includes/navauth.php'; ?>

<section class="page-section pt-5">
   <div class="container">
      <h2 class="text-center text-uppercase text-secondary mb-2">Listado de Usuarios</h2>
      <!--Mostramos los mensajes que se hayan generado al realizar el listado-->
      <?php foreach ($mensajes as $mensaje) : ?>
         <div class="alert alert-<?= $mensaje["tipo"] ?> alert-dismissible fade show" role="alert">
            <?= $mensaje["mensaje"] ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
         </div>
      <?php endforeach; ?>
      <!--Creamos la tabla que utilizaremos para el listado:-->
      <table class="table table-striped text-center">
         <tr>
            <th>Nombre</th>
            <!-- <th>Contraseña</th>-->
            <th>Email</th>
            <th>Foto</th>
            <!-- Añadimos una columna para las operaciones que podremos realizar con cada registro -->
            <th>Operaciones</th>
         </tr>
         <!--Los datos a listar están almacenados en $parametros["datos"], que lo recibimos del controlador-->
         <?php foreach ($datos as $user) : ?>
            <!--Mostramos cada registro en una fila de la tabla-->
            <tr>
               <td><?= $user->getNombre() ?></td>
               <td><?= $user->getEmail() ?></td>
               <?php if ($user->getImage() !== NULL) : ?>
                  <td><img src="fotos/<?= $user->getImage() ?>" width="40" /></td>
               <?php else : ?>
                  <td>----</td>
               <?php endif; ?>
               <!-- Enviamos a actuser.php, mediante GET, el id del registro que deseamos editar o eliminar: -->
               <td><a href="?controller=user&action=actuser&id=<?= $user->getId() ?>">Editar </a><a href="?controller=user&action=deluser&id=<?= $user->getId() ?>">Eliminar</a></td>
            </tr>
         <?php endforeach; ?>
      </table>

   </div>
</section>

<?php require 'includes/footer.php'; ?>