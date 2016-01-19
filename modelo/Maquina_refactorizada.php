<?php

class Maquina_refactorizada extends Database {

    //por que existe
    //que hace
    //como se usa

    private $id_maquina;
    private $listaDesplegable;
    private $nombreMaquina;

    const NO_EXISTE_REGISTRO = 0;
    const SI_EXISTE_REGISTRO = 1;

    public function __construct() {
        parent::__construct();
        $this->listaDesplegable = new GenerarListaDesplegable();
    }

    public function setIdMaquina($id_maquina) {
        $this->id_maquina = $id_maquina;
    }

    public function setNombreMaquina($nombreMaquina) {
        $this->nombreMaquina = $nombreMaquina;
    }

    public function getIdMaquina() {
        return $this->id_maquina;
    }

    public function setIdEmpresa($param) {
        parent::setIdEmpresa($param);
    }

    public function existsMaquina() {

        if ($this->consultaExistenciaMaquina() == self::NO_EXISTE_REGISTRO) {

            mensajeDeErrorModal(
                    $titulo = 'LA MAQUINA SELECCIONADA NO EXISTE'
                    , $subtitulo = 'Seleccione una maquina de la lista desplegable'
                    , $mensaje = 'Para un mejor resultado , consulte las maquinas registradas en su sistema, para esto pongase en contacto con el administrador');
            exit();
        }
    }

    private function consultaExistenciaMaquina() {

        $consulta = $this->consultaMaquina();
        return $consulta->num_rows;
    }

    private function consultaMaquina() {
        return $this->query("CALL Maquina_ComprobarExistencia_Maquina('$this->id_maquina','$this->id')");
    }

    public function contarMaquinasSegunArea($id_area) {

        $mysqli_result = $this->listaDoDeMaquinaSegunArea($id_area);
        $countMaquina = $mysqli_result->num_rows;
        return $countMaquina;
    }

    public function listaDoDeMaquinaSegunArea($area) {
        return $this->query("CALL ListaDesplegableMaquinaSegunArea('$area','$this->id');");
    }

    public function getIdMaquinaSegunArea($id_area) {
        $mysqli_result = $this->listaDoDeMaquinaSegunArea($id_area);
        $obJeto = $mysqli_result->fetch_object();
        $id_maquina = $obJeto->id_maquina;

        return $id_maquina;
    }

    public function cargar_maquinas() {
        $consulta = $this->consultarMaquinasRegistradas();
        $num_total_registros = $consulta->num_rows;
        if ($num_total_registros > 0) {
            return $this->listaDesplegable->generarListadoDesplegable($consulta, 'id_maquina', 'nombre_maquina');
        } else {
            return false;
        }
    }

    private function consultarMaquinasRegistradas() {

        return $this->query("CALL ListaDesplegableMaquina3('$this->id')");
    }

    public function existRelacionBetweenJerarQuiaMaquina() {

        return (($this->consultaRelacionJerarquiaMAquina()->num_rows) <= 0);
    }

    private function consultaRelacionJerarquiaMAquina() {

        return $this->query("CALL MaquinaExistRelacionJerarquiaMaquina('$this->id','$this->id_maquina') ");
    }

    public function MaquinaTieneAsignadaUnaJerarQui() {

        return (($this->ConsultarSiMaquinaTieneRelacionadoUnaJerarquia()->num_rows) >= 1);
    }

    private function ConsultarSiMaquinaTieneRelacionadoUnaJerarquia() {

        return $this->query("CALL ConsultarSiMaquinaTieneRelacionadoUnaJerarquia('$this->id','$this->id_maquina') ");
    }

    public function asignarJerarQuiaAMaquina($id_jerarquia) {

        return $this->query("CALL AsignarJerarQuiaMaquina('$id_jerarquia','$this->id_maquina','$this->id') ");
    }

