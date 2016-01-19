<?php

class Produccion extends Database {

    private $consecutivoPesaje;
    private $unidadesKilosMetros;
    private $idMaterialFichaTecnia;
    private $velocidadDeProduccion;
    private $kilosPesado;
    private $idOrdenProducion;
    private $idTurno;
    private $idOperador;
    private $idMaquina;
    private $usuarioSistema;
    private $fechaRegistroManual;

    public function __construct() {
        parent::__construct();
    }

    public function __destruct() {
        parent::__destruct();
    }

    public function setIdEmpresa($id) {
        parent::setIdEmpresa($id);
    }

    public function setFechaRegistroProduccion($fechaRegristroProduccion) {
        $this->fechaRegistroManual = $fechaRegristroProduccion;
    }

    public function setUsuarioSistema($nombreUsuario) {
        $this->usuarioSistema = $nombreUsuario;
    }

    public function setIdMaquina($id_maquina) {
        $this->idMaquina = (int) $id_maquina;
    }

    public function getIdMaquina() {
        return $this->idMaquina;
    }

    public function setIdOperador($id_operador) {
        $this->idOperador = (int) $id_operador;
    }

    public function getIdOperador() {
        return $this->idOperador;
    }

    public function setIdTurno($id_turno) {
        $this->idTurno = (int) $id_turno;
    }

    public function getIdTurno() {
        return $this->idTurno;
    }

    public function setIdOrdenProduccion($idOrdenProduccion) {

        $this->idOrdenProducion = (double) $idOrdenProduccion;
    }

    public function getIdOrdenProduccion() {

        return $this->idOrdenProducion;
    }

    public function setVelocidadProduccion($velocidadDeProduccion) {
        $this->velocidadDeProduccion = doubleval($velocidadDeProduccion);
    }

    public function getVelocidadDeProduccion() {
        return $this->velocidadDeProduccion;
    }

    public function setConsecutivoProduccion($consecutivo) {
        $this->consecutivoPesaje = (int) $consecutivo;
    }

    public function getConsecutivoProduccion() {
        return $this->consecutivoPesaje;
    }

    public function setKilosPesado($kilosPesado) {
        $this->kilosPesado = $kilosPesado;
    }

    public function getKilosPesado() {
        return $this->kilosPesado;
    }

    public function setProducido($unidadesKilosMetros) {
        $this->unidadesKilosMetros = (double) $unidadesKilosMetros;
        
    }

    public function setKilosProducidoSinValidacion($kilos) {
        $this->unidadesKilosMetros = (double) $kilos;
    }

    

    public function setIdFichaTecnicaOtipoMaterial($idMaterial) {
        $this->idMaterialFichaTecnia = (double) $idMaterial;
    }

    public function setTipoMaterialDigitadoPorElUsuario($fichaTecnica) {
        $this->idMaterialFichaTecnia = (string) $fichaTecnica;
    }

    public function compruebaExistenciaMaterial() {

        $consulta = $this->consultaExistenciaMaterial();

        if (($consulta->num_rows) <= 0) {

            mensajeDeErrorModal($titulo = 'EL MATERIAL SELECCIONADO NO EXISTE'
                    , $subtitulo = 'Seleccione un material de la lista desplegable'
                    , $mensaje = 'Para un mejor resultado , consulte los tipos de materiales registradas en su sistema, para esto pongase en contacto con el administrador');
            exit();
        }
    }

    public function consultaExistenciaMaterial() {
        return $this->query("CALL Bitacora_consultaExistenciaTipoMaterialPesado($this->idMaterialFichaTecnia,$this->id);");
        
    }

    public function compruebaConsecutivoDuplicado() {

        $consulta = $this->consultaConsecutivo();
        if (($consulta->num_rows) >= 1) {

            mensajeDeErrorModal($titulo = 'CONSECUTIVO DUPLICADO '
                    , $subtitulo = 'No esta permitido registrar dos veces el mismo consecutivo de produccion'
                    , $mensaje = 'Consulte la orden de  produccion registrada y compruebe'
                    . 'si ya se registro el consecutivo , si persiste el mensaje contacte con el Administrador');
            exit();
        }
    }

    public function consultaConsecutivo() {
        return $this->query("CALL Bitacora_consultaConsecutivoDuplicado($this->consecutivoPesaje,$this->idMaterialFichaTecnia,$this->id)");
    }

    public function existUnidadesPesadas($bitacora) {

        $consulta = $this->consultaUnidadesPesadas($bitacora);
        return (($consulta->num_rows) >= 1);
    }

    private function consultaUnidadesPesadas($bitacora) {
        $dia = date('d');
        $mes = date('m');
        $annio = date('Y');

        return $this->query("CALL consultaUnidadesPesadas($this->id," . $this->idMaquina . "," . $this->idTurno . "," . $this->idOperador . ",'$annio','$mes','$dia');");
    }

    public function ponerAldiaElRegistroDeProduccion() {
        return $this->query("CALL PonerAldiaElRegistroDeProduccion($this->id," . $this->idOrdenProducion . " ," . $this->consecutivoPesaje . ",$this->unidadesKilosMetros,$this->idMaterialFichaTecnia," . $this->idMaquina . "," . $this->idTurno . "," . $this->idOperador . ",'" . $this->usuarioSistema . "','$this->velocidadDeProduccion','$this->kilosPesado','" . $this->fechaRegistroManual . "');");
    }

