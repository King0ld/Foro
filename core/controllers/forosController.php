<?php

if(isset($_GET['id']) and is_numeric($_GET['id']) and $_GET['id'] >= 1){
  $id_foro = intval($_GET['id']);
  if(array_key_exists($id_foro, $_foros)){
    $db = new Conexion();
    //ORDER BY DESC Hace que se muestre de mayor a menor eso es para mantener actualizado los temas de anunciones y  no anuncios
    $sql_anuncios = $db->query("SELECT * FROM temas WHERE id_foro = '$id_foro' AND tipo='2' ORDER BY id DESC;");
    $sql_no_anuncios = $db->query("SELECT * FROM temas WHERE id_foro = '$id_foro' AND tipo= '1' ORDER BY id DESC;");
    include(HTML_DIR . 'temas/temas.php');
    $db->liberar($sql_anuncios, $sql_no_anuncios);
    $db->close();
  }else{
    header('Location: ../index.php?view=index');
  }
}else{
  header('Location: ../index.php?view=index');
}

?>
