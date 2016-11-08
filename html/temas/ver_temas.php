<?php include(HTML_DIR . 'overall/header.php'); ?>

<body>
<section class="engine"><a rel="nofollow" href="#"><?php echo APP_TITLE ?></a></section>

<?php include(HTML_DIR . '/overall/topnav.php'); ?>

<section class="mbr-section mbr-after-navbar">
<div class="mbr-section__container container mbr-section__container--isolated">

<div class="row container">
  <div class="pull-right">

    <?php

      //Variable que define que permiso tiene el usuario sobre el tema y si es dueno del mismo
      $permisos_o_dueno = $_users[$_SESSION['app_id']]['permisos'] > 0 or $tema['id_dueno'] == $_SESSION['app_id'];

      if ($permisos_o_dueno) {
        if ($tema['estado'] == 1) {
          echo '<div class="mbr-navbar__column"><ul class="mbr-navbar__items mbr-navbar__items--right mbr-buttons mbr-buttons--freeze mbr-buttons--right btn-inverse mbr-buttons--active"><li class="mbr-navbar__item">
               <a class="mbr-buttons__btn btn btn-danger" href="?view=temas&mode=close&id='. $_GET['id'] .'&id_foro='.$_GET['id_foro'].'&estado=0">CERRAR</a>
           </li></ul></div>';
        }
        echo '<div class="mbr-navbar__column"><ul class="mbr-navbar__items mbr-navbar__items--right mbr-buttons mbr-buttons--freeze mbr-buttons--right btn-inverse mbr-buttons--active"><li class="mbr-navbar__item">
             <a class="mbr-buttons__btn btn btn-danger" href="?view=temas&mode=delete&id='. $_GET['id'] .'&id_foro='.$_GET['id_foro'].'">BORRAR</a>
         </li></ul></div>';
      }

      if ($tema['estado'] == 1) {
        echo '<div class="mbr-navbar__column"><ul class="mbr-navbar__items mbr-navbar__items--right mbr-buttons mbr-buttons--freeze mbr-buttons--right btn-inverse mbr-buttons--active"><li class="mbr-navbar__item">
             <a class="mbr-buttons__btn btn btn-danger" href="?view=temas&mode=responder&id='. $_GET['id'] .'&id_foro='.$_GET['id_foro'].'">RESPONDER</a>
         </li></ul></div>';


      }else if(($permisos_o_dueno) and $tema['estado'] == 0){
        echo '<div class="mbr-navbar__column"><ul class="mbr-navbar__items mbr-navbar__items--right mbr-buttons mbr-buttons--freeze mbr-buttons--right btn-inverse mbr-buttons--active"><li class="mbr-navbar__item">
             <a class="mbr-buttons__btn btn btn-danger" href="?view=temas&mode=close&id='. $_GET['id'] .'&id_foro='.$_GET['id_foro'].'&estado=1">ABRIR</a>
         </li></ul></div>';
      }

     ?>


    </div>

    <ol class="breadcrumb">
      <li><a href="?view=index"><i class="fa fa-home"></i> Inicio</a></li>
      <li><a href="?view=foros&id=<?php echo $id_foro; ?>"><i class="fa fa-comments"></i> <?php echo $_foros[$id_foro]['nombre'] ?></a></li>
    </ol>
</div>

<div class="row categorias_con_foros">
  <div class="col-sm-12">
      <div class="row titulo_categoria"><span style="color: rgba(217, 78, 43, 0.81); font-family: Arial; font-weight: bold; font-size: 17.8px;"> <?php echo $tema['titulo'] ?> </span> </div>

      <div class="row cajas">
        <div class="col-md-2">
          <center>

            <img src="views/app/images/users/<?php echo $_users[$tema['id_dueno']]['img']; ?>" class="thumbnail" height="120" style="margin-top: 30px;"/>

            <strong><?php echo $_users[$tema['id_dueno']]['user']; ?></strong>
            <img src="views/app/images/<?php echo GetUserStatus($_users[$tema['id_dueno']]['ultima_conexion']); ?>" alt="Estado del usuario: Online/Offline" />

            <br />
            <b style="color: green;">**<?php echo $_users[$tema['id_dueno']]['rango']; ?>**</b>
            <br /><br />
        </center>

            <ul style="list-style:none; padding-left: 4px;">

              <li><b><?php echo $_users[$tema['id_dueno']]['mensajes']; ?> </b> mensajes</li>
              <li><b><?php echo $_users[$tema['id_dueno']]['edad']; ?></b> años</li>
              <li>Registrado el <b><?php echo $_users[$tema['id_dueno']]['fecha_reg']; ?></b></li>
            </ul>


        </div>
        <div class="col-md-10">
          <blockquote>
            <?php echo BBcode($tema['contenido']) ?>
            <?php
              if ($permisos_o_dueno) {
                echo '<div class="row" style="margin-top: 20px;">
                  <div class="col-md-3 col-md-push-9">
                    <a href="index.php?view=temas&mode=edit&id='. $_GET['id'] .'&id_foro='. $_GET['id_foro'] .'" class="btn btn-primary">EDITAR MENSAJE</a>
                  </div>
                </div>';
              }
            ?>
          </blockquote>

          <hr />
          <p>
            <?php echo BBcode($_users[$tema['id_dueno']]['firma']); ?>
          </p>

        </div>
      </div>
  </div>



  <!-- HTML de Respuestas -->
  <?php
    if (false != $respuestas) {
      foreach($respuestas as $resp){
        echo '<div class="col-sm-12" style="margin-left: 40px; margin-top: 13px;">
            <div class="row cajas">
              <div class="col-md-2">
                <center>

                  <img src="views/app/images/users/'. $_users[$resp['id_dueno']]['img'] .'" class="thumbnail" height="120" style="margin-top: 30px;"/>

                  <strong>'. $_users[$tema['id_dueno']]['user'] .'</strong>
                  <img src="views/app/images/'. GetUserStatus($_users[$resp['id_dueno']]['ultima_conexion']) .'" alt="Estado del usuario: Online/Offline" />

                  <br />
                  <b style="color: green;">**'. $_users[$resp['id_dueno']]['rango'] .'**</b>
                  <br /><br />
              </center>

                  <ul style="list-style:none; padding-left: 4px;">

                    <li><b>'. $_users[$resp['id_dueno']]['mensajes'] .'</b> mensajes</li>
                    <li><b>'. $_users[$resp['id_dueno']]['edad'] .'</b> años</li>
                    <li>Registrado el <b>'.$_users[$resp['id_dueno']]['fecha_reg'] .'</b></li>
                  </ul>


              </div>
              <div class="col-md-10">
                <blockquote>
                  '.BBcode($resp['contenido']).'
                </blockquote>
                <hr />
                <p>
                  '.BBcode($_users[$resp['id_dueno']]['firma']).'
                </p>
              </div>
            </div>
        </div>';
      }
    }



   ?>

</div>

</div>
</section>

<?php include(HTML_DIR . 'overall/footer.php'); ?>

</body>
</html>
