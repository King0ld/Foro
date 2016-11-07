function goReg() {
  var connect, form, response, result, user, pass, email, tyc, pass2, str, str2;
  user = __('user_reg').value;
  pass = __('pass_reg').value;
  email = __('email_reg').value;
  pass2 = __('pass_reg_dos').value;
  tyc = __('tyc_reg').checked ? true : false;
  str = pass.length;
  str2 = pass2.length;
  if(tyc == true){
    if (user != '' && pass != '' && pass2 != '' && email != '' && tyc != '') {
      if ((str || str2)  > 6) {
        if(pass == pass2){
          form = 'user=' + user + '&pass=' + pass + '&email=' + email;
          /*Esta clase window.XML... sirve para obtener que elemento ajax tiene tu navegador
          entonces el if dice que lo obtenga por el XMLHttpRequest o por el ActiveXObject*/
          connect = window.XMLHttpRequest ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
          connect.onreadystatechange = function() {
            if(connect.readyState == 4 && connect.status == 200) {
              if(connect.responseText == 1) {
                result = '<div class="alert alert-dismissible alert-success">';
                result += '<h4>Felicidades! Registro Completo </h4>';
                result += '<p><strong>Estamos redireccionandote...</strong></p>';
                result += '</div>';
                /*Este __('_AJAX_LOGIN_') hace referencia al div del login.html que
                se guardara todo dentro de result y alla se visualizara como html*/
                __('_AJAX_REG_').innerHTML = result;
                location.reload();
              } else {
                /*Este es una parte crucial porque captura lo que esta dentro de html
                como texto y lo deja vacio como tal*/
                __('_AJAX_REG_').innerHTML = connect.responseText;
              }
            } else if(connect.readyState != 4) {
              result = '<div class="alert alert-dismissible alert-warning">';
              result += '<button type="button" class="close" data-dismiss="alert">x</button>';
              result += '<h4>Procesando...</h4>';
              result += '<p><strong>Estamos procesando tu información...</strong></p>';
              result += '</div>';
              __('_AJAX_REG_').innerHTML = result;
            }
          }
          /*Este connect.open hace la conexion con ajax para que despues los datos se envien
          a goLogin.php y alli indique el swich*/
          connect.open('POST','ajax.php?mode=reg',true);
          /*Este es un encriptado que lo hace por defecto los formularios post pero es vital
          que se establezca para que funcione nuestro metodo*/
          connect.setRequestHeader('Content-Type','application/x-www-form-urlencoded');
          /*Aqui se envia todo el formulario en conjunto tanto como el encriptado, la variable mode
          como si fuese por url y las variables*/
          connect.send(form);
        }else{
          result = '<div class="alert alert-dismissible alert-danger">';
          result += '<button type="button" class="close" data-dismiss="alert">x</button>';
          result += '<h4>ATENCIÓN</h4>';
          result += '<p><strong>Las contraseñas no coinciden.</strong></p>';
          result += '</div>';
          __('_AJAX_REG_').innerHTML = result;
        }
      }else{
        result = '<div class="alert alert-dismissible alert-danger">';
        result += '<button type="button" class="close" data-dismiss="alert">x</button>';
        result += '<h4>ATENCIÓN</h4>';
        result += '<p><strong>Su contraseña debe ser mayor a 6 caracteres.</strong></p>';
        result += '</div>';
        __('_AJAX_REG_').innerHTML = result;
      }
    }else{
      result = '<div class="alert alert-dismissible alert-danger">';
      result += '<button type="button" class="close" data-dismiss="alert">x</button>';
      result += '<h4>ATENCIÓN</h4>';
      result += '<p><strong>Por favor, rellene todos los campos</strong></p>';
      result += '</div>';
      __('_AJAX_REG_').innerHTML = result;
    }
  }else{
    result = '<div class="alert alert-dismissible alert-danger">';
    result += '<button type="button" class="close" data-dismiss="alert">x</button>';
    result += '<h4>ATENCIÓN</h4>';
    result += '<p><strong>Los términos y condiciones deben ser aceptados</strong></p>';
    result += '</div>';
    __('_AJAX_REG_').innerHTML = result;
  }

}

function runScriptReg(e) {
  if(e.keyCode == 13) {
    goReg();
  }
}
