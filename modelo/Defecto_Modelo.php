<?php

if (!isset($_SESSION)) {
    session_start();
}




require_once 'Database.php';
require_once ('raiz_directorio_principal.php');

class Defecto extends Database {

    private $nombre;
    private $id_empresa;
    private $id_defecto;
    private $id_origen;
    private $detalle;
    private $id_causa;

    function __construct() {
        parent::__construct($_SESSION['k_userName'], $_SESSION['k_userPass']);
        $this->nombre = "";
        $this->id_defecto = "";
        $this->id_maquina = "";
        $this->id_origen = "";
        $this->detalle = "";
        $this->id_causa = "";
    }

    function __destruct() {
        parent::__destruct();
    }

    public function setNombre($nombre) {

        if ($this->setnombreAjax($nombre)) {
            
        } else {
            echo('<script>alert("Escriba un valor alfanumerico para el campo nombre defecto ")</script>');
            raiz_amd();
            exit();
        }
    }

    public function setIdEmpresa($id_empresa) {
        $this->id_empresa = $id_empresa;
    }

    public function setnombreAjax($param) {

        $param = parent::desinfeccionDeVariables($param);

        if ($this->GetObjetoExrg()->functionExpRS($param)) {
            $this->nombre = $param;
            return true;
        }
        return false;
    }

    public function setIdOrigen($id) {

        if ($this->setIdOrigenAjax($id)) {
            
        } else {
            echo('<script>alert("Seleccione un valor valido para el campo  Origen")</script>');
            raiz_amd();
            exit();
        }
    }

    public function setIdCausa($id) {


        if ($this->setIdCausaAjax($id)) {
            
        } else {
            echo('<script>alert("Seleccione un valor valido para el campo  Cuasa")</script>');
            raiz_amd();
            exit();
        }
    }

    public function setIdCausaAjax($param) {



        if ($this->GetObjetoExrg()->functionOnlyNumberCodigoResina($param)) {
            $this->id_causa = $param;

            return true;
        }
        return false;
    }

    public function setIdOrigenAjax($param) {

        if ($this->GetObjetoExrg()->functionOnlyNumberCodigoResina($param)) {
            $this->id_origen = $param;
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

    public function setIdMaquinaAjax($param) {

        if ($this->GetObjetoExrg()->functionOnlyNumberCodigoResina($param)) {
            $this->id_maquina = $param;
            return true;
        }
        return false;
    }

    public function setDetalle($detalle) {

        $this->detalle = $this->desinfeccionDeVariables($detalle);

        if (strlen($this->detalle) > 1000) {

            $this->detalle = '';
        }
    }

    public function registrarDefecto() {
        return $this->query("call Defecto_crear('$this->nombre','$this->id_empresa')");
    }

    public function registrarCausa() {
        return $this->query("call Defecto_Crear_Causa('$this->nombre','$this->detalle','$this->id_empresa')");
    }

    public function consultarRelacionOperadorMaquina() {
        return $this->query(" call Operador_RelacionMaquinaConsultarDuplicado('$this->id_maquina','$this->id_operador','$this->id_empresa')");
    }

    public function consultarRelacionDefectoMaquina() {
        return $this->query(" CALL Defecto_buscarOrgienMaquina('$this->id_origen','$this->id_empresa','$this->id_maquina')");
        ;
    }

    public function consultarRelacionDefectoMaquinaCausa() {
        return $this->query("CALL Defecto_buscarOrigenCausaMaquina('$this->id_causa','$this->id_origen','$this->id_empresa','$this->id_maquina')");
    }

    public function relacionOperadorMaquina() {
        return $this->query("  call Operador_relacionarOperadorMaquina('$this->id_maquina','$this->id_operador','$this->id_empresa')");
    }

    public function relacionOrigenMaquina() {
        return $this->query("call Defecto_relacionarOrigenMaquina('$this->id_origen','$this->id_empresa','$this->id_maquina')");
    }

    public function relacionMaquinaOrigenCausa() {
        return $this->query("call Defecto_relacionarMaquinaOrigenCausa('$this->id_causa','$this->id_origen','$this->id_maquina','$this->id_empresa')");
    }

    public function consultarOperadorMaquina() {
        return $this->query(" call Operador_mostrarRelacionMaquina('$this->id_empresa');");
    }

    public function consultarOrigenMaquina() {
        return $this->query(" call Defecto_consultarOrigenMaquina('$this->id_empresa');");
    }

    public function consultarMaquinaOrigenCausa() {
        return $this->query(" call Defecto_consultarMaquinaOrigenCausa_TI('$this->id_empresa');");
    }

    public function consultarMaquinaOrigenCausa_parametros($maquina, $origen, $causa) {
        return $this->query(" call Defecto_consultarMaquinaOrigenCausa_buscar('$this->id_empresa','$maquina','$origen','$causa');");
    }

    public function listarMaquinaOrigenCausa($maquina, $origen) {
        return $this->query(" call Defecto_listarDefectosPorMaquina('$this->id_empresa','$maquina','$origen');");
    }

    public function actualizaNombreEmpresa() {
        return $this->query("CALL Empresa_Update('$this->nit_cc','$this->nombre');");
    }

    public function consultarCausa() {
        return $this->query("CALL Defecto_Consulta_Causa('$this->nombre','$this->id_empresa');");
    }

    public function consultarDefecto() {
        return $this->query("CALL Defecto_consultar('$this->nombre','$this->id_empresa');");
    }

    public function consultarCausaRegistradasPorEmpresa() {
        return $this->query("CALL Defecto_consultaCausaPorEmpresa('$this->id_empresa');");
    }

    public function consultarDefectos($id_defecto, $nombre) {

        return $this->query(" call Defecto_buscar('$id_defecto','$nombre','$this->id_empresa');");
    }

    public function consultarCausas($id_causa, $nombre_causa) {

        return $this->query(" call Defecto_consultarCausa('$this->id_empresa','$nombre_causa','$id_causa');");
    }

    public function consultaDefecto() {


        $consulta = $this->consultarCausa();
        if (($consulta->num_rows) >= 1) {

            echo('<script>alert("Defecto duplicado rectifique")</script>');
            exit();
            
            mensajeDeErrorModal($titulo = 'DEFECTO DUPLICADO'
                    , $subtitulo = 'No es posible el registro doble de un mismo defecto'
                    , $mensaje = 'consulte el listado de defecto registrado en el sistema y cree uno que no pertenezca al listado');
            exit();
        }


       
    }

}

?>
