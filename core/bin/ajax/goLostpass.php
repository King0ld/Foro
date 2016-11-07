<?php

$db = new Conexion();
$email = $db->real_escape_string($_POST['email']);
$sql = $db->query("SELECT id,user FROM users WHERE email='$email' LIMIT 1;");
if ($db->rows($sql) > 0) {
  $data = $db->recorrer($sql);
  $id = $data[0];
  $user = $data[1];
  $keypass = md5(time());
  $new_pass = strtoupper(substr(sha1(time()), 0, 8));
  $link = APP_URL . '?view=lostpass&key=' . $keypass;

  $mail = new PHPMailer;

  $mail->CharSet = "UTF-8";
  $mail->Encoding = "quoted-printable";
  $mail->isSMTP();                                      // Set mailer to use SMTP
  $mail->Host = PHPMAILER_HOST;                         // Specify main and backup SMTP servers
  $mail->SMTPAuth = true;                               // Enable SMTP authentication
  $mail->Username = PHPMAILER_USER;                     // SMTP username
  $mail->Password = PHPMAILER_PASS;                     // SMTP password
  $mail->SMTPSecure = 'ssl';                            // Hay dos SSL es el normal y TSL lo encripta
  $mail->Port = PHPMAILER_PORT;                                    // TCP port to connect to

  $mail->setFrom(PHPMAILER_USER, APP_TITLE);         // Quien envia el correo
  $mail->addAddress($email, $user);     // Quien recibe el correo

  $mail->isHTML(true);                                  // Set email format to HTML

  $mail->Subject = 'Recuperación de tu contraseña';
  $mail->Body    = LostpassTemplate($user, $link);         //Aqui se envia el mje con HTML
  $mail->AltBody = 'Hola ' . $user . 'para modificar tu contraseña, accede al siguiente enlace: ' . $link; //Y este es el mensaje como simple texto
  if(!$mail->send()) {
      $echo = '<div class="alert alert-dismissible alert-danger">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            <strong>ERROR:</strong> '. $mail->ErrorInfo .' </div>';
  }else{
    $db->query("UPDATE users SET keypass='$keypass', new_pass='$new_pass' WHERE id='$id';");
    $echo = 1;
  }
}else{
  $echo = '<div class="alert alert-dismissible alert-danger">
        <button type="button" class="close" data-dismiss="alert">&times;</button>
        <h4>ERROR:</h4> El email consultado no existe en la base de datos.
        </div>';
}
$db->liberar($sql);
$db->close();

echo $echo;
?>
