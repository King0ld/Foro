<?php

function Foros(){
  $db = new Conexion();
  $sql = $db->query("SELECT * FROM foros;");
  if($db->rows($sql) > 0){
    while ($data = $db->recorrer($sql)) {
      $foros[$data['id']] = $data;
    }
  }else{
    $foros = false;
  }
  $db->liberar($sql);
  $db->close();

  return $foros;
}


?>
