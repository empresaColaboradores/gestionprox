<?php

//require_once 'Constantes.php'; descomentar para probar la clase


class EquipoMaquina extends SeccionMaquina {

    //put your code here

    private $id_equipo;

    public function __construct() {
        parent::__construct();
    }

    public function setIdEquipo($id_equipo) {

        $this->id_equipo = $id_equipo;
    }
    
    public function setIdEmpresa($param) {
        parent::setIdEmpresa($param);
    }
    
    public function getIdEquipo(){
        return $this->id_equipo;
    }

    

    public function existsEquipo() {

        if ($this->consultaExistenciaEquipo() == NO_EXISTE_REGISTRO) {

            mensajeDeErrorModal($titulo = 'EL EQUIPO SELECCIONADO NO EXITE'
                    , $subtitulo = 'Seleccione un equipo de la lista desplegable'
                    , $mensaje = 'Para un mejor resultado , consulte los equipos registradas en su sistema, para esto pongase en contacto con el administrador');
            exit();
        } 
    }

    private function consultaExistenciaEquipo() {

        $consulta = $this->consultaEquipo();
        return $consulta->num_rows;
    }

    public function consultaEquipo() {
         return $this->query("CALL Bitacora_consultarExistenciaEquipo('$this->id_equipo','$this->id')"); 
    }

   

}

?>
