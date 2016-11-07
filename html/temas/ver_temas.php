<?php include(HTML_DIR . 'overall/header.php'); ?>

<body>
<section class="engine"><a rel="nofollow" href="#"><?php echo APP_TITLE ?></a></section>

<?php include(HTML_DIR . '/overall/topnav.php'); ?>

<section class="mbr-section mbr-after-navbar">
<div class="mbr-section__container container mbr-section__container--isolated">

<div class="row container">
  <div class="pull-right">
    <div class="mbr-navbar__column"><ul class="mbr-navbar__items mbr-navbar__items--right mbr-buttons mbr-buttons--freeze mbr-buttons--right btn-inverse mbr-buttons--active"><li class="mbr-navbar__item">
         <a class="mbr-buttons__btn btn btn-danger" href="?view=configforos">RESPONDER</a>
     </li></ul></div>
    </div>

    <ol class="breadcrumb">
      <li><a href="?view=index"><i class="fa fa-user"></i> Foro </a></li>
    </ol>
</div>

<div class="row categorias_con_foros">
  <div class="col-sm-12">
      <div class="row titulo_categoria"><span style="color: rgba(217, 78, 43, 0.81); font-family: Arial; font-weight: bold; font-size: 17.8px;"> TITULO DEL TEMA </span> </div>

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
              <li><b><?php echo $db->recorrer($sql)[0]; ?></b> temas </li>
              <li><b>30</b> mensajes</li>
              <li><b><?php echo $_users[$tema['id_dueno']]['edad']; ?></b> años</li>
              <li>Registrado el <b><?php echo $_users[$tema['id_dueno']]['fecha_reg']; ?></b></li>
            </ul>


        </div>
        <div class="col-md-10">
          <blockquote>
            <?php echo $_users[$tema['id_dueno']]['biografia']; ?>
          </blockquote>
          <hr />
          <p>
            <?php echo BBcode($_users[$tema['id_dueno']]['firma']); ?>
          </p>
        </div>
      </div>
  </div>
</div>

</div>
</section>

<?php include(HTML_DIR . 'overall/footer.php'); ?>

</body>
</html>
