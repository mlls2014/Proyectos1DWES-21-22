<?php
/*
Página de inicio a nuestro portal, una vez hemos logueado correctamente. Esto lo comprobamos 
con isset($_SESSION['login'])
*/
  session_start();   //Activamos el uso de sesiones
  if((!isset($_SESSION['login'])))  // Si no existe la sesión…
    { //Redirigimos a la página de login con el tipo de error ‘fuera’: que indica que
      // se trató de acceder directamente a una página sin loguearse previamente
      header ("Location: index.php?controller=index&action=login");  
    }
?>
<?php require 'includes/head.php'; ?>
<?php require 'includes/navauth.php'; ?>
<section class="page-section pt-5">
   <div class="container text-center">
      <h2 class="page-section-heading text-center text-uppercase text-secondary mb-0"><?= $tituloventana ?></h2>
      
         <a href="?controller=user&action=listado"> Listar usuarios</a>
         <a href="?controller=user&action=adduser"> Añadir usuario</a>
         <a href="?controller=index&action=index"> Salir de la aplicación</a>
     
   </div>
</section>
<?php require 'includes/footer.php'; ?>