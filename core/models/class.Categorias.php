<?php

class Categorias {
  private $db;
  private $id;
  private $nombre;

  public function __construct(){
    //Esta conexion hace que no tenga que instanciarse la conexion
    $this->db = new Conexion();
  }

  //Funcion privada Errores solo para Edit y Delete

  private function Errors($url){
    try {
      if(empty($_POST['nombre'])){
        throw new Exception(1); //Arroja una excepcion ERROR
      }else{
        //Se le asigna el nombre de la categoria y se le protege.
        $this->nombre = $this->db->real_escape_string($_POST['nombre']);
      }
    } catch(Exception $error) {
      header('Location: '.$url .$error->getMessage());
      exit; //Sale del bucle totalmente
    }
  }

  public function Add(){
    //La conexion establecida anteriormente hace que en la query no tenga que usarse la conexion dentro de la funcion Add, Edit, Delete
    $this->Errors('?view=categorias&mode=add&error=');
    console.log($this->nombre);
    $this->db->query("INSERT INTO categorias (nombre) VALUES ('$this->nombre');");
    header('Location: ?view=categorias&mode=add&success=true');
  }

  public function Edit(){
    //Este Errors esta llamando la funcion Errors entonces la url que se esta pasando
    //a Errors es lo que va a ir al atributo $url de la funcion Errors
    $this->id = intval($_GET['id']);
    //Aqui se establece en Errors la variable &error con nada porque sera false por default porque esta vacia
    $this->Errors('?view=categorias&mode=edit&id='.$this->id.'&error=');
    $this->db->query("UPDATE categorias SET nombre='$this->nombre' WHERE id='$this->id';");
    header('Location: ?view=categorias&mode=edit&id='.$this->id.'&success=true');//Este success es para que salga el mensaje de que todo se a enviado correctamente
  }

  public function Delete(){
    $this->id = intval($_GET['id']);

    //Lo siguiente es una multiquery.
    //Se usa una multiquery porque para borrar una categoria deben borrarse todos los temas tambien dentro de ella y usamos
    //la llave foranea para eso. Aqui que la query empieza y en el while recoge todo lo demas y se ejectuta en la multiquery
    $q = "DELETE FROM categorias WHERE id='$this->id';";
    $q .= "DELETE FROM foros WHERE id_categoria='$this->id';";


    $sql = $this->db->query("SELECT id FROM foros WHERE id_categoria='$this->id';");
    if ($this->db->rows($sql) > 0) {
      while($data = $this->db->recorrer($sql)){
        $id_foro = $data[0];
        $q .= "DELETE FROM temas WHERE id_foro='$id_foro';";
      }
    }
    $this->db->liberar($sql);
    $this->db->multi_query($q);
    header('Location: ?view=categorias');
  }

 //Inmediatamente entra a esta clase y se realiza la funcion se destruye la clase y se cierra la conexion
  public function __destruct(){
    $this->db->close();
  }
}

?>
