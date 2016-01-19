<?php

require 'Database.php';
require 'GenerarListaDesplegable.php';


class Area_refactorizada extends Database {

    //put your code here
    private $id_area;
    private $nombreArea;
    private $listaDesplegable;

    const NO_EXISTE_REGISTRO=0;
     const EXISTE_REGISTRO=1;

    public function __construct() {
        
        $this->listaDesplegable = new GenerarListaDesplegable();
        parent::__construct();
    }

    public function setIdArea($id) {
        $this->id_area = (int)$id;
    }
    
    public function setNombreArea($nombreArea){
        $this->nombreArea = mb_strtoupper($nombreArea, 'UTF-8');
    }

    public function getIdarea() {
        return $this->id_area;
    }

    public function setIdEmpresa($param) {
        parent::setIdEmpresa($param);
    }
    
    

    public function existsArea() {

        if ($this->consultaExistenciaArea() == self::EXISTE_REGISTRO) {

            mensajeDeErrorModal(
                    $titulo = 'EL AREA YA EXISTE'
                    , $subtitulo = 'no es posible registrar nombres duplicados'
                    , $mensaje = 'Para un mejor resultado , consulte de las areas registradas en su sistema, para esto pongase en contacto con el administrador');
            exit();
        }
    }

    private function consultaExistenciaArea() {

        $consulta = $this->consultaArea();
        return $consulta->num_rows;
    }

    private function consultaArea() {       
        
        return $this->query("CALL Area_consultaArea('$this->id','$this->nombreArea')");
    }
    
      public function registrarArea() {
        $this->query("  CALL Area_crearArea('$this->nombreArea','$this->id')");
    }
    
     public function visualizarAreRegistrada() {
         
         $id= $this->optenerUltimoConsecutivoRegistrado();

        return $this->query("CALL Area_visualizarAreaRegistrada('$id','$this->id');");
         
    }
    
      private function optenerUltimoConsecutivoRegistrado() {

        $consulta = $this->query("SELECT LAST_INSERT_ID() id;");
        $rowcount = $consulta->fetch_array(MYSQLI_ASSOC);
        $id_bitacora = $rowcount['id'];

        return $id_bitacora;
    }
    

    public function contarMaquinasSegunArea($id_area) {

        $mysqli_result = $this->listaDoDeMaquinaSegunArea($id_area);
        $countMaquina = $mysqli_result->num_rows;
        return $countMaquina;
    }

    

    public function getIdMaquinaSegunArea($id_area) {
        $mysqli_result = $this->listaDoDeMaquinaSegunArea($id_area);
        $obJeto = $mysqli_result->fetch_object();
        $id_maquina = $obJeto->id_maquina;

        return $id_maquina;
    }
    
    
      public function cargar_area() {
        $consulta = $this->query("CALL  Area_listadoAreas($this->id) ");
          
        $num_total_registros = $consulta->num_rows;
        if ($num_total_registros > 0) {

            return $this->listaDesplegable->generarListadoDesplegable($consulta, 'id_area', 'nombre_area');
        } else {
            return false;
        }
    }
    
    
    public  function existRelacionBetweenAreaUsuario($nombreUsuario){
        
        return (($this->consultaRelacionAreaUsuario($nombreUsuario)->num_rows) <= 0);
        
        
    }
    
    


    private function consultaRelacionAreaUsuario($nombreUsuario) {
        
        return $this->query(" CALL Area_comprobarRelacionUsuarioArea('$this->id_area','$this->id','$nombreUsuario')");
       
    }
    
    public function existRelacionBetweenAreaMaquina($id_maquina){
        
            return (($this->consultaRelacionAreaMaquina($id_maquina)->num_rows) <= 0);
        
    }
    
    private function consultaRelacionAreaMaquina($id_maquina){
        
          return $this->query("CALL Area_existRelacionAreaMaquina('$this->id_area','$id_maquina','$this->id') ");
         
        
    }
    
    
    public function relacionarAreaUsuario($nombre_usuario){        
        return $this->query("CALL  Area_relacionarAreaUsuario('$nombre_usuario',$this->id_area,$this->id) ");
         
    }
    
    
    public function visualizarRelacionAreaUsuario($nombreUsuario){
        
       return $this->query("CALL  Area_visualizarRelacionAreaUsuario('$nombreUsuario',$this->id_area,$this->id) ");
        
        
    }
    
     public function relacionarAreaMaquina($id_maquina){        
        return $this->query("CALL Are_registrarRelacionAreaMaquina($this->id_area,'$id_maquina','$this->id') ");
         
    }
    
     public function visualizarRelacionAreaMaquina($id_maquina){
         
       return $this->query("CALL Area_visualizarRealacionAreaMaquina('$id_maquina',$this->id) ");
        
        
    }
    
    public function consultarRelacionAreaUsuario($nombreUsuario,$id_area){        
        return $this->query("CALL  Area_consultarRelacionAreaUsuario('$nombreUsuario','$id_area',$this->id) ");
       
    }
    
    public function consultarArea($id_area,$nombre_area) {
       return $this->query("CALL Area_consultarArea('$id_area','$nombre_area','$this->id');");
       
       
    }
    
     public function consultarRelacionAreaMaquina($id_maquina,$id_area){        
        return $this->query("CALL  Area_consultarRelacionAreaMaquina($this->id) ");
         
       
    }
    
    
    
    

}

?>
