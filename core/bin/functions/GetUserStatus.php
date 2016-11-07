<?php
//Esta funcion evalua el status del usuario es decir si la variable time que viene
//de OnlineUsers.php que captura
function GetUserStatus($time){
  if ($time > (time() - (60*5))) {
    return 'icon_online.gif';
  }else{
    return 'icon_offline.gif';
  }
}

?>
