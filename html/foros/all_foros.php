<?php include(HTML_DIR . 'overall/header.php'); ?>

 <body>
 <section class="engine"><a rel="nofollow" href="#"><?php echo APP_TITLE ?></a></section>

 <?php include(HTML_DIR . '/overall/topnav.php'); ?>

 <section class="mbr-section mbr-after-navbar">
 <div class="mbr-section__container container mbr-section__container--isolated">

   <?php
   if(isset($_GET['success'])) {
     echo '<div class="alert alert-dismissible alert-success">
       <strong>Correcto!</strong> El foro ha sido eliminado sastifactoriamente.
     </div>';
   }

   if(isset($_GET['error'])) {
     echo '<div class="alert alert-dismissible alert-danger">
       <strong>Error!</strong></strong> Ocurrio un problema, vuelva a intentar más tarde.
     </div>';
   }
   ?>

   <div class="row container">
   <div class="pull-right">
     <div class="mbr-navbar__column"><ul class="mbr-navbar__items mbr-navbar__items--right mbr-buttons mbr-buttons--freeze mbr-buttons--right btn-inverse mbr-buttons--active"><li class="mbr-navbar__item">
          <a class="mbr-buttons__btn btn btn-danger active" href="?view=configforos">GESTIONAR FOROS</a>
      </li></ul></div>
      <div class="mbr-navbar__column"><ul class="mbr-navbar__items mbr-navbar__items--right mbr-buttons mbr-buttons--freeze mbr-buttons--right btn-inverse mbr-buttons--active"><li class="mbr-navbar__item">
          <a class="mbr-buttons__btn btn btn-danger" href="?view=configforos&mode=add">CREAR FORO</a>
      </li></ul></div>
       <div class="mbr-navbar__column"><ul class="mbr-navbar__items mbr-navbar__items--right mbr-buttons mbr-buttons--freeze mbr-buttons--right btn-inverse mbr-buttons--active"><li class="mbr-navbar__item">
           <a class="mbr-buttons__btn btn btn-danger" href="?view=categorias">GESTIONAR CATEGORÍAS</a>
       </li></ul></div>
     </div>

     <ol class="breadcrumb">
       <li><a href="?view=index"><i class="fa fa-comments"></i> Foros</a></li>
     </ol>
 </div>

 <div class="row categorias_con_foros">
   <div class="col-sm-12">
       <div class="row titulo_categoria">Gestión de Foros</div>

       <div class="row cajas">
         <div class="col-md-12">
           <?php

           if(false != $_foros) {
            $HTML = '<table class="table"><thead><tr>
            <th style="width: 10%">Id</th>
            <th>Foro</th>
            <th>Mensajes</th>
            <th>Temas</th>
            <th>Categoría</th>
            <th>Estado</th>
            <th style="width: 20%">Acciones</th>
            </tr></thead>
            <tbody>';
            //$_categorias es un arreglo que contiene todas las categorias, y $_foros es otro que contiene todos los foros
            //$_foros usa el puntero $id_foro para recorrer $_foros y luego lo asocia todo en content_array que no se esta
            //usando. Entonces, $_categorias necesita un id para saber que posicion va a mostrar entonces primero,
            //llamamos al id_categoria dentro de foro que es el mismo que apunta al id de categoria y en el arreglo
            //$_categorias muestra el nombre que respecta al id_categoria de $_foros.
             foreach($_foros as $id_foro => $content_array) {
                $estado = $_foros[$id_foro]['estado'] == 1 ? '<em style="color:#56b018">Abierto</em>' : '<em style="color:#eb4a34">Cerrado</em>';
                 $HTML .= '<tr>
                   <td>'.$_foros[$id_foro]['id'].'</td>
                   <td>'.$_foros[$id_foro]['nombre'].'</td>
                   <td>'.$_foros[$id_foro]['cantidad_mensajes'].'</td>
                   <td>'.$_foros[$id_foro]['cantidad_temas'].'</td>
                   <td>'.$_categorias[$_foros[$id_foro]['id_categoria']]['nombre'].'</td>
                   <td>'. $estado .'</td>
                   <td>
                     <div class="btn-group">
                      <a href="#" class="btn btn-primary">Acciones</a>
                      <a href="#" class="btn btn-primary dropdown-toggle" data-toggle="dropdown"><span class="caret"></span></a>
                      <ul class="dropdown-menu">
                        <li><a href="?view=configforos&mode=edit&id='.$_foros[$id_foro]['id'].'">Editar</a></li>
                        <li><a onclick="DeleteItem(\'¿Está seguro de eliminar este foro?\',\'?view=configforos&mode=delete&id='.$_foros[$id_foro]['id'].'\')">Eliminar</a></li>
                      </ul>
                    </div>
                   </td>
                 </tr>';
             }
             $HTML .= '</tbody></table>';
           } else {
             $HTML = '<div class="alert alert-dismissible alert-info"><strong>INFORMACIÓN: </strong> Todavía no existe ningún foro.</div>';
           }
           //Aqui se imprime todo el html acomulado.
           echo $HTML;
           ?>
         </div>
       </div>
   </div>
 </div>
 </div>
 </section>

 <?php include(HTML_DIR . 'overall/footer.php'); ?>

 </body>
 </html>
