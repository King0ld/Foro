<?php

function LostpassTemplate($user, $link){
  $echo = '
  <html>
  <body style="background: #FFFFFF;font-family: Verdana; font-size: 14px;color:#1c1b1b;">
  <div style="">
      <h2>Hola '. $user .'</h2>
      <p style="font-size:17px;">hemos recibido una solicitud de cambio de contraseña.</p>
  	<p>El día '. date('d/m/Y', time()) .' se ha generado una solicitud de recuperación de contraseña. <br /> Si no has solicitado esto, has caso omiso a este mensaje, si al contrario deseas cambiar tu contraseña debes hacer click en el enlace que se muestra abajo.</p>
  			Para modificar tu contraseña por favor has <a style="font-weight:bold;color: #2BA6CB;" href="'.$link.'" target="_blank">clic aquí &raquo;</a>
  	</p>
      <p style="font-size: 9px;">&copy; '. date('Y',time()) .' '.APP_TITLE.'. Todos los derechos reservados.</p>
  </div>
  </body>
  </html>
  ';

  return $echo;
}

?>
