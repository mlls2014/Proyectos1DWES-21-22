<?php require 'includes/head.php'; ?>
<?php require 'includes/navauth.php'; ?>

<section class="page-section pt-5">
   <div class="container">
      <h2 class="text-center text-uppercase text-secondary mb-2">Listado de Usuarios</h2>
      <!--Mostramos los mensajes que necesito mostrar antes del listado-->
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
               <?php if ($user->getImagen() !== NULL) : ?>
                  <td><img src="<?= PHOTOS_FOLDER . $user->getImagen() ?>" width="40" /></td>
               <?php else : ?>
                  <td>----</td>
               <?php endif; ?>
               <!-- Enviamos a actuser.php, mediante GET, el id del registro que deseamos editar o eliminar: -->
               <td><a href="?controller=user&action=editUser&id=<?= $user->getId() ?>"><i class="far fa-edit"></i></a>
                  <a data-bs-toggle='modal' data-bs-target='#deleteModal' data-bs-id='<?= $user->getId() ?>' href="?controller=user&action=deleteUser&id="><i class="far fa-trash-alt"></i></a>
               </td>
            </tr>
         <?php endforeach; ?>
      </table>
      <h5 class="text-center text-uppercase text-secondary mb-2"><a class="btn btn-secondary" href="?controller=user&action=createUser">Añadir Usuario</a></h5>
   </div>

</section>

<!-- Modal para confirmar la eliminación de un usuario-->
<div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
   <div class="modal-dialog">
      <div class="modal-content">
         <div class="modal-header">
            <h5 class="modal-title">Confirmación</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
         </div>
         <div class="modal-body">
            ¿Está seguro de que desea eliminar el elemento seleccionado?
         </div>
         <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No</button>
            <a id="deleteLink" data-bs-href="?controller=user&action=deleteUser&id=" class="btn btn-danger" href="">Sí</a>
         </div>
      </div>
   </div>
</div>

<script>
   var deleteModal = document.getElementById('deleteModal')
   deleteModal.addEventListener('show.bs.modal', function(event) {
      var link = event.relatedTarget  // Obtenemos el enlace que lanzó el modal
      var id = link.getAttribute('data-bs-id') // Del enlace tomamos el atributo data-bs-id que contendrá el id del usuario que queremos borrar
      var deleteLink = deleteModal.querySelector('#deleteLink') // Obtenemos el botón "Sí" del modal de confirmación
      href = deleteLink.getAttribute("data-bs-href");  // Tomamos el atributo data-bs-href que contiene la plantilla del enlace de borrado. Es necesario para que a href no se le vayan concatenando id en cada intento de borrado
      deleteLink.setAttribute("href", href + id); // Para el botón "Sí", completamos el href con la id del usuario a eliminar

   })
</script>

<?php require 'includes/footer.php'; ?>