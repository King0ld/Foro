<?php

class ConfigForos{

  private $id;
  private $db;
  private $nombre;
  private $descrip;
  private $estado;
  private $categoria;

  public function __construct(){
    $this->db = new Conexion();
  }

  private function Errors($url,$add_mode = false){

    //Dentro de una funcion la funcion Categoria no tiene acceso, aqui la podemos usar.
    global $_categorias;

    try {
      //Esta condicion evalua que ningun campo en foro este vacio y $_POST['estado'] es una medida que si el usuario
      //elimina el checked por html no se envie vacio a la base de datos y genere error.
      if(empty($_POST['nombre']) or empty($_POST['descrip']) or !isset($_POST['estado'])){
        throw new Exception(1);
      }else{
        $this->nombre = $this->db->real_escape_string($_POST['nombre']);
        $this->descrip = $this->db->real_escape_string($_POST['descrip']);
        $this->descrip = str_replace(
          array('<script>','</script>','<script src=', '<script type='),
          '',
          $this->descrip
        );
        //Esta condicion evalua que estado sea solo 1 y 0 para abierto y cerrado de otra manera que un usario digite otra cosa
        //que no sea 1 ni cero se le asignara 0.
        if($_POST['estado'] == 1){
          $this->estado = 1;
        }else{
          $this->estado = 0;
        }
      }
      //Esta condicion evalua dos cosas que la idsea numerica y que tambien pertenezca a un id que este en la base de datos.
      //Eso recibe dos parametros el id que se va a evaluar y el arreglo donde se averiguara su existencia.
      if (array_key_exists($_POST['categoria'], $_categorias)) {
        $this->categoria = intval($_POST['categoria']);
      }else{
        throw new Exception(2);
      }
    } catch (Exception $error) {
      header('Location: '. $url . $error->getMessage());
    }

  }

  public function Add(){
    $this->Errors('?view=configforos&mode=add&error=',true);
    $this->db->query("INSERT INTO foros (nombre, descrip, id_categoria, estado) VALUES ('$this->nombre', '$this->descrip', '$this->categoria', '$this->estado');");
    header('Location: ?view=configforos&mode=add&success=true');
  }

  public function Edit(){
    $this->id = intval($_GET['id']);
    $this->Errors('?view=configforos&mode=edit&id='.$this->id.'&error=');
    $this->db->query("UPDATE foros SET nombre='$this->nombre', descrip='$this->descrip', id_categoria='$this->categoria', estado='$this->estado' WHERE id='$this->id';");
    header('Location: ?view=configforos&mode=edit&id='.$this->id.'&success=true');
  }

  public function Delete(){
    $this->id = intval($_GET['id']);
    $query = "DELETE FROM foros WHERE id='$this->id';";
    $query .= "DELETE FROM temas WHERE id_foro='$this->id';";
    $this->db->multi_query($query);
    header('Location: ?view=configforos&success=true');
  }

  public function __destruct(){
    $this->db->close();
  }
}

?>
