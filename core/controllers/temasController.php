<?php

$mode = isset($_GET['mode']) ? $_GET['mode'] : null;
if(isset($_GET['id_foro']) and array_key_exists($_GET['id_foro'],$_foros)){

  $id_foro = intval($_GET['id_foro']);
  require('core/models/class.Temas.php');
  $isset_id = isset($_GET['id']) and is_numeric($_GET['id']) and $_GET['id'] >= 1;
  $loged = isset($_SESSION['app_id']);

  if($loged){
    $cerrado = ($_foros[$id_foro]['estado'] == 1 or $_users[$_SESSION['app_id']]['permisos'] == 2);
  }else{
    $cerrado = false;
  }

  $temas = new Temas();

  switch($mode) {
    case 'add':
      if($loged and $cerrado){
        if($_POST){
          $temas->Add();
        }else{
          include(HTML_DIR . 'temas/add_tema.php');
        }
      }
      break;
    case 'edit':
      if($isset_id and $loged){
        if($_POST){
          $temas->Edit();
        }else{

        }
      }else{
        header('Location index.php?view=index');
      }
    break;
    case 'delete':
      if($isset_id and $loged){
        $temas->Delete();
      }else{
        header('Location index.php?view=index');
      }
    break;
    case 'close':
      if($isset_id and $loged){
        $temas->Close();
      }else{
        header('Location index.php?view=index');
      }
    break;
    case 'anuncio':
      if($isset_id and $loged){
        $temas->Anuncio();
      }else{
        header('Location index.php?view=index');
      }
    break;
    default:
      if($isset_id){
        $tema = $temas->Check();
        //Verificar si el arrelo $tema existe o no
        if(false != $tema){
          //Visualizar tema
          include(HTML_DIR . 'temas/ver_temas.php');
        }else{
          header('Location index.php?view=index');
        }
      }else{
        header('Location index.php?view=index');
      }
    break;
  }
}else{
  if (null == $mode) {
    header('Location: ../index.php?view=index');
  }else{
    header('Location: index.php?view=index');
  }
}



?>
