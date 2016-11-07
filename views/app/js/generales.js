function __(id){
  return document.getElementById(id);
}

//lo siguiente es solo una confirmacion y saldra una ventana
 function DeleteItem(contenido,url) {
   var action = window.confirm(contenido);
   if (action) {
       window.location = url;
   }
 }
