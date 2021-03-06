
<?php require 'includes/head.php'; ?>
<?php require 'includes/navguest.php'; ?>
<section class="page-section pt-5">
   <div class="container text-center">
      <h2 class="page-section-heading text-center text-uppercase text-secondary mb-0">Inicio del sitio sin autenticar</h2>
      <!-- Icon Divider-->
      <div class="divider-custom">
         <div class="divider-custom-line"></div>
         <div class="divider-custom-icon"><i class="fas fa-star"></i></div>
         <div class="divider-custom-line"></div>
      </div>
      <h5 class="text-center text-uppercase text-secondary mb-2"><a class="btn btn-secondary" href="?controller=index&action=testCursoDAO">Test CursoDAO</a></h5>
      <h5 class="text-center text-uppercase text-secondary mb-2"><a class="btn btn-secondary" href="?controller=index&action=testCursosConProfesor">Test CursoConProfesor</a></h5>
   </div>
</section>
<?php require 'includes/footer.php'; ?>