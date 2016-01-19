<?php

//require_once 'Constantes.php'; descomentar para probar la clase


class SeccionMaquina extends Maquina_refactorizada {
    //put your code here
    
    private $id_seccion;
    
    public function __construct() {
        parent::__construct();
    }
    
     public function  setIdSeccion($id_seccion){
        $this->id_seccion=$id_seccion;
    }
    
    public function getIdSeccion() {
        return $this->id_seccion;
    }


    public function setIdEmpresa($param) {
        parent::setIdEmpresa($param);
    }


    public function existsSeccionMaquina() {
   
        if ($this->consultaExistenciaSeccion()==NO_EXISTE_REGISTRO) {
            mensajeDeErrorModal($titulo = 'LA SECCION SELECCIONADA NO EXITE'
                    , $subtitulo = 'Seleccione una seccion de la lista desplegable'
                    , $mensaje = 'Para un mejor resultado , consulte las secciones registradas en su sistema, para esto pongase en contacto con el administrador');
            exit();

        }
    }
    
    private function consultaExistenciaSeccion(){
        
         $mysqli_result = $this->consultaSeccion();
         return $mysqli_result->num_rows;
    }

    public function consultaSeccion() {
        return $this->query("CALL Bitacora_consultar_seccionMaquina('$this->id_seccion','$this->id')");
    }
    
    
   
    
   
}

?>




