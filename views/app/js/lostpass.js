function goLostpass() {
  var connect, form, response, result, email;
  email = __('email_lostpass').value;
  if(email != ''){
    form = 'email=' + email;
    /*Esta clase window.XML... sirve para obtener que elemento ajax tiene tu navegador
    entonces el if dice que lo obtenga por el XMLHttpRequest o por el ActiveXObject*/
    connect = window.XMLHttpRequest ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
    connect.onreadystatechange = function() {
      if(connect.readyState == 4 && connect.status == 200) {
        if(connect.responseText == 1) {
          result = '<div class="alert alert-dismissible alert-success">';
          result += '<h4>Se ha enviado un correo!</h4>';
          result += '<p><strong>Revisa tu correo y has click en el enlace.</strong></p>';
          result += '</div>';
          /*Este __('_AJAX_LOGIN_') hace referencia al div del login.html que
          se guardara todo dentro de result y alla se visualizara como html*/
          __('_AJAX_LOSTPASS_').innerHTML = result;
          location.reload();
        } else {
          /*Este es una parte crucial porque captura lo que esta dentro de html
          como texto y lo deja vacio como tal*/
          __('_AJAX_LOSTPASS_').innerHTML = connect.responseText;
        }
      } else if(connect.readyState != 4) {
        result = '<div class="alert alert-dismissible alert-warning">';
        result += '<button type="button" class="close" data-dismiss="alert">x</button>';
        result += '<h4>Procesando...</h4>';
        result += '<p><strong>Estamos enviandote un correo.</strong></p>';
        result += '</div>';
        __('_AJAX_LOSTPASS_').innerHTML = result;
      }
    }
    /*Este connect.open hace la conexion con ajax para que despues los datos se envien
    a goLogin.php y alli indique el swich*/
    connect.open('POST','ajax.php?mode=lostpass',true);
    /*Este es un encriptado que lo hace por defecto los formularios post pero es vital
    que se establezca para que funcione nuestro metodo*/
    connect.setRequestHeader('Content-Type','application/x-www-form-urlencoded');
    /*Aqui se envia todo el formulario en conjunto tanto como el encriptado, la variable mode
    como si fuese por url y las variables*/
    connect.send(form);
  }else{
    result = '<div class="alert alert-dismissible alert-danger">';
    result += '<button type="button" class="close" data-dismiss="alert">x</button>';
    result += '<h4>ATENCIÓN!</h4>';
    result += '<p><strong>Registra tu correo electronico.</strong></p>';
    result += '</div>';
    __('_AJAX_LOSTPASS_').innerHTML = result;
  }
}


function runScriptLostpass(e) {
  if(e.keyCode == 13) {
    goLostpass();
  }
}
