<?php

class Temas{
    private $db;
    private $id;
    private $titulo;
    private $content;
    private $id_foro;
    private $id_dueno;

    public function __construct(){
      $this->db = new Conexion();
      $this->id = isset($_GET['id']) ? intval($_GET['id']) : null;
      $this->id_foro = intval($_GET['id_foro']);
      $this->id_dueno = isset($_SESSION['app_id']) ? $_SESSION['app_id'] : null;
    }

    private function Errors($url){
      try {
        if(empty($_POST['titulo']) or empty($_POST['content'])){
          throw new Exception(1);
        }else{
          $this->titulo = $this->db->real_escape_string($_POST['titulo']);
          $this->content = $this->db->real_escape_string($_POST['content']);
        }
        if(strlen($this->titulo) < MIN_TITULOS_TEMAS_LONGITUD){
          throw new Exception(2);
        }

        if(strlen($this->content) < MIN_CONTENT_TEMAS_LONGITUD){
          throw new Exception(3);
        }
      } catch (Exception $error) {
        header('Location: '. $url . $error->getMessage());
        exit;
      }

    }

    public function Add(){
      $this->Errors('?view=temas&mode=add&id_foro='.$this->id_foro.'&error=');
      $fecha = date('d/m/Y h:i a', time());
      $this->db->query("INSERT INTO temas (titulo,contenido,id_foro,id_dueno,fecha,id_ultimo,fecha_ultimo)
      VALUES ('$this->titulo','$this->content','$this->id_foro','$this->id_dueno','$fecha','$this->id_dueno','$fecha');");
      $id_tema = $this->db->insert_id;
      $this->db->query("UPDATE foros SET cantidad_temas=cantidad_temas + '1',
      cantidad_mensajes=cantidad_mensajes + '1',ultimo_tema='$this->titulo',id_ultimo_tema='$id_tema' WHERE id='$this->id_foro';");
      header('Location: temas/' . UrlAmigable($id_tema,$this->titulo,$this->id_foro));
    }

    public function Edit(){
      $this->Errors('?view=temas&mode=edit&id='.$this->id.'&id_foro='.$this->id_foro.'&error=');
    }

    public function Close(){

    }

    public function Anuncio(){

    }

    public function Check(){
      $sql = $this->db->query("SELECT * FROM temas WHERE id='$this->id' LIMIT 1;");
      if($this->db->rows($sql) > 0){
        $tema = $this->db->recorrer($sql);

      }else{
        $tema = false;
      }
      $this->db->liberar($sql);

      return $tema;
    }

    public function __destruct(){
      $this->db->close();
    }
}
