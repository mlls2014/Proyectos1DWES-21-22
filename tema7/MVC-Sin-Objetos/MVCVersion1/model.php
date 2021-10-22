<?php
   $user = 'root';
   $pwd = '';
   $db = new PDO('mysql:host=localhost;dbname=uazon', $user, $pwd);
   $result = $db->query('SELECT titulo, precio FROM libros');
   $libros = array();
   while ($libro = $result->fetch())
      $libros[] = $libro;