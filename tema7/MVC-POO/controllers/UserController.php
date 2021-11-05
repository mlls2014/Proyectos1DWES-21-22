<?php

/**
 * Incluimos los DAOs que necesite este controlador
 */
require_once MODELS_FOLDER . 'UserDAOImpPDO.php';

/**
 * Clase controlador que será la encargada de obtener, para cada tarea, los datos
 * necesarios de la base de datos, y posteriormente, tras su proceso de elaboración,
 * enviarlos a la vista para su visualización
 */
class UserController extends BaseController
{
   // El atributo $dao será a través del que podremos acceder a los datos 
   private $daoUser;
   //$mensajes se utiliza para almacenar los mensajes generados en las tareas, 
   //que serán posteriormente transmitidos a la vista para su visualización
   private $mensajes;

   /**
    * Constructor que crea automáticamente un objeto modelo en el controlador e
    * inicializa los mensajes a vacío
    */
   public function __construct()
   {
      parent::__construct();
      session_start();   // Todos los métodos de este controlador requieren autenticación
      if ((!isset($_SESSION['login'])))  // Si no existe la sesión…
      {
         $this->redirect("index", "login");
      }
      $this->daoUser = new UserDAOImpPDO();
      $this->mensajes = [];
   }

   /**
    * Método que obtiene de la base de datos el listado de usuarios y envía dicha
    * infomación a la vista correspondiente para su visualización
    * Podemos recibir información por GET
    *    altaok = Usuario insertado correctamente
    */
   public function listado()
   {
      // Almacenamos en el array 'parametros[]'los valores que vamos a mostrar en la vista
      $parametros = [
         "datos" => [],
         "mensajes" => []
      ];
      // Realizamos la consulta y almacenamos los resultados en la variable $resultModelo
      $resultModelo = $this->daoUser->getAll();
      // Si la consulta se realizó correctamente transferimos los datos obtenidos
      // de la consulta del modelo ($resultModelo["datos"]) a nuestro array parámetros
      // ($parametros["datos"]), que será el que le pasaremos a la vista para visualizarlos
      if ($resultModelo["correcto"]) :
         $parametros["datos"] = $resultModelo["datos"];
         if (isset($_GET["storeOk"])) {
            $this->mensajes[] = [
               "tipo" => "success",
               "mensaje" => "El usuario se creó correctamente"
            ];
         } else if (isset($_GET["updateOk"])) {
            $this->mensajes[] = [
               "tipo" => "success",
               "mensaje" => "El usuario se modificó correctamente"
            ];
         } else {
            //Definimos el mensaje para el alert de la vista de que todo fue correctamente
            $this->mensajes[] = [
               "tipo" => "success",
               "mensaje" => "El listado se realizó correctamente"
            ];
         }
      else :
         //Definimos el mensaje para el alert de la vista de que se produjeron errores al realizar el listado
         $this->mensajes[] = [
            "tipo" => "danger",
            "mensaje" => "El listado no pudo realizarse correctamente!! :( <br/>({$resultModelo["error"]})"
         ];
      endif;
      //Asignamos al campo 'mensajes' del array de parámetros el valor del atributo 
      //'mensaje', que recoge cómo finalizó la operación:
      $parametros["mensajes"] = $this->mensajes;
      // Incluimos la vista en la que visualizaremos los datos o un mensaje de error
      $this->view->show("ListadoUser", $parametros);
   }

   /**
    * Método de la clase controlador que muestra la vista de adición de usuario
    */
   public function createUser()
   {
      $parametros = [
         "accion" => "Alta de usuario",
         "user" => new User(),
         "mensajes" => []
      ];
      $this->view->show("AltaEdicionUser", $parametros);
   }

   /**
    * Método de la clase controlador que responde al POST de la creación de usuario
    */
   public function storeUser()
   {
      // Si se ha pulsado el botón guardar...
      if (isset($_POST['submit'])) { // y hemos recibido las variables del formulario
         //Saneamos y validamos la información del formulario 
         $user = $this->tratarFormUser();

         // Si no se han producido errores realizamos el alta del usuario
         if (count($this->mensajes) == 0) {
            // $user->setPassword(sha1($user->getPassword())); 
            $resultModelo = $this->daoUser->save($user);
            if ($resultModelo["correcto"]) :
               $this->mensajes["storeOk"] = [
                  "tipo" => "success",
                  "mensaje" => "El usuario creado correctamente!! :)"
               ];
            else :
               $this->mensajes[] = [
                  "tipo" => "danger",
                  "mensaje" => "El usuario no pudo crearse!! :( <br />({$resultModelo["error"]})"
               ];
               $user->setPassword(""); // No quiero que el formulario recuerde la contraseña
            endif;
         }
      }

      if (array_key_exists("storeOk", $this->mensajes)) { //Vamos a la vista de listado de usuarios
         $this->redirect("User", "listado", ["storeOk" => "1"]);  // Si muestro el listado de esta forma hay redirección en la url
         // $this->listado();  // Si muestro el listado de esta forma la url no cambia, sigue en store
      } else { //Volvemos a la vista asociada al alta de usuarios
         $parametros = [
            "accion" => "Alta de usuario",
            "user" => $user,
            "mensajes" => $this->mensajes
         ];
         $this->view->show("AltaEdicionUser", $parametros);
      }
   }