    public function visualizarProduccionRegistrada() {
        return $this->query("CALL Produccion_consultarProduccionPesadaIdOpConVelocidad($this->id," . $this->idOrdenProducion . ");");
    }

    public function registrarProduccion() {
        return $this->query("CALL Produccion_pesajeProduccionConVelocidadKilosMetros($this->id," . $this->idOrdenProducion . " ," . $this->consecutivoPesaje . ",$this->unidadesKilosMetros,$this->idMaterialFichaTecnia," . $this->idMaquina . "," . $this->idTurno . "," . $this->idOperador . ",'" . $this->usuarioSistema . "','$this->velocidadDeProduccion','$this->kilosPesado');");
    }

    public function consultaRegistroProduccion($bitacora) {
        return $this->query("CALL Produccion_consultarProduccionPesadaIdOp($this->id," . $bitacora->getOp() . ");");
    }

    public function consultaOrdenProduccion($op, $maquina, $turno, $operador, $consecutivo, $tipoMaterial, $fecha_inicial, $fecha_final) {
        return $this->query("CALL Produccion_consultarOrdenProduccion('$op','$consecutivo','$tipoMaterial','$maquina','$turno','$operador','$fecha_inicial','$fecha_final',$this->id);");
    }

    public function consultaOrdenProduccionPrefijoMaquina($op, $maquina, $turno, $operador, $consecutivo, $tipoMaterial, $fecha_inicial, $fecha_final) {
        return $this->query("CALL Produccion_consultarOrdenProduccionPrefijoMaquina('$op','$consecutivo','$tipoMaterial','$maquina','$turno','$operador','$fecha_inicial','$fecha_final',$this->id);");
    }

    public function consultaOrdenProduccionPrefijoMaquinaConVelocidad($op, $maquina, $turno, $operador, $consecutivo, $tipoMaterial, $fecha_inicial, $fecha_final) {
        return $this->query("CALL Produccion_consultarOrdenProduccionPrefijoMaquinaConVelocidad('$op','$consecutivo','$tipoMaterial','$maquina','$turno','$operador','$fecha_inicial','$fecha_final',$this->id);");
    }

    public function consultaOrdenProduccionPrefijoMaquinaConVelocidadPaginada($op, $maquina, $turno, $operador, $consecutivo, $tipoMaterial, $fecha_inicial, $fecha_final, $inicioLimit, $finLimit) {
        return $this->query("CALL consultarProduccionPesadaPaginada('$op','$consecutivo','$tipoMaterial','$maquina','$turno','$operador','$fecha_inicial','$fecha_final',$this->id,$inicioLimit,$finLimit);");
    }

    public function contarOrdenProduccionPrefijoMaquinaConVelocidad($op, $maquina, $turno, $operador, $consecutivo, $tipoMaterial, $fecha_inicial, $fecha_final) {
        return $this->query("CALL Produccion_contarOrdenProduccionPrefijoMaquinaConVelocidad('$op','$consecutivo','$tipoMaterial','$maquina','$turno','$operador','$fecha_inicial','$fecha_final',$this->id);");
    }

    public function getUltimoConsecutivo() {
        $mysql_result = $this->consultaUltimoConsecutivoPesadoEnProduccion($_SESSION['k_userName']);
        $row = $mysql_result->fetch_array(MYSQLI_ASSOC);
        $ultimoConsecutivo = $row['no_producto_final'];

        return $ultimoConsecutivo;
    }

    private function consultaUltimoConsecutivoPesadoEnProduccion($usuario) {
        return $this->query("CALL UltimoConsecutivoPesajeProduccion('$this->id','$usuario');");
    }

    public function getIdFicha() {

        $mysql_result = $this->consultaIdFicha();
        $row = $mysql_result->fetch_array(MYSQLI_ASSOC);
        $idFicha = $row['id'];

        return $idFicha;
    }

    private function consultaIdFicha() {
        return $this->query("CALL getIdFicha('$this->idMaterialFichaTecnia','$this->id');");
    }

     public function consultaMaterialPesado(){
        return $this->query("CALL consultaRegistroProduccion('$this->id','$this->idOrdenProducion','$this->consecutivoPesaje','$this->idMaterialFichaTecnia','$this->idMaquina','$this->idTurno');"); 
         
        
        
        }

        public function actualizarRegistroDeProduccion($fecha,$id_registro) {
       
         return $this->query("CALL actualizarProduccion($this->id," . $this->idOrdenProducion . " ," . $this->consecutivoPesaje . ",$this->unidadesKilosMetros,$this->idMaterialFichaTecnia," . $this->idMaquina . "," . $this->idTurno . "," . $this->idOperador . ",'" . $this->usuarioSistema . "','$this->velocidadDeProduccion','$this->kilosPesado','$fecha','$id_registro');"); 
           
                 
         
    }
    
    
    public function getListado_unidadDeMedidaPrincipal() {
        return $this->query("CALL  getListado_unidadDeMedidaPrincipal($this->id) ");
        
    }
    
     public function getListado_unidadDeMedidaSecundaria() {
        return $this->query("CALL  getListado_unidadDeMedidaSecundaria() ");
        
    }

}

?>