    public function actualizarJerarquiaDeMaquina($id_jerarquia) {
        return $this->query("CALL MAquinaActualizarJerarquia('$this->id','$this->id_maquina','$id_jerarquia') ");
    }

    public function visualizarRelacionAreaMaquina() {

        return $this->query("CALL Maquina_MostrarJerarquia('$this->id') ");
    }

    public function consultarJerarquiaAsignadaEnMaquina($id_jerarquia) {

        return $this->query("CALL maquina_consultarJerarquia('$this->nombreMaquina','$id_jerarquia','$this->id') ");
    }

    public function getId() {

        $consulta = $this->consultaId();
        $row = $consulta->fetch_array(MYSQLI_ASSOC);
        $id = $row['id_maquina'];
        return $id;
    }

    public function consultaId() {

        return $this->query("CALL getIdMaquina('$this->id','$this->nombreMaquina') ");
    }

    public function existsRelacionMaquinaHoraProductiva() {

        if ($this->existRegistro() == self::SI_EXISTE_REGISTRO) {

            mensajeDeErrorModal(
                    $titulo = 'LA MAQUINA SELECCIONADA YA POSEE UN RANGO DE TIEMPO PRODUCTIVO'
                    , $subtitulo = ''
                    , $mensaje = '');
            exit();
        }
    }

    private function existRegistro() {

        $consulta= $this->consultarRelacionMaquinaHoraProductiva();
        return $consulta->num_rows;
    }

    private function consultarRelacionMaquinaHoraProductiva() {
        return $this->query("CALL existRelacionHoraMaquina('$this->id_maquina','$this->id') ");
        
    }

    public function noExistsRelacionMaquinaHoraProductiva() {

        if ($this->existReacionMaquinaHoraProductiva() == self::NO_EXISTE_REGISTRO) {

            mensajeDeErrorModal(
                    $titulo = 'LA MAQUINA SELECCIONADA NO POSEE UN RANGO DE TIEMPO PRODUCTIVO'
                    , $subtitulo = ''
                    , $mensaje = '');
            exit();
        }
    }

    private function existReacionMaquinaHoraProductiva() {

        $consulta = $this->existRegistro();
        return $consulta->num_rows;
    }

    public function existsRelacionMaquinaMedidaPrincipal($id_usuario) {

        if ($this->consultarRelacionMaqinaMedidaPrincipal($id_usuario) == self::SI_EXISTE_REGISTRO) {

            mensajeDeErrorModal(
                    $titulo = 'LA MAQUINA SELECCIONADA YA POSEE UNA MEDIDA PRINCIPAL DE PRODUCCION'
                    , $subtitulo = ''
                    , $mensaje = '');
            exit();
        }
    }
    
   
    
  

    public function noExistsRelacionMaquinaMedidaPrincipal($id_usuario) {

        if ($this->consultarRelacionMaqinaMedidaPrincipal($id_usuario) == self::NO_EXISTE_REGISTRO) {

            mensajeDeErrorModal(
                    $titulo = 'LA MAQUINA SELECCIONADA NO POSEE UNA MEDIDA PRINCIPAL DE PRODUCCION'
                    , $subtitulo = ''
                    , $mensaje = '');
            exit();
        }
    }

    private function consultarRelacionMaqinaMedidaPrincipal($id_usuario) {

        $consulta = $this->query("CALL existRelacionMaquinaUnidadPrincipal('$this->id','$id_usuario') ");
        return $consulta->num_rows;
    }

    public function existsRelacionMaquinaMedidaSEcundaria($id_unidaSecundaria) {

        $existRegistro = $this->consultarRelacionMaqinaMedidaSecundaria($id_unidaSecundaria);
        if ($existRegistro->num_rows == self::SI_EXISTE_REGISTRO) {

            mensajeDeErrorModalexistsRelacionMaquinaMedidaPrincipal(
                    $titulo = 'LA MAQUINA SELECCIONADA YA POSEE LA MEDIDA SECUNDARIA  DE PRODUCCION QUE HA SELECCIONADO'
                    , $subtitulo = ''
                    , $mensaje = '');
            exit();
        }
    }

