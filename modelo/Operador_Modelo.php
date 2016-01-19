<?php




if (!isset($_SESSION)) {
    session_start();
}


require_once 'Database.php';
require_once ('raiz_directorio_principal.php');


class Operador extends Database {

    private $nombre;
    private $apellido;
    private $id_empresa;
    private $id_operador;
    private $id_maquina;
    

   
    function __construct() {
        parent::__construct($_SESSION['k_userName'], $_SESSION['k_userPass']);
        $this->nombre= "";
        $this->apellido= "";
        $this->id_empresa= "";
        $this->id_operador="";
        $this->id_maquina="";
        
    }

  
    function __destruct() {
        parent::__destruct();
    }

    public function setNombre($nombre) {
        
        if ($this->setnombreAjax($nombre)) {
            
        } else {
            echo('<script>alert("Escriba un valor alfanumerico para el campo nombre ")</script>');
            raiz_amd();
            exit();
        }
        
    }
    
    
    public function setApllido($apellido) {
        
        if ($this->setApllidoAjax($apellido)) {
            
        } else {
            echo('<script>alert("Escriba un valor alfanumerico para el campo apellido ")</script>');
           raiz_amd();
            exit();
        }
        
    }
    
     public function setIdEmpresa($id_empresa){
        $this->id_empresa = $id_empresa;
    }
    
    
    
    
    
    
    
    
     public function setnombreAjax($param) {

      

        if ($this->GetObjetoExrg()->functionExpRS($param)) {
            $this->nombre= $this->desinfeccionDeVariables($param);
            return true;
        }
        return false;
    }
    
    
     public function setApllidoAjax($param) {

       

        if ($this->GetObjetoExrg()->functionExpRS($param)) {
            $this->apellido= $this->desinfeccionDeVariables($param);
            return true;
        }
        return false;
    }
    
    
    
     public function setIdMaquina($id) {
        
        if ($this->setIdMaquinaAjax($id)) {
            
        } else {
            echo('<script>alert("Seleccione un valor valido para el campo  maquina")</script>');
          raiz_amd();
             exit();
        }
    }
    
    
    public function setIdMaquinaAjax($param){
        
       if ($this->GetObjetoExrg()->functionOnlyNumberCodigoResina($param)) {
            $this->id_maquina = $param;
            return true;
        }
        return false;
        
    }
    
    
    public function setIdOperador($id) {
        
        if ($this->setIdOperadorAjax($id)) {
            
        } else {
            echo('<script>alert("Seleccione un valor valido para el campo  operador")</script>');
           raiz_amd();
             exit();
        }
    }
    
    
    public function setIdOperadorAjax($param){
        
        
        
       if ($this->GetObjetoExrg()->functionOnlyNumberCodigoResina($param)) {
            $this->id_operador = $param;
            return true;
        }
        return false;
        
    }
    
   
    
    

   
    

    public function getNombre() {
        return $this->nombre;
    }
    
    public function getApellido() {
        return $this->apellido;
    }
    
   
    
    
    

   
    public function registrarOperador() {
       return $this->query("  CALL Operador_registrar('$this->nombre','$this->apellido','$this->id_empresa')");
        
        
    }
    
     public function consultarRelacionOperadorMaquina() {
       return $this->query(" call Operador_RelacionMaquinaConsultarDuplicado('$this->id_maquina','$this->id_operador','$this->id_empresa')");
    }
    
    public function relacionOperadorMaquina() {
         return $this->query("  call Operador_relacionarOperadorMaquina('$this->id_maquina','$this->id_operador','$this->id_empresa')");
    }
    
     public function consultarOperadorMaquina() {
       return $this->query(" call Operador_mostrarRelacionMaquina('$this->id_empresa');");
    }
    
    public function eliminarRelacionOperadorMaquina() {
         return $this->query("  call eliminarRelacionOperadorMaquina('$this->id_empresa','$this->id_maquina','$this->id_operador')");
    }
    
    
    
     public function listarOperadorMaquina($id_maquina,$id_operador) {
      // 
         return $this->query(" call Operadores_listarOperadoresMaquina('$id_operador','$id_maquina','$this->id_empresa');"); exit();
    }
    
    

    
    
    
    public function actualizaNombreEmpresa(){
        return $this->query("CALL Empresa_Update('$this->nit_cc','$this->nombre');");
    }
    
    public function consultarOperadorDuplicado(){
        
         return $this->query("CALL Operador_buscar('$this->nombre','$this->apellido','$this->id_empresa');");
        
        
    }
    
    
    public function consultaOperador($id_operador,$nombre,$apellido){        
       return $this->query("CALL Operador_buscar_todos('$id_operador','$nombre','$apellido','$this->id_empresa');"); 
        
        
    }
    
    
    

}

?>
