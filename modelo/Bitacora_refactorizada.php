<?php

require_once 'Database.php';

class Bitacora_refacotirzada extends Database {

  
    private $detalle;
    private $id_maquina;
    private $Idseccion_maquina;
    private $id_equipo;
    private $Idparte_equipo;
    private $origen_tiempoImproductivo;
    private $id_causa;
    private $nombre_usuario;
    private $id_turno;
    private $id_operador;
    private $tiempoImpruductivo;

    public function __construct() {
        parent::__construct($_SESSION['k_userName'], $_SESSION['k_userPass']);
    }

    public function __destruct() {
        parent::__destruct();
    }

    public function setIdMaquina($maquina) {
        $this->id_maquina = (int) $maquina;
    }

    public function getIdMaquina() {
        return $this->id_maquina;
    }

    public function setIdSeccion($seccion) {
        $this->Idseccion_maquina = (int) $seccion;
    }

    public function getIdSeccion() {
        return $this->Idseccion_maquina;
    }

    public function setIdEquipo($equipo) {

        $this->id_equipo = (int) $equipo;
    }

    public function getIdEquipo() {
        return $this->id_equipo;
    }

    public function setIdParteEquipo($parte_equipo) {

        $this->Idparte_equipo = (int) $parte_equipo;
    }

    public function getIdParteEquipo($parte_equipo) {

        $this->Idparte_equipo = (int) $parte_equipo;
    }

    public function setIdDefecto($origen) {

        $this->origen_tiempoImproductivo = (int) $origen;
    }

    public function getIdDefecto() {
        return $this->origen_tiempoImproductivo;
    }

    public function setIdCausa($causa) {

        $this->id_causa = (int) $causa;
    }

    public function getIdCausa() {
        return $this->id_causa;
    }

    public function setNombreUsuario($usuario) {
        $this->nombre_usuario = $usuario;
    }

    public function getNmbreUsuario() {
        return $this->nombre_usuario;
    }

    public function setIdTurno($turno) {
        $this->id_turno = (int) $turno;
    }

    public function getIdTurno() {

        return $this->id_turno;
    }

    public function setIdOperador($id_operador) {

        $this->id_operador = (int) $id_operador;
    }

    public function setTiempoImproductivo($timp) {

        $this->tiempoImpruductivo = (double) $timp;
    }

    public function getTiempoImproductivo($timp) {

        $this->tiempoImpruductivo = (double) $timp;
    }

   

    public function setDetalle($detalle) {
        $inicio=0;
        $finLimite=999;

        $this->detalle = $this->desinfeccionDeVariables($detalle);
        $this->detalle = substr($this->detalle, $inicio,$finLimite);
    }

   
    
    public function registrarTiempoImproductivo() {

        
       return $this->query("CALL Bitacora_rg_tiempoImproductivo('$this->id','$this->id_maquina','$this->Idseccion_maquina','$this->id_operador','$this->id_equipo','$this->Idparte_equipo','$this->tiempoImpruductivo','$this->origen_tiempoImproductivo','$this->id_causa','$this->detalle','$this->nombre_usuario','$this->id_turno');");

        
    }
    

    public function visualizarRegistroTiempoImproductivo($id_bitacora) {        
         return $this->query("call Bitacora_consultarTiempoImproductivo('$this->id','$id_bitacora');"); 
    }

    public function optenerUltimoConsecutivoRegistrado() {

        $consulta = $this->query("SELECT LAST_INSERT_ID() id;");
        $rowcount = $consulta->fetch_array(MYSQLI_ASSOC);
        $id_bitacora = $rowcount['id'];

        return $id_bitacora;
    }

    /**
     * requiere importar la clase modal_consulta.php
     * para ejecutar la funcion
     */
    public function isTiempoDeOchoHorasPorTurno() {

        $horasLaboralesReales = 8;
        $tiempoAlmuero = "";

        if (($_SESSION['k_userName']) == strtoupper('formado')) { /* consultar pagina simple o completa */

            $horasLaboralesReales = 7.5;
            $tiempoAlmuero = "ya que se restan 30  minutos de almuerzo";
        }

        if (($_SESSION['k_userName']) == strtoupper('reproceso')) { /* consultar pagina simple o completa */

            $horasLaboralesReales = 7.5;
            $tiempoAlmuero = "ya que se restan 30  minutos de almuerzo";
        }




        if ($this->tiempoImpruductivo + $this->getTotalHoraDiaTurnoOperador() > $this->getHoraLaboralRealPorMaquina()) {
            
            



            mensajeDeErrorModal('HA EXEDIDO EL MAXIMO DE TIEMPO REGISTRADO EN EL TURNO', 'El tiempo Improductivo registrado durante el turno no puede ser mayor que ' . $horasLaboralesReales . ' Horas  ' . $tiempoAlmuero, 'Consulte el hitorial de su turno y verifique cuanto tiempo ha registrado en el turno.'
                    . 'Si persiste el mensaje comuniquese con el Administrador del Sistema');
        }
    }

    private function getHoraLaboralRealPorMaquina() {

        $this->next_result(); // se hace la llamada por que antes se debe invocar otro ps que ejecuta una sentencia select

        $mysql_result = $this->consultaHorasLaboralesPorMaquina();
        $rowcount = $mysql_result->fetch_array(MYSQLI_ASSOC);
        $HorasTurno = $rowcount['tiempo_laboral'];
        return $HorasTurno;
    }

    private function consultaHorasLaboralesPorMaquina() {

        return $this->query("CALL HorasLaboralesReales('$this->id_maquina','$this->id');");
       
    }

    private function getTotalHoraDiaTurnoOperador() {

        $consulta = $this->consultaSumaTiempoPorDiaTurnoOperador();
        $rowcount = $consulta->fetch_array(MYSQLI_ASSOC);
        $totalHorasTurno = $rowcount['total'];
        return $totalHorasTurno;
    }

    private function consultaSumaTiempoPorDiaTurnoOperador() {

        $annio = date("Y");
        $mes = date("m");
        $dia = date("d");

        return $this->query("CALL sumarHorasPorTurno('$this->id','$this->id_operador','$this->id_turno','$annio','$mes','$dia','$this->id_maquina');");
       
    }
    
    public function crearOTAutomatica() {
        $this->query("CALL Bitacora_crearOT('$this->id');");
        
    }
    
     public function relacionarOTtimpo($id_bitacora, $id_ot) {

        $this->query("CALL Bitacora_relacionarOT_Timp('$id_bitacora','$id_ot','$this->id');");
    }

}
?>

