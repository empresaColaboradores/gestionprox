<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */



if (!isset($_SESSION)) {
    session_start();
}





require_once 'Database.php';

/**
 * esta clase  tiene el objetivo de
 * manejar todo lo relacionado con una empresa
 * en la aplicacion
 * registro
 * actualizacion
 * la eliminacion no se contempla
 * validando todos los datos recibidos
 * para  mantener  la integridad en todas las transacciones
 *  en caso de presentarse algun error en alguna peticion con respecto
 * a registro o actualizacion de datos de un cliente la clase mostrara
 * un mensaje al uusario del error, si las transacciones son exitosas
 * se muestran los datos registrados o de actualizacion en un formulario de
 * vizualizacion.
 * 
 *  
 */
class Empresa extends Database {

    private $nombre_empresa;
    private $nit_cc;
    

    /**
     * el constructor esta encargado de
     * realizar la conexion a la bd 
     * a travez de la clase  heredada Database
     */
    function __construct() {
        parent::__construct($_SESSION['k_userName'], $_SESSION['k_userPass']);
        $this->nombre_empresa = "";
        $this->nit_cc="";
        $this->id="";
    }

    /**
     * libera la memoria 
     * despues de destruir el objecto Cliente
     * cerrando toda conexion con la BD 
     */
    function __destruct() {
        parent::__destruct();
    }

    public function setNombre($nombre) {
        
        if ($this->setnombreAjax($nombre)) {
            
        } else {
            echo('<script>alert("Escriba un valor alfanumerico para el campo nombre ")</script>');
            Constante::rfunctionRetornarPantallaPrincipalamd();
            exit();
        }
        
    }
    
     public function setNit_cc($nit_cc) {
        
        if ($this->setNit_ccAjax($nit_cc)) {
            
        } else {
            echo('<script>alert("Escriba un valor valido para el campo nit(800.800.800-5) o cedula(73.216.155) solo es posible ingresar numeros punto o guin medio")</script>');
            Constante::rfunctionRetornarPantallaPrincipalamd();
             exit();
        }
    }
    
    
     public function setIdEmpresa($id) {
        
        if ($this->setIdEmpresaAjax($id)) {
            
        } else {
            echo('<script>alert("Escriba un valor numerico para el codigo de empresa")</script>');
            Constante::rfunctionRetornarPantallaPrincipalamd();
             exit();
        }
    }
    
    
    public function setIdEmpresaAjax($param){
        
       if ($this->GetObjetoExrg()->functionOnlyNumberCodigoResina($param)) {
            $this->id = $param;
            return true;
        }
        return false;
        
    }
    
    
    
    
    
     public function setnombreAjax($param) {

        $param = parent::desinfeccionDeVariables($param);

        if ($this->GetObjetoExrg()->functionExpRS($param)) {
            $this->nombre_empresa = $param;
            return true;
        }
        return false;
    }
    
   
    
     public function setNit_ccAjax($param) {
        $param = $this->desinfeccionDeVariables($param);

        if ($this->GetObjetoExrg()->functionNitCedula($param)) {
               $this->nit_cc  = $param;
            return true;
        }

        return false;
    }

   
    

    public function getNombre() {
        return $this->nombre_empresa;
    }
    
    public function getNit(){
        
        return $this->nit_cc;
    }
    
    
    

    /**
     * registrar emrpesa
     * @param type $empresa
     */
    public function registrarEmpresa() {
   return $this->query("call Empresa_registrar('$this->nombre_empresa','$this->nit_cc')");
    }

    /**
     * consultar empresa por codigo
     * @param type $empresa
     */
    public function consultarEmpresaCodigo($codigo) {
        return $this->query("call Empresa_consultaCodigo('$codigo')");
    }
    
     public function consultarEmpresaNit_CC() {
       return $this->query("call Empresa_consultarNIT_CC('$this->nit_cc')");
         
        
    }
    
    public function relacionarUsuarioEmpresa($usuario,$id_empresa) {
        return $this->query("CALL Empresa_usuario_relacion('$usuario','$id_empresa')");
    }
    /**
     * consulta empresa por nombre
     * @return type
     */
    public function consultarEmpresaNombre() {
        return $this->query("call Empresa_consultaNombre('$this->nombre_empresa')");
    }
    
    /**
     * 
     *  funcion que consulta las empresas existentes en la bd
     * utiliando como parametros :
     * @param type $id consecutivo
     * @param type $nit_cc identificador unico
     * @param type $nombre razon social
     * @return type mysqli resulset
     */
    public function consultaEmpresa($id,$nit_cc,$nombre){
        return $this->query("CALL Empresa_buscar('$id','$nit_cc','$nombre')");
        
    }
    
    public function actualizaNombreEmpresa(){
        return $this->query("CALL Empresa_Update('$this->nit_cc','$this->nombre_empresa');");
    }
    
    
    

}// fin de la clase empresa

?>
