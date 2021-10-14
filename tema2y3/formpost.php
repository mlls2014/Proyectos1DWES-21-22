<html>

<body>
   <form action="formpost.php" method="get">
      Nombre: <input type="text" name="nombre"><br />
      Email: <input type="text" name="email"><br />
      <input type="submit" value="Enviar">
   </form>

   Hola <?php echo isset($_GET["nombre"]) ? $_GET["nombre"] : ""; ?> <br />
   Tu email es: <?php echo isset($_REQUEST["email"]) ? $_GET["email"] : ""; ?>
</body>

</html>