<?php

$db = new Conexion();

$user = $db->real_escape_string($_POST['user']);
$pass = Encrypt($_POST['pass']);
$email = $db->real_escape_string($_POST['email']);

/*Esta sentencia SQL busca dentro de la base de datos los datos que sean iguales a las variables
es decir si encuentra un usuario igual a la variable user entonces ese usuario ya ha sido registrado*/
$sql = $db->query("SELECT user FROM users WHERE user='$user' OR email='$email' LIMIT 1;");
if($db->rows($sql) == 0){
  $keyreg = md5(time());
  $link = APP_URL . '?view=activar&key=' . $keyreg;

  $mail = new PHPMailer;

  //$mail->SMTPDebug = 3`;                               // Enable verbose debug output
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

  $mail->Subject = 'Activación de tu cuenta';
  $mail->Body    = EmailTemplate($user, $link);         //Aqui se envia el mje con HTML
  $mail->AltBody = 'Hola ' . $user . 'para activar tu cuenta, accede al siguiente enlace: ' . $link; //Y este es el mensaje como simple texto

  if(!$mail->send()) {
      $echo = '<div class="alert alert-dismissible alert-danger">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            <strong>ERROR:</strong> '. $mail->ErrorInfo .' </div>';
  } else {
    $fecha_reg = date('d/m/Y', time());
    $db->query("INSERT INTO users (user, pass, email, keyreg, fecha_reg) VALUES ('$user', '$pass', '$email', '$keyreg', '$fecha_reg');");
    $sql_2 = $db->query("SELECT MAX(id) AS id FROM users;");
    $_SESSION['app_id'] = $db->recorrer($sql_2)[0];
    $db->liberar($sql_2);
    $echo = 1;
  }
}else{
  $usuario = $db->recorrer($sql)[0];
  if(strtolower($user) == strtolower($usuario)){
    $echo = '<div class="alert alert-dismissible alert-danger">
          <button type="button" class="close" data-dismiss="alert">&times;</button>
          <strong>ERROR:</strong> El usuario o email escrito ya ha sido registrado.
          </div>';
  }else{
    $echo = '<div class="alert alert-dismissible alert-danger">
          <button type="button" class="close" data-dismiss="alert">&times;</button>
          <strong>ERROR:</strong> El usuario o email escrito ya ha sido registrado.
          </div>';
  }
}

$db->liberar($sql);
$db->close();

echo $echo;
?>
