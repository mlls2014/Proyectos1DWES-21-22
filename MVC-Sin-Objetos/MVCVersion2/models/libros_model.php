<?php
function getConnection()
{
   $user = 'root';
   $pwd = '';
   return new PDO('mysql:host=localhost;dbname=uazon', $user, $pwd);
}

function getLibros()
{
   $db = getConnection();
   $result = $db->query('SELECT titulo, precio FROM libros');
   $libros = array();
   while ($libro = $result->fetch())
      $libros[] = $libro;

   return $libros;
}

function getLibro($id)
{
   $db = getConnection();
   $query = 'SELECT * FROM libros WHERE id = ?';
   $stmt = $db->prepare($query);
   $stmt->execute(array($id));
   $libro = $stmt->fetch();
   return $libro;
}
