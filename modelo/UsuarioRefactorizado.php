<?php

class UsuarioRefactorizado  extends Database{
    
   
    private $nombre_usuario;
    private $listaDesplegable;




    public function __construct() {
        parent::__construct();
        $this->listaDesplegable = new GenerarListaDesplegable();
    }
    
    
    public function setIdEmpresa($param) {
        parent::setIdEmpresa($param);
    }
    
    
    public function setNombreUsuario($nombreUsuario){
        
        $this->nombre_usuario=$nombreUsuario;
        
    }
    
    public function getNombreUsuario(){
        
        return $this->nombre_usuario;
    }
    
     public function cargar_usuario() {
        $consulta = $this->query("CALL  Usuario_listaDesplegable($this->id) ");
          
          
        $num_total_registros = $consulta->num_rows;
        if ($num_total_registros > 0) {

            return $this->listaDesplegable->generarListadoDesplegable($consulta, 'usuario', 'usuario');
        } else {
            return false;
        }
    }
    
    public function cargar_usuarioPorCodigo() {
        $consulta = $this->query("CALL  getListadoUsuarioPorCodigo($this->id) ");
          
          
        $num_total_registros = $consulta->num_rows;
        if ($num_total_registros > 0) {

            return $this->listaDesplegable->generarListadoDesplegable($consulta, 'id_usuario', 'usuario');
        } else {
            return false;
        }
    }
    
   
    
    
}

?>
