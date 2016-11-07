<?php include(HTML_DIR .'overall/header.php'); ?>
<!-- Este archivo es el mensaje que se ve cuando se le da click en el enlace del correo-->
<body>
<section class="engine"><a rel="nofollow" href="#"><?php echo APP_TITLE; ?></a></section>
<?php include(HTML_DIR . 'overall/topnav.php'); ?>


<section class="mbr-section mbr-after-navbar">
    <div class="mbr-section__container container mbr-section__container--isolated">

        <div class="alert alert-dismissible alert-success">
          <strong>Felicidades!</strong> Su contraseña ha sido modificada: <strong><?php echo $password; ?></strong>, prueba <a data-toggle="modal" data-target="#Login" style="cursor: pointer; text-decoration: none;"> iniciar sesión </a> con ella.
        </div>

    </div>
</section>

<?php include(HTML_DIR . 'overall/footer.php'); ?>

</body>
</html>