   /**
    * Método de la clase controlador que muestra la vista de modificación de un usuario con id 
    */
   public function editUser()
   {
      if (isset($_GET['id']) && (is_numeric($_GET['id']))) {
         $id = $_GET['id'];
         //Realizamos la operación de suprimir el usuario con el id=$id
         $resultModelo = $this->daoUser->getById($id);
         if ($resultModelo["correcto"] &&  $resultModelo["datos"] != null) :
            $user = $resultModelo["datos"];
            $parametros = [
               "accion" => "Editar usuario",
               "user" => $user,
               "mensajes" => []
            ];
            $this->view->show("AltaEdicionUser", $parametros);
         else :
            $this->mensajes[] = [
               "tipo" => "danger",
               "mensaje" => "No se pudieron obtener los datos de usuario!! :("
            ];
            //Realizamos el listado de los usuarios
            $this->listado();
         endif;
      }
   }

   /**
    * Método de la clase controlador que responde al POST de la modificación de un usuario
    */
   public function updateUser()
   {
      // Si se ha pulsado el botón guardar...
      if (isset($_POST['submit'])) { // y hemos recibido las variables del formulario
         //Saneamos y validamos la información del formulario 
         $user = $this->tratarFormUser();

         // Si no se han producido errores realizamos el alta del usuario
         if (count($this->mensajes) == 0) {
            // $user->setPassword(sha1($user->getPassword())); 
            $resultModelo = $this->daoUser->update($user);
            if ($resultModelo["correcto"]) :
               $this->mensajes["updateOk"] = [
                  "tipo" => "success",
                  "mensaje" => "Usuario modificado correctamente!! :)"
               ];
            else :
               $this->mensajes[] = [
                  "tipo" => "danger",
                  "mensaje" => "El usuario no pudo modificarse!! :("
               ];
               $user->setPassword(""); // No quiero que el formulario recuerde la contraseña
            endif;
         }
      }

      if (array_key_exists("updateOk", $this->mensajes)) { //Vamos a la vista de listado de usuarios
         $this->redirect("User", "listado", ["updateOk" => "1"]);  // Si muestro el listado de esta forma hay redirección en la url
         // $this->listado();  // Si muestro el listado de esta forma la url no cambia, sigue en update
      } else { //Volvemos a la vista asociada al alta de usuarios
         $parametros = [
            "accion" => "Editar usuario",
            "user" => $user,
            "mensajes" => $this->mensajes
         ];
         $this->view->show("AltaEdicionUser", $parametros);
      }
   }

   /**
    * Método de la clase controlador que realiza la eliminación de un usuario a 
    * través del campo id
    */
   public function deleteUser()
   {
      // verificamos que hemos recibido los parámetros desde la vista de listado 
      if (isset($_GET['id']) && (is_numeric($_GET['id']))) {
         $id = $_GET["id"];
         //Realizamos la operación de suprimir el usuario con el id=$id
         $resultModelo = $this->daoUser->deleteById($id);
         //Analizamos el valor devuelto por el modelo para definir el mensaje a mostrar en la vista listado
         if ($resultModelo["correcto"]) :
            $this->mensajes[] = [
               "tipo" => "success",
               "mensaje" => "Se eliminó correctamente el usuario de id $id"
            ];
         else :
            $this->mensajes[] = [
               "tipo" => "danger",
               "mensaje" => "La eliminación del usuario no se realizó correctamente!! :( <br/>({$resultModelo["error"]})"
            ];
         endif;
      } else { //Si no recibimos el valor del parámetro $id generamos el mensaje indicativo:
         $this->mensajes[] = [
            "tipo" => "danger",
            "mensaje" => "No se pudo acceder al id del usuario a eliminar!! :("
         ];
      }
      //Realizamos el listado de los usuarios
      $this->listado();
   }

   /*
   * Función que valida el formulario de usuario, carga la imagen en el servidor si los datos son correctos y devuelve un
   * objeto de tipo User con los datos introducidos en el formulario (sólo saneados pero con posibles errores de valiación)
   */
   private function tratarFormUser()
   {
      $nombre = filter_var($_POST['nombre'], FILTER_SANITIZE_STRING);
      $password = filter_var($_POST['password'], FILTER_SANITIZE_STRING);
      $email = filter_var($_POST['email'], FILTER_SANITIZE_STRING);
      $id = filter_var($_POST['id'], FILTER_SANITIZE_NUMBER_INT);
      $user = new User();
      $user->setNombre($nombre);
      $user->setEmail($email);
      $user->setPassword($password);
      $user->setId($id);

      if (strlen($nombre) < 5) {
         $this->mensajes["nombre"] = [
            "tipo" => "danger",
            "mensaje" => "Error: El nombre debe tener al menos 5 caracteres de longitud"
         ];
      }
      if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
         $this->mensajes["email"] = [
            "tipo" => "danger",
            "mensaje" => "Error: El email no es válido"
         ];
      }
      if (empty($password) || !(preg_match("/^(?=.{3,}$)(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9]).*$/", $password))) {
         $this->mensajes["password"] = [
            "tipo" => "danger",
            "mensaje" => "La contraseña no es válida: Debe tener una longitud mínima de 3 caracteres y contener letras mayúsculas, minúsculas y números"
         ];
      }
      $imagen = NULL;
      // Si no se han producido errores realizamos la carga de la imagen en el servidor
      if (count($this->mensajes) == 0) {
         if (isset($_FILES["imagen"]) && (!empty($_FILES["imagen"]["tmp_name"]))) {
            //Para asegurarnos que el nombre va a ser único...
            $imagen = time() . "-" . $_FILES["imagen"]["name"];
            // Movemos el fichero de la carpeta temportal a la nuestra
            $movfichimg = move_uploaded_file($_FILES["imagen"]["tmp_name"], PHOTOS_FOLDER . $imagen);
            // Verficamos que la carga se ha realizado correctamente
            if (!$movfichimg) {
               $this->mensajes["imagen"] = [
                  "tipo" => "danger",
                  "mensaje" => "Error: La imagen no se cargó correctamente! :("
               ];
            }
         }
      }
      $user->setImagen($imagen);
      return $user;
   }
}
