<?php include(HTML_DIR . 'overall/header.php'); ?>

<body>
<section class="engine"><a rel="nofollow" href="#"><?php echo APP_TITLE ?></a></section>

<?php include(HTML_DIR . '/overall/topnav.php'); ?>

<section class="mbr-section mbr-after-navbar">
<div class="mbr-section__container container mbr-section__container--isolated">

  <?php
  if(isset($_GET['success'])) {
    echo '<div class="alert alert-dismissible alert-success">
      <strong>Completado!</strong> el foro ha sido creado.
    </div>';
  }

  if(isset($_GET['error'])) {
    if($_GET['error'] == 1){
      echo '<div class="alert alert-dismissible alert-danger">
        <strong>Error!</strong></strong> todos los campos de estar llenos.
      </div>';
    }else{
      echo '<div class="alert alert-dismissible alert-danger">
        <strong>Error!</strong></strong> debe existir una categoría para crear el foro.
      </div>';
    }
  }
  ?>

  <div class="row container">
    <div class="pull-right">
      <div class="mbr-navbar__column"><ul class="mbr-navbar__items mbr-navbar__items--right mbr-buttons mbr-buttons--freeze mbr-buttons--right btn-inverse mbr-buttons--active"><li class="mbr-navbar__item">
           <a class="mbr-buttons__btn btn btn-danger" href="?view=configforos">GESTIONAR FOROS</a>
       </li></ul></div>
       <div class="mbr-navbar__column"><ul class="mbr-navbar__items mbr-navbar__items--right mbr-buttons mbr-buttons--freeze mbr-buttons--right btn-inverse mbr-buttons--active"><li class="mbr-navbar__item">
           <a class="mbr-buttons__btn btn btn-danger active" href="?view=configforos&mode=add">CREAR FORO</a>
       </li></ul></div>
        <div class="mbr-navbar__column"><ul class="mbr-navbar__items mbr-navbar__items--right mbr-buttons mbr-buttons--freeze mbr-buttons--right btn-inverse mbr-buttons--active"><li class="mbr-navbar__item">
            <a class="mbr-buttons__btn btn btn-danger" href="?view=categorias">GESTIONAR CATEGORÍAS</a>
        </li></ul></div>
      </div>

    <ol class="breadcrumb">
      <li><a href="?view=index"><i class="fa fa-commets"></i> Foros</a></li>
    </ol>
</div>

<div class="row categorias_con_foros">
  <div class="col-sm-12">
      <div class="row titulo_categoria">Gestión de Foros</div>
      <div class="row cajas">
        <div class="col-md-12">
          <form class="form-horizontal" action="?view=configforos&mode=add" method="POST" enctype="application/x-www-form-urlencoded">
            <fieldset>
              <div class="form-group">
                <label for="inputEmail" class="col-lg-2 control-label">Nombre del Foro:</label>
                <div class="col-lg-10">
                  <input type="text" class="form-control" name="nombre" placeholder="Escriba un nombre para el foro" maxlength="250">
                </div>
              </div>
              <div class="form-group">
                <label for="inputEmail" class="col-lg-2 control-label">Descripción del Foro:</label>
                <div class="col-lg-10">
                  <input type="text" class="form-control" name="descrip" placeholder="Escribe la descripción (permite HTML)" maxlength="250">
                </div>
              </div>
              <div class="form-group">
              <label for="inputEmail" class="col-lg-2 control-label">Categoría</label>
              <div class="col-lg-10">
              <select class="form-control" name="categoria">
                <?php
                if (false != $_categorias) {
                  foreach ($_categorias as $id_categoria => $array_categoria) {
                    echo '<option value="'.$id_categoria.'">'.$_categorias[$id_categoria]['nombre'].'</option>';
                  }
                }else{
                  echo '<option value="0" style="font-color: red;">No existen categorias, por favor crea una!</option>';
                }
                ?>
              </select>
            </div>
          </div>
          <div class="form-group">
                <label class="col-lg-2 control-label">Estado del foro</label>
                <div class="col-lg-10">
                  <div class="radio">
                    <label>
                      <input name="estado" value="1" type="radio" checked="">
                      Abierto
                    </label>
                  </div>
                  <div class="radio">
                    <label>
                      <input name="estado" value="0" type="radio">
                      Cerrado
                    </label>
                  </div>
                </div>
              </div>
              <div class="form-group">
                <div class="col-lg-10 col-lg-offset-2">
                  <button type="reset" class="btn btn-default">Resetear</button>
                  <button type="submit" class="btn btn-primary">Crear</button>
                </div>
              </div>
            </fieldset>
          </form>
        </div>
      </div>
  </div>
</div>

</div>
</section>

<?php include(HTML_DIR . 'overall/footer.php'); ?>

</body>
</html>
