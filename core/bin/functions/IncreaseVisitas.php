<?php

function IncreaseVisitas(int $id) {
  $db = new Conexion();
  $db->query("UPDATE temas SET visitas=visitas + '1' WHERE id='$id' LIMIT 1;");
  $db->close();
}

?>
