<?php
/*Author: Mario Junior Torres Perez
  Date: Begin: 8/March/2016 - Developing
  Account: MarioDev64
*/
session_start();
date_default_timezone_set('America/Santo_Domingo');
/*
Nucleo de la aplicacion
*/
#Constantes de Conexion
define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASS', '');
define('DB_NAME', 'foro');

#Constantes de la APP
define('HTML_DIR', 'html/');
define('APP_TITLE', 'Foro');
define('COPY_RIGHT', 'Copyright &copy; ' . date('Y',time()) . ' MarioDev64');
define('APP_URL', 'http://localhost/Foro/');

#Constantes PHPMailer
define('PHPMAILER_HOST', 'p3plcpnl0173.prod.phx3.secureserver.net');
define('PHPMAILER_USER', 'public@ocrend.com');
define('PHPMAILER_PASS', 'Prinick2016');
define('PHPMAILER_PORT', 465);

#Constantes generales de personalizacion
define('MIN_TITULOS_TEMAS_LONGITUD',9);
define('MIN_CONTENT_TEMAS_LONGITUD',100);

#Estructura
require('vendor/autoload.php');
require('core/models/class.Conexion.php');
require('core/bin/functions/Encrypt.php');
require('core/bin/functions/Users.php');
require('core/bin/functions/Categorias.php');
require('core/bin/functions/Foros.php');
require('core/bin/functions/EmailTemplate.php');
require('core/bin/functions/LostpassTemplate.php');
require('core/bin/functions/UrlAmigable.php');
require('core/bin/functions/BBcode.php');
require('core/bin/functions/OnlineUsers.php');
require('core/bin/functions/GetUserStatus.php');

/*Variable que contiene todos los usuarios*/
$_users = Users();
//variable que contiene o instancia todas las categorias de los foros, para add, edit y delete.
$_categorias = Categorias();
//Variable que contiene e instancia todos los foros con sus respectivas categorias y temas ademas de su funciones.
$_foros = Foros();
?>
