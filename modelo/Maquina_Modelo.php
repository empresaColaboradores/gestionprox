<?php





if (!isset($_SESSION)) {
    session_start();
}




require_once 'Database.php';
require_once ('raiz_directorio_principal.php');


class Maquina extends Database {

    private $nombre_maquina;
    private $seccion_maquina;
    private $equipo_maquina;
    private $parte_equipo_maquina;
    private $detalle_seccion;
    private $id_maquina;
    private $id_seccion;

  
    function __construct() {
        parent::__construct($_SESSION['k_userName'], $_SESSION['k_userPass']);
        $this->nombre_maquina = "";
        $this->seccion_maquina = "";
        $this->equipo_maquina = "";
        $this->detalle_seccion = "";
        $this->id_maquina="";
        $this->id_seccion="";
        $this->parte_equipo_maquina="";
    }

 
    function __destruct() {
        parent::__destruct();
    }
    
    
     public function setIdMaquina($id) {
        
        if ($this->setIdMaquinaAjax($id)) {
            
        } else {
            echo('<script>alert("Seleccione un valor valido para el campo  maquina")</script>');
         
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
    
    
     public function setIdSeccion($id) {
        
        if ($this->setIdSeccionAjax($id)) {
            
        } else {
            echo('<script>alert("Seleccione un valor valido para el campo  Origen")</script>');
            raiz_amd();
             exit();
        }
    }
    
    
     public function setIdSeccionAjax($param){
        
       if ($this->GetObjetoExrg()->functionOnlyNumberCodigoResina($param)) {
            $this->id_seccion = $param;
            return true;
        }
        return false;
        
    }

    public function setNombre($nombre) {

        if ($this->setnombreAjax($nombre)) {
            
        } else {
            echo('<script>alert("Escriba un valor alfanumerico para el campo nombre ")</script>');
            Constante::rfunctionRetornarPantallaPrincipalamd();
            exit();
        }
    }

    public function setSeccionMaquina($nombre) {

        if ($this->setSeccionAjax($nombre)) {
            
        } else {
            echo('<script>alert("Escriba un valor alfanumerico para el campo seccion ")</script>');
            raiz_amd();
            exit();
        }
    }
    
    public function setEquiponMaquina($nombre) {

        if ($this->setEquipoAjax($nombre)) {
            
        } else {
            echo('<script>alert("Escriba un valor alfanumerico para el campo equipo ")</script>');
            raiz_amd();
            exit();
        }
    }
    
     public function setParteEquiponMaquina($nombre) {

        if ($this->setParteEquipoAjax($nombre)) {
            
        } else {
            echo('<script>alert("Escriba un valor alfanumerico para el campo equipo ")</script>');
            raiz_amd();
            exit();
        }
    }

    public function setIdEmpresa($id) {

        if ($this->setIdEmpresaAjax($id)) {
            
        } else {
            echo('<script>alert("Escriba un valor numerico para el codigo de empresa")</script>');
      
            exit();
        }
    }

    public function setIdEmpresaAjax($param) {

        if ($this->GetObjetoExrg()->functionOnlyNumberCodigoResina($param)) {
            $this->id = $param;
            return true;
        }
        return false;
    }

    public function setnombreAjax($param) {



        if ($this->GetObjetoExrg()->functionExpRS($param)) {
            $this->nombre_maquina = $this->desinfeccionDeVariables($param);
            return true;
        }
        return false;
    }

    public function setSeccionAjax($param) {


           
        if ($this->GetObjetoExrg()->functionExpRS($param)) {
            $this->seccion_maquina = $this->desinfeccionDeVariables($param);
            
             
            return true;
        }
        return false;
    }
    
    public function setEquipoAjax($param) {


           
        if ($this->GetObjetoExrg()->functionExpRS($param)) {
            $this->equipo_maquina = $this->desinfeccionDeVariables($param);
            
             
            return true;
        }
        return false;
    }
    
     public function setParteEquipoAjax($param) {


           
        if ($this->GetObjetoExrg()->functionExpRS($param)) {
            $this->parte_equipo_maquina = $this->desinfeccionDeVariables($param);
            
             
            return true;
        }
        return false;
    }

    public function setDetalleSeccion($detalle) {
        $this->detalle_seccion = $this->desinfeccionDeVariables($detalle);
        
       
    }

    public function getNombre() {
        return $this->nombre_maquina;
    }

    public function getIdMaquina() {

        return $this->nit_cc;
    }

    public function registrarMaquina() {
        $this->query("  CALL Maquina_crear('$this->nombre_maquina','$this->id')");
    }

    public function registrarSeccionMquina() {
        return $this->query("call  Maquina_crearSeccion('$this->seccion_maquina','$this->detalle_seccion','$this->id')");
    }
    
    public function registrarEquipoMquina() {
        return $this->query("call  Maquina_crearEquipo('$this->equipo_maquina','$this->detalle_seccion','$this->id')");
    }
    
    public function registrarParteEquipoMquina() {
        return $this->query("call  Maquina_crearParte('$this->parte_equipo_maquina','$this->detalle_seccion','$this->id')");
    }
    
     public function consultarSeccionMaquina() {
        return $this->query("CALL MaquinaConsultar_Seccion('$this->seccion_maquina','$this->detalle_seccion','$this->id');"); 
         
    }
    
    
     public function consultarEquiponMaquina() {
        return $this->query("CALL MaquinaConsultar_Equipo('$this->equipo_maquina','$this->id');"); 
         
    }
    
     public function consultarPartesDeMaquina($id_maquina,$id_seccion,$id_equipo) {
        return $this->query("CALL Maquina_buscarSeccionEquipoParte('$this->id','$id_maquina','$id_seccion','$id_equipo');"); 
         
         
    }
    
    
    
    public function consultarParteEquiponMaquina() {
        return $this->query("CALL Maquina_consultarParteRegistrada('$this->parte_equipo_maquina','$this->id');"); 
         
    }
    
     public function consultarRelacionSeccionMaquina() {
        
        return $this->query(" CALL Bitacora_consultarReslacionSeccionMAquina('$this->id_maquina','$this->id','$this->id_seccion')");
    }
    
    
    public function consultarRelacionMaquinaEquipo() {
        
       return $this->query(" CALL Maquina_consultarRelacionMaquinaEquipo('$this->equipo_maquina','$this->id_maquina','$this->id')");
      
        
     
    }
    
     public function consultarRelacionMaquinaParte() {
        
       return $this->query(" CALL Maquina_consultarRelacionParteMaquina('$this->parte_equipo_maquina','$this->id_maquina','$this->id')");
        
     
    }
    
    public function consultarRelacionParteEquipo() {
        
       return $this->query(" CALL Maquina_consultaRelacionEquipoParte('$this->parte_equipo_maquina','$this->equipo_maquina','$this->id')");
        
     
    }
    
    public function consultarRelacionSeccionEquipo() {
        
        return $this->query(" CALL Maquina_consultarReslacionSeccionEquipo('$this->id_seccion','$this->equipo_maquina','$this->id')");
     
    }
    
    public function relacionSeccionMaquina() {
        return $this->query("call Bitacora_relacionraSeccionMaquina('$this->id_seccion','$this->id','$this->id_maquina')"); 
    }
    
    
     public function relacionMaquinaSeccionEquipo() {
        return ("call MaquinaRelacionarEquipoSeccion('$this->equipo_maquina','$this->id_seccion','$this->id')"); 
    }
    
    
   
    
    public function relacionMaquinaEquipo(){
        
               return ("call MaquinaRelacionEquipoMaquina('$this->equipo_maquina','$this->id_maquina','$this->id')"); 
    }
    
  
    
    public function relacionMaquinaParteEquipo(){
        
               return ("call Maquina_relacionarParteMaquina('$this->parte_equipo_maquina','$this->id_maquina','$this->id')"); 
    }
    
    
    
    
    public function relacionParteEquipo(){
        
               return ("call Maquina_relacionarEquipoParte('$this->parte_equipo_maquina','$this->equipo_maquina','$this->id')"); 
    }
    
   
    
    
    public function consultarMaquinaSeccionEquipoRegistrado(){
        
         return $this->query("call Maquina_consultarMaquinaSeccionEquipo('$this->id_maquina','$this->id_seccion','$this->id')"); 
        
       
        
    }


   
     public function consultarRelacionSeccionMaquinaMostrar() {
        return $this->query("CALL Bitacora_consultarRelacionSeccionMAquina('$this->id','$this->id_maquina');");
         
    }
    
    
    
     public function consultarRelacionParteMaquinaMostrar() {
        return $this->query("CALL Bitacora_consultarRelacionParteMaquina('$this->id','$this->id_maquina',' $this->equipo_maquina');");
         
    }

   
    public function consultarNombreMaquina($id_empresa) {
        return $this->query("call Maquina_ComprobarExistencia_Maquina('$this->nombre_maquina','$id_empresa')");
    }

    public function actualizaNombreEmpresa() {
        return $this->query("CALL Empresa_Update('$this->nit_cc','$this->nombre_maquina');");
    }

    public function consultarMaquinaDuplicada() {

        return $this->query("CALL Maquina_consultaNombre('$this->nombre_maquina','$this->id');");
    }

    public function consultarMaquinasRegistradas($id_maquina, $nombre_maquina) {

        return $this->query("CALL Maquina_BuscarMaquinaRegistrada('$this->id','$nombre_maquina','$id_maquina')");
        
    }

    public function consultarSeccion() {
        return $this->query("CALL Maquina_consultarSeccion('$this->seccion_maquina','$this->id');");
    }
    
    public function consultarEquipo() {
        return $this->query("CALL Maquina_consultarEquipo('$this->equipo_maquina','$this->id');");
        
    }
    
    public function consultarParte() {
        return $this->query("CALL Maquina_consultarParte('$this->parte_equipo_maquina','$this->id');");
        
    }
    
    
    public function consultarSeccionParametros($id_seccion,$nombre_seccion,$descrip_seccion) {
       return $this->query("CALL Maquina_consultarSeccionPorParametro('$id_seccion','$nombre_seccion','$descrip_seccion','$this->id');");
       
    }
    
    public function consultarEquipoParametros($id_equipo,$nombre_equipo,$descrip_seccion) {
       return $this->query("CALL Maquina_ConsultarEquipoPorParametro('$id_equipo','$nombre_equipo','$descrip_seccion','$this->id');");
       
       
    }
    
  
     public function consultarParteEquipo($id_equipo,$nombre_equipo,$descrip_seccion) {
       return $this->query("CALL Maquina_ConsultaParteEquipo('$id_equipo','$nombre_equipo','$descrip_seccion','$this->id');");
       
       
    }

    public function registrarSeccion() {
        return $this->query("call Defecto_crear('$this->nombre','$this->ida')");
    }
    
    

}


?>
