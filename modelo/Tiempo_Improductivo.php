<?php



// require 'Database.php'; descomentar para probar la clase
//require_once 'Constantes.php'; descomentar para probar la clase

//require 'modal_consulta.php'; descomentar para probar la clase 






class TipoTiempo_Improductivo  extends Database {

    

    private $id_tipoTiempoImproductivo;
    private $nombre;

    public function __construct() {
        parent::__construct();
    }

    public function setIdEmpresa($param) {
        parent::setIdEmpresa($param);
    }

    public function setIdTipoTiempoImproductivo($id) {
        $this->id_tipoTiempoImproductivo = (int)$id;
    }

    public function setNombre($nombre) {
        $this->nombre = $nombre;
    }

    public function getIdTiempoImproductivo() {
        return $this->id_tipoTiempoImproductivo;
    }

    public function getNombre() {

        return $this->nombre;
    }

    public function existsTipoCausaTiempoImproductivo() {

        if ($this->consultaExistenciaTipoCausaTiempoImproductivo() == NO_EXISTE_REGISTRO) {
            mensajeDeErrorModal($titulo = 'EL TIPO DE CAUSA NO EXISTE'
                    , $subtitulo = 'Seleccione uno  de la lista desplegable'
                    , $mensaje = 'Para un mejor resultado , consulte los  tipos de causas registradas  en su sistema, para esto pongase en contacto con el administrador');
            exit();
            
            
        }
    }

    private function consultaExistenciaTipoCausaTiempoImproductivo() {

        $consulta = $this->consultaTipoCausaTiempoImproductivo();
        return $consulta->num_rows;
    }

    public function consultaTipoCausaTiempoImproductivo() {
      
          return $this->query("CALL Bitacora_consultarExistenciaTipoDeCausa('$this->id_tipoTiempoImproductivo','$this->id')");


        
       
    }

}

class Tiempo_Improductivo extends TipoTiempo_Improductivo {

   

    private $descripcion;
    private $id_causa;
    

    public function __construct() {
        parent::__construct();
    }

    public function setIdEmpresa($param) {
        parent::setIdEmpresa($param);
    }
    
    public function setIdCausa($idCausa) {
        $this->id_causa = (int) $idCausa;
    }
    
    public function getIdCausa(){
        return $this->id_causa;
    }

    public function setDescripcion($descripcion) {
        $this->descripcion = $descripcion;
    }

    public function getDescripcion() {
        return $this->descripcion;
    }

    public function  existsCausa() {

        if ($this->consultaExistenciaCausaTiempoImproductivo() == NO_EXISTE_REGISTRO) {
            
            mensajeDeErrorModal($titulo = 'LA CAUSA DE TIMEMPO IMPRODUCTIVO NO EXISTE'
                    , $subtitulo = 'Seleccione una  de la lista desplegable'
                    , $mensaje = 'Para un mejor resultado , consulte las causas registradas  en su sistema, para esto pongase en contacto con el administrador');
            exit();

            
        }
    }

    private function  consultaExistenciaCausaTiempoImproductivo() {

        $consulta = $this->consultaCausaTiempoImproductivo();
        return $consulta->num_rows;
    }

    public function  consultaCausaTiempoImproductivo() {
        
          return $this->query("CALL Bitacora_consultarExistenciaCausa('".$this->id_causa."','$this->id')");
        
    }

}



?>
