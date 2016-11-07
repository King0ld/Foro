<?php

if (!empty($_POST['user']) and !empty($_POST['pass'])) {
  $db = new Conexion();
  $data = $db->real_escape_string($_POST['user']);
  $data = strtolower($data);
  $pass = Encrypt($_POST['pass']);
  $sql = $db->query("SELECT id FROM users WHERE (user='$data' OR email='$data') AND pass='$pass' LIMIT 1;");
  if ($db->rows($sql) > 0) {
    /*Estamos indicando que si la variable sesion osea el recuerdame es true se creara
    una cookie*/
    if($_POST['sesion']) {
      ini_set('session.cookie_lifetime', time() + 60*60*24);
    }
    /*Ahorramos codigo diciendo que la funcion recorrer sera un arreglo y nos devolvera el id*/
    $_SESSION['app_id'] = $db->recorrer($sql)[0];
    //Esta variable se le pone un time reducido con 6 minutos para que cuando el usuario entre en el sistema
    //aparezca como online porque en la condicion de OnlineUsers la condicion solo es true cuando el tiempo actual
    //es mayor a la variable $_SESSION['time_online'] y asi pueda ejectuarse la condicion.
    $_SESSION['time_online'] = time() - (60*6);
    echo 1;
  }else{
    echo '<div class="alert alert-dismissible alert-danger">
          <button type="button" class="close" data-dismiss="alert">&times;</button>
          <strong>ERROR:</strong> Usuario/email o contraseña incorrectos, intente de nuevo...
          </div>';
  }
  /*Hay que limpiar la query para que asi el programa funcione mas fluido*/
  $db->liberar($sql);
  /*Cerramos la conexion para liberar memoria ram asi como liberar($sql)*/
  $db->close();
}else{
  echo '<div class="alert alert-dismissible alert-danger">
        <button type="button" class="close" data-dismiss="alert">&times;</button>
        <strong>ERROR:</strong> Todos los campos deben estar completos.
        </div>';
}


?>
