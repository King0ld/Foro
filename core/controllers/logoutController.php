<?php

unset($_SESSION['app_id'], $_SESSION['cantidad_usuarios'], $_SESSION['users']);
header('Location: ?view=index');

?>
