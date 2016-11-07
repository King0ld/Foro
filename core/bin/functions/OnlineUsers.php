<?php
//Esta funcion refresca el tiempo activo del usuario cada 5 minutos
function OnlineUsers(){
  if (isset($_SESSION['app_id'])) {
    $id_usuario = $_SESSION['app_id'];
    //$_SESSION['time_online'] es una variable session que esta dentro de GoLogin
    //su funcion es capturar el tiempo en el que la session fue iniciada.
    if(time() > ($_SESSION['time_online'] + (60*5))){
      $time = time();
      $_SESSION['time_online'] = $time;
      //Esta variable $_SESSION agarra el arreglo user en Users.php donde en la posicion $id_usuario que es igual a
      //a id del usuario que esta logeado agarra sus valores en este caso ultima conexion y esta ultima_conexion
      //es reemplazada por la variable $time;
      $_SESSION['users'][$id_usuario]['ultima_conexion'] = $time;
      $db = new Conexion();
      //Esta query buscan entre todos los posibles casos en la bd limitandolo a uno se optimiza porque solo afectaremos
      //un solo campo y asi no tenga que ir en busqueda de coincidencias y si en una sentencia esta restringida con un
      //where se puede limitar a 1
      $query = "UPDATE users SET ultima_conexion='$time' WHERE id='$id_usuario' LIMIT 1;";
      //Esta otra complementando la multi_query actualiza la tabla config donde actualiza el campo timer
      $query .= "UPDATE config SET timer='$time' WHERE id='1' LIMIT 1;";
      $db->multi_query($query);
      $db->close();
    }
  }
}

?>
