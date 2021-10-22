<html>
<!--
Ejemplo de sitio muy simple pero que mezcla las capas de modelo y vista (en este caso prácticamente no existe el controlador)
-->
<head>
   <title>LIBRERIA UAZON</title>
</head>

<body>
   <h1>Libros dados de alta en nuestra libreria</h1>
   <table border="1">
      <tr>
         <th>TITULO</th>
         <th>PRECIO</th>
      </tr>
      <?php
      $user = 'root';
      $password = '';
      $db = new PDO('mysql:host=localhost;dbname=uazon', $user, $password);
      $result = $db->query('SELECT titulo, precio FROM libros');
      while ($libro = $result->fetch()) {
      ?>
         <tr>
            <td><?php echo $libro['titulo'] ?></td>
            <td><?php echo number_format($libro['precio'], 2) ?></td>
         </tr>
      <?php
      }
      ?>
   </table>
</body>

</html>