<?php


class ParteMaquina extends EquipoMaquina {
    //put your code here
    
    private $parte_equipo;
    
    public function __construct() {
        parent::__construct();
    }
    
     public function setIdParteMaquina($id_parte){         
         $this->parte_equipo=$id_parte;    
       
    }
    
    public function getIdparteMaquina(){
        
        return $this->parte_equipo;
    }
    
    public function setIdEmpresa($param) {
        parent::setIdEmpresa($param);
    }


    
 public function existsParteEquipoMaquina() {
        
        if ($this->consultaExistenciaParte()==NO_EXISTE_REGISTRO) {
            mensajeDeErrorModal($titulo = 'LA PARTE DEL EQUIPO SELECCIONADO NO EXISTE'
                    , $subtitulo = 'Seleccione una parte de la lista desplegable'
                    , $mensaje = 'Para un mejor resultado , consulte las  partes de los equipos registradas en su sistema, para esto pongase en contacto con el administrador');
            exit();

        }
    }
    
    private function consultaExistenciaParte() {
        
       $consulta = $this->consultaExistenciaParteEquipoMaquina();
        return $consulta->num_rows;
        
    }
    
    public function consultaExistenciaParteEquipoMaquina() {

        return $this->query("CALL Bitacora_consultarExistenciaParteEquipo('$this->parte_equipo','$this->id')");
    }
    
    
}

?>
