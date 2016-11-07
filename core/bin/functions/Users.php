<?php
/*Esta funcion trae a todos los usuarios y los mantiene en un arreglo*/
function Users(){
  $db = new Conexion();

  //Cada vez que el usuario recargue la pagina se actualizara la query
  $query = $db->query("SELECT timer FROM config WHERE id='1' LIMIT 1;");
  $timer = $db->recorrer($query)[0];
  $db->liberar($query);

  /*Aqui trae a todos los usuarios*/
  $sql = $db->query("SELECT * FROM users;");
  $usuarios_actuales = $db->rows($sql);

  if(!isset($_SESSION['cantidad_usuarios'])){
      $_SESSION['cantidad_usuarios'] = $usuarios_actuales;
  }

  if ($_SESSION['cantidad_usuarios'] != $usuarios_actuales or (time() - 60) <= $timer){
    while($d = $db->recorrer($sql)){
      /*Arreglo multidimensional que $d es donde se guardo la query y contiene toda la informacion
      entonces pasa dentro de la variable users toda la informacion desde la base de datos a su
      respectivo campo asociado*/
      $users[$d['id']] = $d;
    }
  }else{
    if (!isset($_SESSION['users'])) {
      while($d = $db->recorrer($sql)){
        $users[$d['id']] = $d;
      }
    }else{
      $users = $_SESSION['users'];
    }
  }
  $_SESSION['users'] = $users;

  $db->liberar($sql);
  $db->close();

  return $_SESSION['users'];
}

?>
