<?php
//Este controlador es el que activa las cuentas.
//Primero revisamos si key esta seteado y si la variable sesion esta activa.
if (isset($_GET['key'], $_SESSION['app_id'])) {
  $db = new Conexion();
  //Luego pasamos el id de la session a una variable.
  $id = $_SESSION['app_id'];
  //luego para evitar inyeccion de codigo a la key la filtramos y la almacenamos
  //en una variable.
  $key = $db->real_escape_string($_GET['key']);
  //Luego creamos una query donde seleccionamos la id de la tabla users donde id y key sean iguales
  $sql = $db->query("SELECT id FROM users WHERE id='$id' AND keyreg='$key' LIMIT 1;");
  if($db->rows($sql) > 0){
    //Luego actualizamos el campo activo que esta en 0 y le ponemos 1 para asi efectuar que ya activo su cuenta.
    $db->query("UPDATE users SET activo='1', keyreg='' WHERE id='$id';");
    header('Location: ?view=index&success=true');
  }else{
    header('Location: ?view=index&error=true');
  }
  $db->liberar();
  $db->close();
}else{
  include('html/public/logearte.php');
}

?>
