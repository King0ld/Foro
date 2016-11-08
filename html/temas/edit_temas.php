<?php include(HTML_DIR . 'overall/header.php'); ?>

<body>
<section class="engine"><a rel="nofollow" href="#"><?php echo APP_TITLE ?></a></section>

<?php include(HTML_DIR . '/overall/topnav.php'); ?>

<section class="mbr-section mbr-after-navbar">
<div class="mbr-section__container container mbr-section__container--isolated">

  <?php

  if(isset($_GET['error'])) {
    if($_GET['error'] == 1) {
      echo '<div class="alert alert-dismissible alert-danger">
        <strong>Error!</strong></strong> todos los campos deben estar llenos.
      </div>';
    } else if ($_GET['error'] == 2) {
      echo '<div class="alert alert-dismissible alert-danger">
        <strong>Error!</strong></strong> el título del tema debe tener al menos '. MIN_TITULOS_TEMAS_LONGITUD .' caracteres.
      </div>';
    } else {
      echo '<div class="alert alert-dismissible alert-danger">
        <strong>Error!</strong></strong> el contenido del tema debe tener al menos '.  MIN_CONTENT_TEMAS_LONGITUD .' caracteres.
      </div>';
    }
  }
  ?>

<div class="row container">
  <ol class="breadcrumb">
    <li><a href="?view=index"><i class="fa fa-home"></i> Inicio</a></li>
    <li><a href="?view=foros&id=<?php echo $id_foro; ?>"><i class="fa fa-comments"></i> <?php echo $_foros[$id_foro]['nombre'] ?></a></li>
  </ol>
</div>

<div class="row categorias_con_foros">
  <div class="col-sm-12">
      <div class="row titulo_categoria">Editando... <span style="color: rgb(119, 241, 83); font-weight: bold;"> <?php echo $tema['titulo']; ?> </span></div>

      <div class="row cajas">
        <div class="col-md-9">
          <form class="form-horizontal" action="?view=temas&mode=edit&id_foro=<?php echo $id_foro ?>&id=<?php echo $_GET['id']; ?>" method="POST" enctype="application/x-www-form-urlencoded">
            <fieldset>
              <div class="form-group">
                <label for="inputEmail" class="col-lg-2 control-label">Título</label>
                <div class="col-lg-10">
                  <input type="text" class="form-control" maxlength="250" name="titulo" placeholder="Nombre para el tema" value="<?php echo $tema['titulo']; ?>" required="">
                </div>
              </div>
              <div class="form-group">
                <label for="inputEmail" class="col-lg-2 control-label">Contenido</label>
                <div class="col-lg-10">
                  <textarea class="form-control tema_textarea" name="content" placeholder="Contenido de tu tema, se acepta BBCode" required=""><?php echo $tema['contenido']; ?></textarea>
                </div>
              </div>
              <?php
                if($_users[$_SESSION['app_id']]['permisos'] > 0) {
                  $checked = $tema['tipo'] == 2 ? 'checked' : '';
                  echo '<div class="form-group">
                    <label class="col-lg-2">&nbsp;</label>
                    <label class="col-lg-10"><input type="checkbox" value="1" name="anuncio" '.$checked.' /> El tema es un anuncio</label>
                  </div>';
                }
              ?>

              <div class="form-group">
                <div class="col-lg-10 col-lg-offset-2">
                  <button type="reset" class="btn btn-default">Resetear</button>
                  <button type="submit" class="btn btn-primary">Editar</button>
                </div>
              </div>
            </fieldset>
          </form>
        </div>

        <div class="col-md-3">
          <div class="resaltado_caja">
            <strong><center>BBCode</center></strong>
            <ul class="no_style_list">
              <li>[b]Negrita[/b]</li>
              <li>[i]Italic[/i]</li>
              <li>[u]Subrayado[/u]</li>
              <li>[s]Tachado[/s]</li>
              <li>[img]URL image[/img]</li>
              <li>[center]Centrar[/center]</li>
              <li>[h1]Titulo gigante[/h1]</li>
              <li>[h2]Titulo medianamete grande[/h2]</li>
              <li>[h3]Titulo mediano[/h3]</li>
              <li>[h4]Titulo normal[/h4]</li>
              <li>[h5]Titulo pequeño[/h5]</li>
              <li>[h6]Titulo muy pequeño[/h6]</li>
              <li>[quote]Cita[/quote]</li>
              <li>[size=20]Texto en 20px[/size]</li>
              <li>[url=URL LINK]Texto a hacer clic[/url]</li>
              <li>[font=Arial]Texto en arial[/font]</li>
              <li>[bgimage=URL IMAGEN]Texto donde habrá imagen de fondo[/bgimage]</li>
              <li>[color=red]Color Rojo[/color]</li>
              <li>[bgcolor=red]Color de fondo Rojo[/bgcolor]</li>
            </ul>
          </div>
        </div>
      </div>
  </div>
</div>

</div>
</section>

<?php include(HTML_DIR . 'overall/footer.php'); ?>

</body>
</html>
