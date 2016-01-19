<?php



class Operador_refactorizado extends Database {
    
    
    private $id_operador;
    const NO_EXISTE_REGISTRO=0;
    
    
    public function __construct() {
        parent::__construct();
    }
    
    public function setIdOperador($id_operador){        
        $this->id_operador = (int)$id_operador;

        
        
    }
    
    public function getIdOperador(){
        return $this->id_operador;
    }

        public function existsOperador() {

        
        if (($this->consultaExistenciaOperador()) == self::NO_EXISTE_REGISTRO) {
            mensajeDeErrorModal($titulo = 'EL OPERADOR SELECCIONADO NO EXISTE'
                    , $subtitulo = 'Seleccione un operador de la lista desplegable'
                    , $mensaje = 'Para un mejor resultado , consulte los operadores registrados  en su sistema, para esto pongase en contacto con el administrador');
            exit();

        }
    }
    
    private function consultaExistenciaOperador(){
        
        $consulta = $this->consultaOperador();
        return $consulta->num_rows;
    }

    public function consultaOperador() {
        return $this->query("CALL Opereador_ComprobarExistencia_Operador('$this->id_operador','$this->id')");
        
        }
}

?>
