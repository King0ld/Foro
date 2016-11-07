<?php
/*Para recuperar la password del usuario no puede estar dentro de la session, obviamente
y en la url debe estar seteada la variable key*/
if(!isset($_SESSION['app_id']) and isset($_GET['key'])){
  $db = new Conexion();
  $keypass = $db->real_escape_string($_GET['key']);
  $sql = $db->query("SELECT id, new_pass FROM users WHERE keypass='$keypass' LIMIT 1;");
  if($db->rows($sql) > 0){
    $data = $db->recorrer($sql);
    $id_user = $data[0];
    $new_pass = Encrypt($data[1]);
    /*La variable password se esta enviado al archivo en public/html/lostpass_mensaje.php*/
    $password = $data[1];
    $db->query("UPDATE users SET keypass='', new_pass='', pass='$new_pass' WHERE id='$id_user';");
    include('html/lostpass_mensaje.php');
  }else{
    header('Location: ?view=index');
  }
  $db->liberar($sql);
  $db->close();
}else{
  header('Location: ?view=index');
}

?>
