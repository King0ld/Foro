<?php

if(isset($_SESSION['app_id']) and $_users[$_SESSION['app_id']]['permisos'] >=2){
  $isset_id = isset($_GET['id']) and is_numeric($_GET['id']) and $_GET['id'] >= 1;

  require('core/models/class.ConfigForos.php');
  $config_foros = new ConfigForos();
  switch (isset($_GET['mode']) ? $_GET['mode'] : null) {
    case 'add':
      if($_POST){
        //Se instancia la clase Categorias y lo envia a la funcion Add().
        $config_foros->Add();
      }else{
        include(HTML_DIR . 'foros/add_foro.php');
      }
      break;
    case 'edit':
      if($isset_id and array_key_exists($_GET['id'], $_foros)){
        if($_POST){
          $config_foros->Edit();
        }else{
          include(HTML_DIR . 'foros/edit_foro.php');
        }
      }else{
        header('Location: ?view=configforos');
      }
      break;
    case 'delete':
      if($isset_id){
        $config_foros->Delete();
      }else{
        header('Location: ?view=configforos');
      }
      break;
    default:
      include(HTML_DIR . 'foros/all_foros.php');
      break;
  }
}else{
  header('Location: ?view=index');
}


?>
