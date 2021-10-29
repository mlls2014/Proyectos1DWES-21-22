<?php require 'includes/head.php'; ?>
<?php require 'includes/navauth.php'; ?>

<section class="page-section pt-3">
   <div class="container col-lg-8 col-xl-7">
      <h2 class="text-center text-uppercase text-secondary mb-2"><img src="assets/images/user.png" width="50px" /> Añadir Usuarios</h2>
      <!--Mostramos los mensajes que se hayan generado al realizar el listado-->
      <?php foreach ($mensajes as $mensaje) : ?>
         <div class="alert alert-<?= $mensaje["tipo"] ?> alert-dismissible fade show" role="alert">
            <?= $mensaje["mensaje"] ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
         </div>
      <?php endforeach; ?>
      <form action="?controller=user&action=storeUser" method="POST" enctype="multipart/form-data">
         <!-- Nombre input-->
         <div class="form-floating mb-2">
            <input class="form-control" id="nombre" name="nombre" type="text" value="<?= $datos["nombre"] ?>"/>
            <label for="name">Nombre</label>       
         </div>
         <!-- Email input-->
         <div class="form-floating mb-2">
            <input class="form-control" id="email" name="email" type="text" value="<?= $datos["email"] ?>"/>
            <label for="name">eMail</label>          
         </div>
         <!-- Password-->
         <div class="form-floating mb-2">
            <input class="form-control" id="password" name="password" type="password" />
            <label for="email">Password</label>
         </div>
         <!-- Imagen-->
         <div class="form-floating mb-2">
            <input class="form-control" id="imagen" name="imagen" type="file" value="<?= $datos["imagen"] ?>" />
            <label for="imagen">Imagen</label>
         </div>
         <!-- Submit Button-->
         <button class="btn btn-primary btn-xl mt-3 mb-2" id="submitButton" name="submit" type="submit">Guardar</button>
      </form>
   </div>
</section>

<?php require 'includes/footer.php'; ?>