<?php include(HTML_DIR . 'overall/header.php'); ?>

<body>
<section class="engine"><a rel="nofollow" href="#"><?php echo APP_TITLE ?></a></section>

<?php include(HTML_DIR . '/overall/topnav.php'); ?>

<section class="mbr-section mbr-after-navbar">
  <div class="mbr-section__container container mbr-section__container--isolated">

  <?php
  //esto se activa con la siguiente url ?view=index&success=true o ?view=index&error=true .
  if(isset($_GET['success'])) {
    echo '<div class="alert alert-dismissible alert-success">
      <strong>Activado!</strong> tu usuario ha sido activado correctamente.
    </div>';
  }
  if(isset($_GET['error'])) {
    echo '<div class="alert alert-dismissible alert-danger">
      <strong>Error!</strong></strong> no se ha podido activar tu usuario.
    </div>';
  }
  ?>

  <div class="row container">
    <?php
      //Hace que se active los botones de Gestionar Foros y Categorias.
          if(isset($_SESSION['app_id']) and $_users[$_SESSION['app_id']]['permisos'] >= 2) {
            echo '
            <div class="pull-right">
              <div class="mbr-navbar__column"><ul class="mbr-navbar__items mbr-navbar__items--right mbr-buttons mbr-buttons--freeze mbr-buttons--right btn-inverse mbr-buttons--active"><li class="mbr-navbar__item">
                <a class="mbr-buttons__btn btn btn-danger" href="?view=configforos">GESTIONAR FOROS</a>
              </li></ul></div>
              <div class="mbr-navbar__column"><ul class="mbr-navbar__items mbr-navbar__items--right mbr-buttons mbr-buttons--freeze mbr-buttons--right btn-inverse mbr-buttons--active"><li class="mbr-navbar__item">
                <a class="mbr-buttons__btn btn btn-danger" href="?view=categorias">GESTIONAR CATEGORÍAS</a>
              </li></ul></div>
            </div>
            ';
          }
      ?>
      <ol class="breadcrumb">
        <li><a href="?view=index"><i class="fa fa-home"></i> Inicio</a></li>
      </ol>
  </div>

  <?php
    //Esta condicional evalua que si no hay nada en la base de datos en la tabla categoria
    //Es una funcion dentro de functions/Categorias.php
    if(false != $_categorias){
      //Sentencia sql preparada, se ejecuta una sola vez y se guarda en cache todo la ejecucion
      //seleccional el id de foros donde este todas las id_categoria el id foro 1 en id_categoria 1.
      $prepare_sql = $db->prepare("SELECT id FROM foros WHERE id_categoria = ?;");
      //Usamos bind_param para asignar todo lo recorrido en el prepare y guardarlo en $id_de_categoria
      //el i al principio es para indicar que tipo de dato recibira i=entero, s=string, b=blop y d=double...
      $prepare_sql->bind_param('i', $id_categoria);
      foreach($_categorias as $id_categoria => $array_categoria){
        $prepare_sql->execute();
        //Es una funcion que cumple con el proposito de de almacenar en cache todos los resultados de la
        //query preparada sin perjudicar en nada el rendimiento.
        $prepare_sql->store_result();

        echo '<div class="row categorias_con_foros">
          <div class="col-sm-12">
              <div class="row titulo_categoria">'.$_categorias[$id_categoria]['nombre'].'</div>';
        //Es una propiedad heredada de los objetos que almacena la cantidad de elementos que tiene cada arreglo
        if($prepare_sql->num_rows > 0){
          $prepare_sql->bind_result($id_del_foro);
          while($prepare_sql->fetch()){

            if($_foros[$id_del_foro]['estado'] == 1){
              $extension = '.png';
            }else{
              $extension = '_bloqueado.png';
            }

            if (empty($_foros[$id_del_foro]['ultimo_tema'])) {
              $ultimo_tema = '<a href="#"> No hay temas creados</a>';
            }else{
              $ultimo_tema = '<a href="temas/'.UrlAmigable($_foros[$id_del_foro]['id_ultimo_tema'],$_foros[$id_del_foro]['ultimo_tema'],$id_del_foro).'">'.$_foros[$id_del_foro]['ultimo_tema'].'</a>';
            }

            echo '<div class="row foros">
                     <div class="col-md-1" style="height:50px;line-height: 37px;">
                       <img src="views/app/images/foros/foro_leido'.$extension.'" />
                     </div>
                     <div class="col-md-7 puntitos" style="padding-left: 0px;">
                       <a href="foros/'.UrlAmigable($id_del_foro,$_foros[$id_del_foro]['nombre']).'">'.$_foros[$id_del_foro]['nombre'].'</a><br />
                       '.$_foros[$id_del_foro]['descrip'].'
                     </div>
                     <div class="col-md-2 left_border" style="text-align: center;font-weight: bold;">
                       '.number_format($_foros[$id_del_foro]['cantidad_temas'],0,',','.').' Temas<br />
                       '.number_format($_foros[$id_del_foro]['cantidad_mensajes'],0,',','.').' Mensajes
                     </div>
                     <div class="col-md-2 left_border puntitos" style="line-height: 37px;">
                       '.$ultimo_tema.'
                     </div>
                 </div>';
              }
        }else{
          echo '<div class="row foros">
                  <div class="col-md-12" style="height:50px;line-height: 37px;">
                    No existe ningún foro
                  </div>
                </div>';
        }

        echo' </div>
            </div>';
      }
      $prepare_sql->close();
    }else{
      echo '<div class="row categorias_con_foros">
        <div class="col-sm-12">
          <div class="row titulo_categoria"> '. APP_TITLE .'</div>
            <div class="row foros">
              <div class="col-md-12" style="height:50px;line-height: 37px;">
                No existe ninguna categoría
              </div>
          </div>
        </div>
      </div>';
    }

  ?>

  </div>
</section>




<?php include(HTML_DIR . 'overall/footer.php'); ?>

</body>
</html>