    public function noExistsRelacionMaquinaMedidaSEcundaria($id_unidaSecundaria) {

        $existRegistro = $this->consultarRelacionMaqinaMedidaSecundaria($id_unidaSecundaria);
        if ($existRegistro->num_rows == self::NO_EXISTE_REGISTRO) {

            mensajeDeErrorModalexistsRelacionMaquinaMedidaPrincipal(
                    $titulo = 'LA MEDIDA DE PRODUCCION SECUNDARIA QUE DESEA ACTUALIZAR NO EXISTE'
                    , $subtitulo = ''
                    , $mensaje = '');
            exit();
        }
    }

    private function consultarRelacionMaqinaMedidaSecundaria($id_unidadSecundaria) {
        return $this->query("CALL existRelacionMaquinaUnidadSecundaria('$this->id','$this->id_maquina','$id_unidadSecundaria') ");
    }

    public function asignarMedidaDeProduccionPrincipal($id_usuario, $id_medida) {
        return $this->query("CALL asignarMedidaMedidaProduccionPrincipal('$id_usuario','$id_medida','$this->id') ");
    }

    public function actualizarMedidaDeProduccionPrincipal($id_usuario, $id_medida) {
        return $this->query("CALL actualizarMedidaMedidaProduccionPrincipal('$id_usuario','$id_medida','$this->id') ");
    }

    public function asignarMedidaDeProduccionSecundaria($id_medida) {
        return $this->query("CALL asignarMedidaMedidaProduccionSecundaria('$this->id_maquina','$id_medida','$this->id') ");
    }

    public function actualizarMedidaDeProduccionSecundaria($id_medidaActual, $id_medidaNueva) {
        return $this->query("CALL actualizarMedidaProduccionSecundaria('$this->id_maquina','$id_medidaActual','$this->id','$id_medidaNueva') ");
    }

    public function visualizarMedidaPrincipalsAsignadaAmaquina() {

        return $this->query("CALL consultarUnidadMedidaPrincipalAsignadaaMaquinas('$this->id') ");
    }

    public function visualizarMedidaSecundariasAsignadaAmaquina() {

        return $this->query("CALL consultarUnidadMedidaSecundariaAsignadaAMaquina('$this->id') ");
    }

    public function asignarRelacionHoraProductivaAMaquina($id_hora) {

        return $this->query("CALL AsignarTiempoProductivoAMaquina('$this->id_maquina','$id_hora','$this->id') ");
    }

    public function actualizarRelacionHoraProductivaAMaquina($id_hora) {

        return $this->query("CALL actualizarRelacionHoraProductivaAMaquina('$this->id','$this->id_maquina','$id_hora') ");
    }

    public function visualizarTiemposProductivosAsignadosAmaquina() {

        return $this->query("CALL consultaTiempoProductivoAsignadoAMaquina('$this->id') ");
    }

    public function consultarTiemposProductivosAsignadosAmaquina($id_maquina, $id_hora) {

        return $this->query("CALL visualizarTiemposProductivoPorMaquina('$this->id','$id_maquina','$id_hora') ");
    }

    public function consultarMedidaProduccionPrincipalAsignadaAmaquina() {

        return $this->query("CALL consultarUnidadMedidaSecundariaAsignadaAMaquina('$this->id') ");
    }

    public function listarMedidaSecundariasAsignadaAmaquina($id_maquina, $id_medida) {

        return $this->query("CALL consultarMedidaProduccionSecundaria('$this->id','$id_maquina','$id_medida') ");
    }

    public function listarMedidaPrincipalAsignadaAmaquina($id_maquina, $id_medida) {
        return $this->query("CALL cosultarMedidaProduccionPrincipal('$this->id','$id_maquina','$id_medida') ");
    }

}

?>
