<?php
//Aqui se usa el if porque si no esta iniciado la sesion y no tiene permiso de administrador
//La variable users trae consigo todos los usuarios.
if(isset($_SESSION['app_id']) and $_users[$_SESSION['app_id']]['permisos'] >=2){

  //Esta variable captura el id y devuelve true o false si se cumple las tres condiciones
  //si esta definido si es numerico y si es mayor o igual a 1, se usara para Edit y Delete.
  $isset_id = isset($_GET['id']) and is_numeric($_GET['id']) and $_GET['id'] >= 1;

  require('core/models/class.Categorias.php'); 
  $categorias = new Categorias(); //Instancia de class.Categorias porque esta en POO.
  switch (isset($_GET['mode']) ? $_GET['mode'] : null) {
    case 'add':
      if($_POST){
        //Se instancia la clase Categorias y lo envia a la funcion Add().
        $categorias->Add();
      }else{
        include(HTML_DIR . 'categorias/add_categoria.php');
      }
      break;
    case 'edit':
    //array_key_exists es una funcion que recibe dos parametros uno que es el id
    //que se va a evaluar y el otro es el arreglo en que buscara.
      if($isset_id and array_key_exists($_GET['id'], $_categorias)){
        if($_POST){
          $categorias->Edit();
        }else{
          include(HTML_DIR . 'categorias/edit_categoria.php');
        }
      }else{
        header('Location: ?view=categorias');
      }
      break;
    case 'delete':
      if($isset_id){
        $categorias->Delete();
      }else{
        header('Location: ?view=categorias');
      }
      break;
    default:
      include(HTML_DIR . 'categorias/all_categoria.php');
      break;
  }
}else {
  header('Location: ?view=index');
}

?>
