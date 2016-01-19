<?php

require_once 'Database.php';

class Bitacora extends Database {

    private $id_maquina;
    private $detalle;
    private $op; //orden de producion
    public $ficha;
    private $idTurno;
    private $code;
    private $idOperador;
    private $formula;
    private $ancho;
    private $densidad;
    private $calibre;
    private $id_empresa;
    private $kwh;
    private $idSeccionMaquina;
    private $idParteEquipo;
    private $IdEquipo;
    private $timer;
    private $origen_tiempoImproductivo;
    private $IdCausa;
    private $tiempoImpruductivo;
    private $usuario;
    private $hora;
    private $minuto;
    private $nombreMaquina;
    private $date;

    const INICIO_TURNO = 1;
    const FIN_TURNO = 2;
    const DIA = 1;
    const HORA = 2;
    const MINUTO = 3;
    const HORAS = 24;
    const MINUTOS = 60;
    const TURNO_A = 1;
    const TURNO_B = 2;
    const TURNO_C = 3;

    public function __construct() {
        parent::__construct($_SESSION['k_userName'], $_SESSION['k_userPass']);
    }

    public function __destruct() {
        parent::__destruct();
    }

    public function setHora($hora) {
        $this->hora = (int) $hora;
    }

    public function isHoraMayorQue8() {

        if ($this->hora > 8) {
            mensajeDeErrorModal('HORA POR FUERA DEL RANGO PERMITIDO', 'El valor debe ser igual o menor a 8 horas laborales', '');
        }
    }

    public function setDate($date) {

        $this->date = $date;
    }

    public function getDate() {

        return $this->date;
    }

    public function setMinuto($minuto) {
        $this->minuto = (int) $minuto;
    }

    public function validarMinuto() {

        if ($this->minuto > 60) {
            mensajeDeErrorModal('MINUTO POR FUERA DEL RANGO PERMITIDO', 'El valor de minuto debe ser menor o igual a 59', '');
        }
    }

    public function setKwh($kwh) {
        $this->kwh = (int) $kwh;
    }

    public function setUsuario($usuario) {
        $this->usuario = $usuario;
    }

    public function getUsuario() {
        return $this->usuario;
    }

    public function setParteEquipo($parte_equipo) {

        $this->idParteEquipo = (int) $parte_equipo;
    }

    public function setEquipo($equipo) {

        $this->IdEquipo = (int) $equipo;
    }

    public function setSeccion($seccion) {
        $this->idSeccionMaquina = (int) $seccion;
    }

    public function setFormula($formula) {
        $this->formula = (int) $formula;
    }

    public function setAncho($ancho) {
        $this->ancho = (double) $ancho;
    }

    public function setDensidad($densidad) {
        $this->densidad = (double) $densidad;
    }

    public function setCalibre($calibre) {
        $this->calibre = (double) $calibre;
    }

    public function setCodigoBusqueda($code) {
        $this->code = $code;
    }

    public function setOperador($operador) {
        $this->idOperador = (int) $operador;
    }

    public function setIdEmpresa($id_empresa) {
        $this->id_empresa = (int) $id_empresa;
    }

    public function getOperador() {
        return $this->idOperador;
    }

    public function setTipoTiempo($tipoTiempo) {

        if ($tipoTiempo >= self::DIA && $tipoTiempo <= self::MINUTO) {

            $this->timer = $tipoTiempo;
            return true;
        }

        return false;
    }

    public function setTiempoImproductivo($timp) {

        $this->tiempoImpruductivo = (double) $timp;
    }

    public function convertirTiempo() {

        $this->convertirAhorasAMinutos();
        $this->unificarTiempoEnMinutos();
        $this->convertirMinutosAhoras();
    }

    private function convertirAhorasAMinutos() {
        $this->hora = $this->hora * self::MINUTOS;
    }

    private function unificarTiempoEnMinutos() {

        $this->tiempoImpruductivo = $this->hora + $this->minuto;
    }

    private function convertirMinutosAhoras() {

        $this->tiempoImpruductivo = doubleval($this->tiempoImpruductivo / self::MINUTOS);
    }

    public function setIdDefecto($origen) {

        $this->origen_tiempoImproductivo = (int) $origen;
    }

    public function setIdCausa($causa) {

        $this->IdCausa = (int) $causa;
    }

    /**
     * crea el listado de maquinas como una lista desplegable
     * 
     * @return type
     */
    public function listaDesplegableMaquina2() {

        return $this->query("CALL ListaDesplegableMaquina3('$this->id_empresa')");
    }

    public function listaDesplegableOperadoresSegunMaquinaSeleccionada($id_maquina) {
        return $this->query("CALL Bitacora_Listado_operadores_segun_maquina('$id_maquina','$this->id_empresa');");
    }

    public function listaDesplegableDefecto() {
        return $this->query("CALL ListaDesplegableDefecto();");
    }

    /**
     * Esta funcion recibe como parametro  un valor númerico
     * para consultar el nombre  que corresponde con ese id, 
     * en este caso se espera que el nombre sea = MATENIMIENTO
     * @param type $origen valor numerico que representa el id del origen MANTENIMIENTO
     * @return type string que representa el nombre de un id
     */
    public function consultarNombreId($origen) {
        $consulta = $this->query("CALL Bitacora_consultarNombreId('$origen','$this->id_empresa');");
        $rowcount = $consulta->fetch_array(MYSQLI_ASSOC);
        $nombreId = $rowcount['descripcion'];
        return $nombreId;
    }

    public function crearOTAutomatica() {
        $this->query("CALL Bitacora_crearOT('$this->id_empresa');");
    }

    public function relacionarOTtimpo($id_bitacora, $id_ot) {

        $this->query("CALL Bitacora_relacionarOT_Timp('$id_bitacora','$id_ot','$this->id_empresa');");
    }

    public function contarRegistroBitacora_1($operador, $maquina, $fi, $ff) {


        return $this->query("CALL Bitacora_ContarRegistros_1('$this->id_empresa','$operador','$maquina','$fi','$ff');");
    }

    public function contarRegistroTimpo($maquina, $operador, $equipo, $origen, $causa, $fi, $ff) {
        return $this->query("CALL Bitacora_contarTimpo('$this->id_empresa','$maquina','$operador','$equipo','$origen','$causa','$fi','$ff');");
    }

    public function contarRegistroEnTablaProduccion($maquina, $operador, $turno, $fi, $ff) {
        return $this->query("CALL contarRegistrosEnTablaProduccion('$maquina','$operador','$turno','$fi','$ff','$this->id_empresa');");
    }

    public function contarRegistroTimpoImpro($ficha, $op, $maquina, $operador, $origen, $causa, $detalle, $fi, $ff) {

        return $this->query("CALL Bitacora_contarTimpo_prod('$this->id_empresa','$maquina','$operador','$origen','$causa','$fi','$ff','$detalle','$ficha','$op');");
    }

    public function contarRegistroOT($maquina, $estado, $fi, $ff) {
        return $this->query("CALL Bitacora_contarOT('$this->id_empresa','$maquina','$estado','$fi','$ff');");
    }

    public function contarRegistroOtIdMaquina($maquina, $estado, $fi, $ff) {
        return $this->query("CALL Bitacora_contarOTiDmaquina('$this->id_empresa','$maquina','$estado','$fi','$ff');");
        
        
    }

   

    public function consultarOT($maquina, $estado, $fi, $ff, $inicioLimite, $numeroPagina) {

        return $this->query("CALL Bitacora_consultarOTabierta('$this->id_empresa','$maquina','$estado','$fi','$ff','$inicioLimite','$numeroPagina');");
    }
     public function consultarOTidMaquina($maquina, $estado, $fi, $ff, $inicioLimite, $numeroPagina) {

        return $this->query("CALL Bitacora_consultarOTabiertaByIdMaquina('$this->id_empresa','$maquina','$estado','$fi','$ff','$inicioLimite','$numeroPagina');");
        
    }

    public function consultarHistorialOrdenDeTrabajo($maquina, $estado, $fi, $ff, $inicioLimite, $numeroPagina) {

        return $this->query("CALL OrdenTrabajo_consultarHistorial('$this->id_empresa','$maquina','$estado','$fi','$ff','$inicioLimite','$numeroPagina');");
    }

    public function contarHistorialOT($maquina, $estado, $fi, $ff) {
        return $this->query("CALL OrdenTrabajo_contarHistorial('$this->id_empresa','$maquina','$estado','$fi','$ff');");
    }

    public function consultarOTid($id) {

        return $this->query(" CALL Bitacora_consultarOTid('$this->id_empresa','$id');");
    }

    public function actualizarOTid($id, $estado) {

        return $this->query(" CALL Nota_actualizarEstado('$estado','$id','$this->id_empresa');");
    }

    public function consultarEstadoOT($id) {

        return $this->query(" CALL Bitacora_consultaEstaoOt('$this->id_empresa','$id');");
    }

    public function crearNotaMatto($id_mecanico, $detalle) {
        $this->query("CALL Nota_crear('$this->id_empresa','$id_mecanico','$detalle');");
    }

    public function relacionarNota_OT($id_ot, $id_nota) {

        $this->query("CALL Nota_relacionarConOT('$id_ot','$id_nota','$this->id_empresa');");
    }

    public function consultarNotaMecanicoId($id_nota) {

        return $this->query("CALL Nota_consultarId('$id_nota','$this->id_empresa');");
    }

    public function consultarNotaMecanicoPorOrdenDeTrabajo($id_ot) {

        return $this->query("CALL Nota_consultarNotasDeOtPorId('$id_ot','$this->id_empresa');");
    }

    public function compruebaExistenciaFichaRegistrarOP($param, $id_empresa) {
        return $this->query("CALL Ficha_ComprobarExistencia_Ficha_Bitacora('$param','$id_empresa')");
    }

    public function consultarMaquinaSeccionMayorIncidenciaPrefijoMAquina($maquina, $fi, $ff) {

        return $this->query("CALL Reporte_deFallasPorSeccionDeMaquinas('$this->id_empresa','$maquina','$fi','$ff');");
    }

    public function cargarOrigen($param) {
        $consulta = $this->query("CALL Bitacora_Listado_Origen_segun_Maquina($param) ");
        $num_total_registros = $consulta->num_rows;
        if ($num_total_registros > 0) {

            return $this->generarListadoDesplegable($consulta, 'id_defecto', 'descripcion');
        } else {
            return false;
        }
    }

    public function cargar_seccion_maquina($param) {
        $consulta = $this->query("CALL Bitacora_seccion_maquina($this->id_empresa,$param) ");

        $num_total_registros = $consulta->num_rows;
        if ($num_total_registros > 0) {

            return $this->generarListadoDesplegable($consulta, 'id_seccion', 'nombre_seccion');
        } else {
            return false;
        }
    }

    public function cargar_seccion($param) {
        $consulta = $this->query("CALL Bitacora_listado_seccion_maquina($this->id_empresa) ");

        $num_total_registros = $consulta->num_rows;
        if ($num_total_registros > 0) {

            return $this->generarListadoDesplegable($consulta, 'id_seccion', 'nombre_seccion');
        } else {
            return false;
        }
    }

    public function cargar_equipo_maquina($param) {
        $consulta = $this->query("CALL Bitacora_equipo_maquina($this->id_empresa,$param) ");
        $num_total_registros = $consulta->num_rows;
        if ($num_total_registros > 0) {

            return $this->generarListadoDesplegable($consulta, 'id_equipo', 'nombre_equipo');
        } else {
            return false;
        }
    }

    public function cargar_equipo() {
        $consulta = $this->query("CALL  Maquina_listado_equipo($this->id_empresa) ");
        $num_total_registros = $consulta->num_rows;
        if ($num_total_registros > 0) {

            return $this->generarListadoDesplegable($consulta, 'id_equipo', 'nombre_equipo');
        } else {
            return false;
        }
    }

    public function cargar_parte_equipo2() {
        $consulta = $this->query("CALL  Bitacora_Listado_partes_equipo($this->id_empresa) ");

        $num_total_registros = $consulta->num_rows;
        if ($num_total_registros > 0) {

            return $this->generarListadoDesplegable($consulta, 'id_parte', 'nombre_parte');
        } else {
            return false;
        }
    }

    public function cargar_equipo_maquina2($seccion, $maquina) {
        $consulta = $this->query("CALL Bitacora_equipo_maquina($this->id_empresa,$seccion,$maquina) ");
        $num_total_registros = $consulta->num_rows;
        if ($num_total_registros > 0) {

            return $this->generarListadoDesplegable($consulta, 'id_equipo', 'nombre_equipo');
        } else {
            return false;
        }
    }

    public function cargar_parte_equipo($seccion, $maquina, $equipo) {
        $consulta = $this->query("CALL Bitacora_maquina_seccion_equipo_parte($this->id_empresa,$seccion,$maquina,$equipo) ");
        $num_total_registros = $consulta->num_rows;
        if ($num_total_registros > 0) {

            return $this->generarListadoDesplegable($consulta, 'id_parte', 'nombre_parte');
        } else {
            return false;
        }
    }

    public function cargarListadoOperadoreSeMaquinaSeleccionada() {
        $consulta = $this->listaDesplegableOperadoresSegunMaquinaSeleccionada($this->code);
        $num_total_registros = $consulta->num_rows;
        if ($num_total_registros > 0) {
            return $this->generarListadoDesplegable($consulta, 'id', 'nombre');
        } else {
            return false;
        }
    }

    public function cargarListadores() {
        $consulta = $this->listaDesplegableOperadores();
        $num_total_registros = $consulta->num_rows;
        if ($num_total_registros > 0) {

            return $this->generarListadoDesplegable($consulta, 'id', 'nombre');
        } else {
            return false;
        }
    }

    public function cargarListaOrigen() {
        $consulta = $this->listaDesplegableOrigen();
        $num_total_registros = $consulta->num_rows;
        if ($num_total_registros > 0) {

            return $this->generarListadoDesplegable($consulta, 'id_defecto', 'descripcion');
        } else {
            return false;
        }
    }

    public function cargarOrigen_b() {
        $consulta = $this->query("SELECT  defecto.id_defecto, defecto.descripcion
FROM defecto where defecto.id_empresa=$this->id_empresa");

        $num_total_registros = $consulta->num_rows;
        if ($num_total_registros > 0) {

            return $this->generarListadoDesplegable($consulta, 'id_defecto', 'descripcion');
        } else {
            return false;
        }
    }

    function cargarCausas() {
        $consulta = $this->query(" CALL Bitacora_Listado_de_Causa_segun_Origen_y_Maquina($this->code,$this->id_maquina,$this->id_empresa);");


        $num_total_registros = $consulta->num_rows;
        if ($num_total_registros > 0) {

            return $this->generarListadoDesplegable($consulta, 'id_causa', 'nombre_causa');
        } else {
            return false;
        }
    }

    function cargarCausas_b() {
        $consulta = $this->query(" CALL Bitacora_listado_causa_segun_origen($this->code);");


        $num_total_registros = $consulta->num_rows;
        if ($num_total_registros > 0) {

            return $this->generarListadoDesplegable($consulta, 'id_causa', 'nombre_causa');
        } else {
            return false;
        }
    }

    function cargarCausasSegunOrigen_b() {

        $consulta = $this->query(" CALL Bitacora_Listado_de_Causa_segun_Origen('$this->code','$this->id_empresa');");


        $num_total_registros = $consulta->num_rows;
        if ($num_total_registros > 0) {

            return $this->generarListadoDesplegable($consulta, 'id_causa', 'nombre_causa');
        } else {
            return false;
        }
    }

    function cargarTecnicos() {

        $consulta = $this->query(" CALL Bitacora_Listado_tecnicos('$this->id_empresa');");


        $num_total_registros = $consulta->num_rows;
        if ($num_total_registros > 0) {

            return $this->generarListadoDesplegable($consulta, 'id', 'nombre');
        } else {
            return false;
        }
    }

    function cargarTipoMateriales() {

        $consulta = $this->query("   CALL Bitaora_ListaDesplegableTipoMaterial($this->code,$this->id_empresa)");

        if ($consulta->num_rows > 0) {

            return $this->generarListadoDesplegable($consulta, 'id', 'descripcion');
        } else {
            return false;
        }
    }

    function cargarListaCausas_busquedas() {

        $consulta = $this->query(" CALL Bitacora_listado_causas($this->id_empresa);");


        $num_total_registros = $consulta->num_rows;
        if ($num_total_registros > 0) {

            return $this->generarListadoDesplegable($consulta, 'id_causa', 'nombre_causa');
        } else {
            return false;
        }
    }

    public function cargarListaCausas() {
        $consulta = $this->listaDesplegableCausas();
        $num_total_registros = $consulta->num_rows;

        if ($num_total_registros > 0) {
            return $this->generarListadoDesplegable($consulta, 'id_causa', 'nombre_causa');
        } else {
            return false;
        }
    }

    public function cargarMaquinas() {
        $consulta = $this->listaDesplegableMaquina2();


        $num_total_registros = $consulta->num_rows;
        if ($num_total_registros > 0) {
            return $this->generarListadoDesplegable($consulta, 'id_maquina', 'nombre_maquina');
        } else {
            return false;
        }
    }

    public function cargarMaquinasSegunArea() {

        /* se consulta la session de las maquinas */

        $id_area = $this->consultarSeccionSegunUsuario();
        $this->next_result();

        $consulta = $this->listaDesplegableMaquinaSegunArea($id_area);
        $num_total_registros = $consulta->num_rows;

        if ($num_total_registros > 0) {

            return $this->generarListadoDesplegable($consulta, 'id_maquina', 'nombre_maquina');
        } else {
            return false;
        }
    }

    /**
     * 
     * @param type $consulta consulta generada previamente 
     * @param type $index1 valor del primer index
     * @param type $index2 contenido del array en el idex1
     * @return type
     */
    public function generarListadoDesplegable($consulta, $index1, $index2) {

        $vector = array();

        while ($array = $consulta->fetch_array(MYSQLI_ASSOC)) {
            $indice = $array[$index1];
            $name = $array[$index2];
            $vector[$indice] = $name;
        }
        return $vector;
    }

    public function cargarTipoRollo() {
        $consulta = $this->crearListaDesplegable();


        $num_total_registros = $consulta->num_rows;
        if ($num_total_registros > 0) {

            return $this->generarListadoDesplegable($consulta, 'id', 'prefijo_rollo');
        } else {
            return false;
        }
    }

    public function consultarAreaUsuario() {
        $usuario = ($_SESSION['k_userName']);

        return $this->query("CALL Bitacora_consultarAreasPorUsuario('$usuario','$this->id_empresa');");
    }

    public function contarRegistroResumenOp($op, $ficha, $id_maquina, $fi, $ff) {
        return $this->query("CALL Formato_contar_resumido_ordenes('$op','$ficha','$id_maquina','$fi','$ff');");
    }

    public function consultaBitacoraRegistrada($id_bitacora) {

        return $this->query("CALL Bitacora_consultarBitacoraRegistrada($id_bitacora);");
    }

    public function listaDesplegableOperadores() {
        return $this->query("CALL Bitacora_Listado_operadores('$this->id_empresa');");
    }

    public function listaDesplegableOrigen() {
        return $this->query("CALL Bitacora_Listado_origen('$this->id_empresa');");
    }

    public function listaDesplegableCausas() {
        return $this->query("CALL ListaDesplegableCausas('$this->id_empresa');");
    }

    public function consultarHistorialBitacoraTiempoImproductivo($ficha, $usuario, $maquina, $op, $detalle, $defecto, $causa, $fi, $ff, $limite, $ancho, $calibre, $densidad, $formula, $id_empresa) {
        return $this->query("CALL Bitacora_ConsultaHistorialBitacora('$ficha','$maquina','$op','$detalle','$causa','$defecto','$usuario','$fi','$ff','$limite','$ancho','$calibre','$densidad','$formula','$id_empresa');");
    }

    public function consultarHistorialBitacora_registro($maquina, $operador, $detalle, $fi, $ff, $inicio, $fin) {




        return $this->query("CALL Bitacora_ConsultaHistorialBitacora_1('$this->id_empresa','$maquina','$operador','$detalle','$fi','$ff','$inicio','$fin');");
    }

    public function consultaTotalizadoHorasimproductivas($ficha, $usuario, $maquina, $op, $detalle, $defecto, $causa, $fi, $ff, $limite, $ancho, $calibre, $densidad, $id_empresa) {
        return $this->query("CALL BitacoraConsultaHistorialBitacoraConsolidadoTiempoImproductivo('$ficha','$maquina','$op','$detalle','$defecto','$causa','$usuario','$fi','$ff','$ancho','$calibre','$densidad','$id_empresa');");
    }

    public function consultaDetalleHorasimproductivas($ficha, $usuario, $maquina, $op, $detalle, $defecto, $causa, $fi, $ff, $ancho, $calibre, $densidad, $id_empresa) {
        return $this->query("CALL BitacoraConsultaDetalleTiempoImproductivo('$ficha','$maquina','$op','$detalle','$defecto','$causa','$usuario','$fi','$ff','$ancho','$calibre','$densidad','$id_empresa');");
    }

    public function consultaTiempoImproductivo($id_empresa) {

        return $this->query("CALL BitacoraConsultaTiempoImproductivo('$this->op','$id_empresa');");
    }

    public function consultaBitacora($id_bitacora) {

        return $this->query("CALL Bitacora_consultar('$this->id_empresa','$id_bitacora');");
    }

    public function visualizarRegistroTiempoImproductivo($id_bitacora) {

        return $this->query("call Bitacora_consultarTiempoImproductivo('$this->id_empresa','$id_bitacora');");
    }

    /**
     * consulta el tiempo improductivo sin describir
     * las partes y secciones de la maquina
     * @param type $id_bitacora
     * @return type
     */
    public function consultaBitacora_tiempoImproductivo2($id_bitacora) {


        return $this->query("call consultarTimpoImproductivoRegistrado('$this->id_empresa','$id_bitacora');");
    }

    public function consultaConsolidadoTiempoImproductivo($id_empresa) {

        return $this->query("CALL  Bitacora_consolidadoTiempoImproductivo('$this->op','$id_empresa');");
    }

    public function consultaDetalleTiempoImproductivo($id_empresa) {

        return $this->query("CALL  Bitacora_DetalleTiempoImproductivo('$this->op','$id_empresa');");
    }

    public function registrarEncabezadoFormato() {

        return $this->query("CALL Bitacora_registrar_encabezado_formato($this->op,'$this->ficha');");
    }

    public function registrarRelacionMaquinaOP() {

        return $this->query("CALL Bitacora_registrar_ROP_Maquina($this->op,'$this->id_maquina');");
    }

    public function pruebaTransaccionManual($usuario, $id_empresa) {

        $this->query("BING;");
        $this->query("CALL Bitacora_registrarDetalle('$this->ficha','$usuario','$this->id_maquina','$this->op','$this->detalle','$this->tiempoImpruductivo','$this->origen_tiempoImproductivo','$this->IdCausa','$this->idOperador','$this->ancho','$this->calibre','$this->densidad','$id_empresa');");
        $this->query("COMMIT;");
    }

    public function registroBitacora($usuario) {

        $this->query("BING;");
        $this->query("CALL Bitacora_registrar('$this->id_empresa','$this->id_maquina','$this->idOperador','$this->kwh','$this->detalle','$usuario','$this->idTurno');");

        $this->query("COMMIT;");
    }

    public function registrarTiempoImproductivo() {

        $this->query("BING;");
        $this->query("CALL Bitacora_rg_tiempoImproductivo('$this->id_empresa','$this->id_maquina','$this->idSeccionMaquina','$this->idOperador','$this->IdEquipo','$this->idParteEquipo','$this->tiempoImpruductivo','$this->origen_tiempoImproductivo','$this->IdCausa','$this->detalle','$this->usuario','$this->idTurno');");

        $this->query("COMMIT;");
    }

    public function registrarTiempoImproductivoDiaDiferente() {

        $this->query("BING;");
        $this->query("CALL Bitacora_rg_tiempoImproductivoDiaDiferente('$this->id_empresa','$this->id_maquina','$this->idSeccionMaquina','$this->idOperador','$this->IdEquipo','$this->idParteEquipo','$this->tiempoImpruductivo','$this->origen_tiempoImproductivo','$this->IdCausa','$this->detalle','$this->usuario','$this->idTurno','$this->date');");
        $this->query("COMMIT;");
    }

    public function registrarTiempoImproductivoLog($id_empresa, $id_maquina, $id_seccion, $id_operador, $id_equipo, $id_parte_equipo, $tiempoImpruductivo, $origen_tiempoImproductivo, $causa, $detalle, $usuario, $turno) {


        $this->query("CALL Bitacora_rg_tiempoImproductivoLog('$id_empresa','$id_maquina','$id_seccion','$id_operador','$id_equipo','$id_parte_equipo','$tiempoImpruductivo','$origen_tiempoImproductivo','$causa','$detalle','$usuario','$turno');");
    }

    /**
     * este registro se realiza desde produccion, y no se registra
     * fallas o averias de maquinas
     * @param type $usuario
     */
    public function registroBitacora_tiempoImproductivoProduccion($usuario) {

        $this->query("BING;");
        $this->query("CALL Bitacora_rg_timpoProduccion('$this->id_empresa','$this->id_maquina','$this->idSeccionMaquina','$this->idOperador','$this->IdEquipo','$this->idParteEquipo','$this->tiempoImpruductivo','$this->origen_tiempoImproductivo','$this->IdCausa','$this->detalle','$usuario','$this->idTurno','$this->ficha','$this->op');");

        $this->query("COMMIT;");
    }

    public function relacionBitacoraFormula($id_bitacora) {

        return $this->query("CALL Bitacora_formula('$id_bitacora','$this->formula','$this->id_empresa');");
    }

    public function optenerUltimoConsecutivoRegistrado() {

        $consulta = $this->query("SELECT LAST_INSERT_ID() id;");
        $rowcount = $consulta->fetch_array(MYSQLI_ASSOC);
        $id_bitacora = $rowcount['id'];

        return $id_bitacora;
    }

    public function compruebaExistenciaMaquina() {

        $consulta = $this->consultaExistenciaMaquina();

        if (($consulta->num_rows) <= 0) {

            mensajeDeErrorModal($titulo = 'LA MAQUINA SELECCIONADA NO EXISTE'
                    , $subtitulo = 'Seleccione una maquina de la lista desplegable'
                    , $mensaje = 'Para un mejor resultado , consulte las maquinas registradas en su sistema, para esto pongase en contacto con el administrador');
            exit();

            raiz();
        }
    }

    public function consultaExistenciaMaquina() {

        return $this->query("CALL Maquina_ComprobarExistencia_Maquina('$this->id_maquina','$this->id_empresa')");
    }

    public function compruebaExistenciaSeccionMaquina() {

        $consulta = $this->consultaExistenciaSeccionMaquina();

        if (($consulta->num_rows) <= 0) {
            mensajeDeErrorModal($titulo = 'LA SECCION SELECCIONADA NO EXITE'
                    , $subtitulo = 'Seleccione una seccion de la lista desplegable'
                    , $mensaje = 'Para un mejor resultado , consulte las secciones registradas en su sistema, para esto pongase en contacto con el administrador');
            exit();

            raiz();
        }
    }

    public function consultaExistenciaSeccionMaquina() {

        return $this->query("CALL Bitacora_consultar_seccionMaquina('$this->idSeccionMaquina','$this->id_empresa')");
    }

    public function compruebaExistenciaEquipoMaquina() {

        $consulta = $this->consultaExistenciaEquipoMaquina();
        if (($consulta->num_rows) <= 0) {

            mensajeDeErrorModal($titulo = 'EL EQUIPO SELECCIONADO NO EXITE'
                    , $subtitulo = 'Seleccione un equipo de la lista desplegable'
                    , $mensaje = 'Para un mejor resultado , consulte los equipos registradas en su sistema, para esto pongase en contacto con el administrador');
            exit();

            raiz();
        }
    }

    public function consultaExistenciaEquipoMaquina() {

        return $this->query("CALL Bitacora_consultarExistenciaEquipo('$this->IdEquipo','$this->id_empresa')");
    }

    public function compruebaExistenciaParteEquipoMaquina() {

        $consulta = $this->consultaExistenciaParteEquipoMaquina();
        if (($consulta->num_rows) <= 0) {
            mensajeDeErrorModal($titulo = 'LA PARTE DEL EQUIPO SELECCIONADO NO EXISTE'
                    , $subtitulo = 'Seleccione una parte de la lista desplegable'
                    , $mensaje = 'Para un mejor resultado , consulte las  partes de los equipos registradas en su sistema, para esto pongase en contacto con el administrador');
            exit();

            raiz();
        }
    }

    public function consultaExistenciaParteEquipoMaquina() {

        return $this->query("CALL Bitacora_consultarExistenciaParteEquipo('$this->idParteEquipo','$this->id_empresa')");
    }

    public function compruebaExistenciaCausaTiempoImproductivo() {

        $consulta = $this->consultaExistenciaCausaTiempoImproductivo();
        if (($consulta->num_rows) <= 0) {
            mensajeDeErrorModal($titulo = 'LA CAUSA DE TIMEMPO IMPRODUCTIVO NO EXISTE'
                    , $subtitulo = 'Seleccione una  de la lista desplegable'
                    , $mensaje = 'Para un mejor resultado , consulte las causas registradas  en su sistema, para esto pongase en contacto con el administrador');
            exit();
        }
    }

    public function consultaExistenciaCausaTiempoImproductivo() {

        return $this->query("CALL Bitacora_consultarExistenciaCausa('$this->IdCausa','$this->id_empresa')");
    }

    public function compruebaExistenciaTipoCausaTiempoImproductivo() {

        $consulta = $this->consultaExistenciaTipoCausaTiempoImproductivo();
        if (($consulta->num_rows) <= 0) {



            mensajeDeErrorModal($titulo = 'EL TIPO DE CAUSA NO EXISTE'
                    , $subtitulo = 'Seleccione uno  de la lista desplegable'
                    , $mensaje = 'Para un mejor resultado , consulte los  tipos causas registradas  en su sistema, para esto pongase en contacto con el administrador');
            exit();
        }
    }

    public function consultaExistenciaTipoCausaTiempoImproductivo() {

        return $this->query("CALL Bitacora_consultarExistenciaTipoDeCausa('$this->origen_tiempoImproductivo','$this->id_empresa')");
    }

    public function compruebaExistenciaOperador() {

        $consulta = $this->consultaExistenciaOperador();
        if (($consulta->num_rows) <= 0) {
            mensajeDeErrorModal($titulo = 'EL OPERADOR SELECCIONADO NO EXISTE'
                    , $subtitulo = 'Seleccione un operador de la lista desplegable'
                    , $mensaje = 'Para un mejor resultado , consulte los operadores registrados  en su sistema, para esto pongase en contacto con el administrador');
            exit();

            raiz();
        }
    }

    public function consultaExistenciaOperador() {
        return $this->query("CALL Opereador_ComprobarExistencia_Operador('$this->idOperador','$this->id_empresa')");
    }

    public function relacionarBitacoraDefecto($id_bitacora, $id_defecto) {

        return $this->query("CALL Bitacora_registrarDefecto($id_bitacora,$id_defecto);");
    }

    public function consultarHistorialBitacora($ficha, $usuario, $maquina, $op, $detalle, $defecto, $fi, $ff, $limite) {
        return $this->query("CALL Bitacora_ConsultarHistorialBitacora('$ficha','$usuario','$maquina','$op','$detalle','$defecto','$fi','$ff','$limite');");
    }

    public function consultarHistorialTiempoImproductivo($maquina, $operador, $equipo, $origen, $causa, $detalle, $fi, $ff, $inicio, $numeroPagina) {
        return $this->query("CALL Bitacora_consultarHistorialTiempoImproductivo('$this->id_empresa','$maquina','$operador','$equipo','$origen','$causa','$detalle','$fi','$ff','$inicio','$numeroPagina');");
    }

    public function consultarHistorialTiempoImproductivoProduc($maquina, $operador, $origen, $causa, $detalle, $fi, $ff, $inicio, $numeroPagina, $ficha, $op) {

        return $this->query("CALL Bitacora_consultarHistorialTiempoImproductivoProduc('$this->id_empresa','$maquina','$operador','$origen','$causa','$detalle','$fi','$ff','$inicio','$numeroPagina','$ficha','$op');");
    }

    public function exportarTiempoImproductivoExcell2($maquina, $operador, $origen, $causa, $detalle, $fi, $ff, $ficha, $op) {
        return $this->query("CALL exportarTiempoImproductivo('$this->id_empresa','$maquina','$operador','$origen','$causa','$detalle','$fi','$ff','$ficha','$op');");
    }

    public function exportarTiempoImproductivoExcell($maquina, $operador, $equipo, $origen, $causa, $detalle, $fi, $ff) {
        return $this->query("CALL Bitacora_ConsultaHistorialExportarExcell('$this->id_empresa','$maquina','$operador','$equipo','$origen','$causa','$detalle','$fi','$ff');");
    }

    public function consultaOpDuplicada() {

        $resultado = $this->query(" CALL Formato_consulta_op_duplicada($this->op)");
        return $resultado;
    }

    public function consultaEncabezadoOp($id_empresa) {

        $resultado = $this->query(" CALL Formato_consulta_encabezadoFormatos('$this->op','$id_empresa')");
        return $resultado;
    }

    public function consultaResumidoOrdenesDeProduccion($op, $ficha, $id_maquina, $fi, $ff, $limite) {

        return $this->query(" CALL Formato_consulta_resumido_ordenes('$op','$ficha','$id_maquina','$fi','$ff','$limite')");
    }

    public function crearListaDesplegable() {

        $consulta = $this->query("CALL TipoRollos_ListaDesplegable();");
        return $consulta;
    }

    public function registrarFormatoProduccion($muestra, $No_rollo, $kilos, $unidades, $turno, $operador) {

        $consulta = $this->query("call Bitacora_registrarFormatoProduccion($this->op,$muestra,$No_rollo,$kilos,$unidades,$turno,'$operador');");

        return $consulta;
    }

    public function buscarDetalleFormatoProduccion($id_empresa) {

        $consulta = $this->query("CALL Bitacora_FormatoProduccion_MostrarDetalleProduccion('$this->op','$id_empresa')");
        return $consulta;
    }

    public function buscarDetalleTotalizadoFormatoProduccion($id_empresa) {

        return $this->query("CALL Bitacora_TotalizarFormatoProduccioFn('$this->op','$id_empresa')");
    }

    public function setDetalle($detalle) {

        $this->detalle = $this->desinfeccionDeVariables($detalle);
        $this->detalle = substr($this->detalle, 0, 999);
    }

    public function setFicha($ficha) {

        $this->ficha = $this->desinfeccionDeVariables($ficha);
    }

    public function setOp($op) {
        $this->op = $op;
        $this->validarOp();
    }

    private function validarOp() {

        if (!(is_numeric($this->op)) && (!($this->kilosProducidos > 1))) {
            mensajeDeErrorModal('VALOR INVALIDO PARA EL CAMPO ORDEN DE PRODUCCION ', 'Por favor rectifique, no se permiten valores igual o menor que cero.', '');
        }
    }

    public function setMaquina($maquina) {

        $this->id_maquina = (int) $maquina;
    }

    public function getMaquina() {

        return $this->id_maquina;
    }

    public function getFicha() {

        return $this->ficha;
    }

    public function getOp() {
        return $this->op;
    }

    public function getTiempoImproductivo() {

        return $this->tiempoImpruductivo;
    }

    public function setTurno($turno) {
        $this->idTurno = $turno;
    }

    public function getTurno() {

        return $this->idTurno;
    }

    public function consultarMaquinaMayorIncidencia($maquina, $fi, $ff) {

        return $this->query("CALL Bitacora_estadisticaMaquinaMayorIncidencia('$this->id_empresa','$maquina','$fi','$ff');");
    }

    public function estadisticaProduccionEsperada($maquina, $operador, $turno, $fi, $ff) {


        return $this->query("CALL Estadistica_Produccion('$maquina','$operador','$turno','$fi','$ff','$this->id_empresa');");
    }

    public function estadisticaProduccionEsperadaPaginada($maquina, $operador, $turno, $fi, $ff, $inicio, $numeroPagina) {

        return $this->query("CALL Estadistica_ProduccionPaginada('$maquina','$operador','$turno','$fi','$ff','$this->id_empresa','$inicio','$numeroPagina');");
    }

    /*
     * reemplaza estadisticaProduccionEsperadaPaginada
     */

    public function estadisticaProduccionEsperadaPaginadaPrueba($maquina, $operador, $turno, $fi, $ff, $inicio, $numeroPagina) {

        return $this->query("CALL produccionEsperada_prueba('$maquina','$operador','$turno','$fi','$ff','$this->id_empresa','$inicio','$numeroPagina');");
    }

    public function consultaCausaBajaProductividad($annio, $mes, $dia, $maquina, $turno) {

        return $this->query("CALL consultaCausaBajaProduccion('$this->id_empresa',$annio,$mes,$dia,'$maquina','$turno');");
    }

    public function consultarMaquinaEquipoMayorIncidencia($maquina, $seccion, $equipo, $fi, $ff) {

        return $this->query("CALL Bitacora_maquinaEquipoMayorIncidencia('$this->id_empresa','$maquina','$seccion','$equipo','$fi','$ff');");
    }

    public function consultarMaquinaEquipoParteMayorIncidencia($maquina, $seccion, $equipo, $fi, $ff) {

        return $this->query("CALL Bitacora_maquinaEquipoParteMayorIncidencia('$this->id_empresa','$maquina','$seccion','$equipo','$fi','$ff');");
    }

    public function consultarEncabezadoDinamica() {

        return $this->query("CALL Bitacora_ConsultaDinamica_encabezado('$this->id_empresa','$this->nombreMaquina');");
    }

    public function consultarIdEncabezadoDinamico() {

        return $this->query("CALL consultarIdTiempoImproductivo('$this->id_empresa','$this->nombreMaquina');");
    }

    public function setNombreMaquina($nombreMaquina) {
        $this->nombreMaquina = $nombreMaquina;
    }

    public function consultarTiempoImproductivoDinamica($consulta, $orderby, $maquina, $fi, $ff) {


        return $this->query("CALL Bitacora_consulta_tiempo_improductivo_dinamico('$this->id_empresa','$consulta','$orderby','$maquina','$fi','$ff');");
    }

    public function consultarHistorialTiempoImproductivoProducCorto($maquina, $operador, $origen, $causa, $detalle, $fi, $ff, $inicio, $numeroPagina, $ficha, $op) {

        return $this->query("CALL Bitacora_consultarHistorialTiempoImproductivoProducCorto('$this->id_empresa','$maquina','$operador','$origen','$causa','$detalle','$fi','$ff','$inicio','$numeroPagina','$ficha','$op');");
    }

    public function consultaRegistroBitacoraPorID($id_registro) {

        return $this->query("CALL consultaRegistroBitacoraPorID('$this->id_empresa','$id_registro');");
    }

    public function getDatosTiempoImproductivo($id_registro) {

        $mysql_result = $this->consultaRegistroBitacoraPorID($id_registro);
        $rowcount = $mysql_result->fetch_array(MYSQLI_ASSOC);
        $HorasTurno = $rowcount['tiempo_laboral'];
        return $HorasTurno;
    }

    /**
     * 
     * crea una cadena sql utilizada para  generar una pivotable
     * el arrayId son los codigos de origen de problema, 
     * los cuales se utilizan para preguntar si el origen falla es igual a ese codigo
     * si es asi sume todo el tiempo improductivo registrado por cada tipo de tiemp
     * improductivo
     * 
     * por cada causa pregunte if(id_origen==1) suma sino sume 0,                                           
     * 
     */
    public function crearConsultaDinamica($arrayIdEncabezadoTablaConsolidatoTiempoImproductivo) {

        $count = sizeof($arrayIdEncabezadoTablaConsolidatoTiempoImproductivo) - 1;

        $id = 1;
        $consulta_dinamica = 'TRUNCATE (SUM(IF(tiempo_improductivo_1.id_origen_falla ="   ' . $arrayIdEncabezadoTablaConsolidatoTiempoImproductivo[$id] . ' "  , tiempo_improductivo_1.timp,"") ),2)produccion,';

        for ($i = 2; $i <= $count; $i++) {

            $consulta_dinamica.= 'TRUNCATE (SUM(IF(tiempo_improductivo_1.id_origen_falla = "' . $arrayIdEncabezadoTablaConsolidatoTiempoImproductivo[$i] . ' " , tiempo_improductivo_1.timp,"") ),2)produccion,';
        }


        return $consulta_dinamica;
    }

    /**
     * recibe los encabezados que se mostraran en la tabla TIEMPO CONSOLIDADO
     * pero ademas agrega el encabezado CAUSA al inicio y al finla TOTOAL, 
     * donse se suma el total de los tiempos improductivos y al inicio se describe
     * cual es la causa que genero ese tiempo
     */
    public function crearColumnasDinamica($matriz) {

        $vector = ($this->convertirArrayEnVector($matriz));
        array_unshift($vector, "CAUSA");
        array_push($vector, "TOTAL");
        return $vector;
    }

    public function crearColumnasDinamicaID($matriz) {

        $vec = ($this->convertirArrayEnVector($matriz));
        array_unshift($vec, 0);

        return $vec;
    }

    private function convertirArrayEnVector($matriz) {

        foreach ($matriz as $filas) {
            foreach ($filas as $columnas) {
                $vector[] = $columnas;
            }
        }// fin del for principal

        return $vector;
    }

    public function determinarCuantasMaquinasConsultarTintas($maquina) {

        $maquinaBuscar = '';
        $id_area = $this->consultarSeccionSegunUsuario();
        $this->next_result();

        $consulta = $this->listaDesplegableMaquinaSegunArea($id_area);
        $num_total_registros = $consulta->num_rows;
        $this->next_result();

// si tien mas de una maquina se debe  validar que el sistema consulte esas maquinas y tome

        if ($num_total_registros > 1) {
            $maquinaBuscar = $this->crearConsultalike($maquina);
        } else {

            $consulta = $this->listaDesplegableMaquinaSegunArea($id_area);
            $obJeto = $consulta->fetch_object();
            $maquina = $obJeto->id_maquina;
            $maquinaBuscar = $this->crearConsultalike($maquina);
            $this->next_result();
        }


        return $maquinaBuscar;
    }

    public function getPrefijoMaquina($area) {


        $consulta = $this->consultaPrefijoMaquinaSegunArea($area);
        $prefijo = $consulta->fetch_array(MYSQLI_ASSOC);
        $this->next_result();
        return $prefijo["prefijo"];
    }

    public function consultaPrefijoMaquinaSegunArea($area) {

        return $this->query("CALL MaquinaConsultaPrefijo('$area','$this->id_empresa');");
    }

    public function getPrefijoCompletoMaquina($area, $maquina) {



        $consulta = $this->consultaPrefijoCompletoMaquinaSegunArea($area, $maquina);
        $prefijo = $consulta->fetch_array(MYSQLI_ASSOC);
        $this->next_result();
        return $prefijo["prefijo"];
    }

    public function consultaPrefijoCompletoMaquinaSegunArea($area, $maquina) {

        return $this->query("CALL MaquinaConsultaPrefijoCompleto('$area','$this->id_empresa','$maquina');");
    }

    public function contarRegistroTimpoImproConPrefijoMaquina($ficha, $op, $maquina, $operador, $origen, $causa, $detalle, $fi, $ff) {

        return $this->query("CALL contarRegistroTimpoImproConPrefijoMaquina('$this->id_empresa','$maquina','$operador','$origen','$causa','$fi','$ff','$detalle','$ficha','$op');");
    }

    public function consultarHistorialTiempoImproductivoProducCortoSegunPrefijoMAquina($maquina, $operador, $origen, $causa, $detalle, $fi, $ff, $inicio, $numeroPagina, $ficha, $op) {

        return $this->query("CALL ConsultaHistoricoBitacoraSegunPrefijoMAquina('$this->id_empresa','$maquina','$operador','$origen','$causa','$detalle','$fi','$ff','$inicio','$numeroPagina','$ficha','$op');");
        
        
        
    }

    public function contarRegistroEnTablaProduccionPrefijoMAquina($maquina, $operador, $turno, $fi, $ff) {
        return $this->query("CALL contarRegistrosEnTablaProduccionPrefijoMaquina('$maquina','$operador','$turno','$fi','$ff','$this->id_empresa');");
    }

    public function estadisticaProduccionEsperadaPaginadaPruebaPrefijo($maquina, $operador, $turno, $fi, $ff, $inicio, $numeroPagina) {

        return $this->query("CALL produccionEsperada_pruebaPrefijoMAquina('$maquina','$operador','$turno','$fi','$ff','$this->id_empresa','$inicio','$numeroPagina');");
    }

    public function estadisticaProduccionEsperadaPaginadaPruebaPrefijoConVelocidad($maquina, $operador, $turno, $fi, $ff, $inicio, $numeroPagina) {

        return $this->query("CALL produccionEsperada_CalculadaSegunVelocidad('$maquina','$operador','$turno','$fi','$ff','$this->id_empresa','$inicio','$numeroPagina');");
        
        
        
        
        
    }
    
    public function  reporteProuduccionDetallado($maquina, $operador, $turno, $fi, $ff, $inicio, $numeroPagina){
        return $this->query("CALL reporteProduccionDetallado('$maquina','$operador','$turno','$fi','$ff','$this->id_empresa','$inicio','$numeroPagina');");
        
        
    }

    public function estadisticaResumida($maquina, $operador, $turno, $fi, $ff) {

        return $this->query("CALL eficienciaPorProceso('$maquina','$operador','$turno','$fi','$ff','$this->id_empresa');");
    }

    public function eficienciaPorProcesoSoloMaquina($maquina, $operador, $turno, $fi, $ff) {

        return $this->query("CALL eficienciaPorProcesoSoloMaquina('$maquina','$operador','$turno','$fi','$ff','$this->id_empresa');");
    }

    public function totalHoraCuadreProduccionPorOperadorYmaquina($maquina, $operador, $fi, $ff) {

        return $this->query("CALL totalHoraCuadreProduccion('$this->id_empresa','$maquina','$operador','$fi','$ff');");
    }

    public function consultarMaquinaMayorIncidenciaPrefijoMAquina($maquina, $fi, $ff) {

        return $this->query("CALL Bitacora_estadisticaMaquinaMayorIncidenciaPrefijoMaquina('$this->id_empresa','$maquina','$fi','$ff');");
    }

    public function consultarMaquinaEquipoMayorIncidenciaPrefijoMaquina($maquina, $seccion, $equipo, $fi, $ff) {

        return $this->query("CALL Bitacora_maquinaEquipoMayorIncidenciaPrefijoMaquina('$this->id_empresa','$maquina','$seccion','$equipo','$fi','$ff');");
    }

    public function consultarMaquinaEquipoParteMayorIncidenciaPrefijoMaquina($maquina, $seccion, $equipo, $fi, $ff) {

        return $this->query("CALL Bitacora_maquinaEquipoParteMayorIncidenciaPrefijoMaquina('$this->id_empresa','$maquina','$seccion','$equipo','$fi','$ff');");
    }

    public function consultarTiempoImproductivoDinamicaPrefijoMAquina($consulta, $orderby, $maquina, $fi, $ff) {


        return $this->query("CALL Bitacora_consulta_tiempo_improductivo_dinamicoPrefijoMaquina('$this->id_empresa','$consulta','$orderby','$maquina','$fi','$ff');");
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

        return $this->query("CALL HorasLaboralesReales('$this->id_maquina','$this->id_empresa');");
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

        return $this->query("CALL sumarHorasPorTurno('$this->id_empresa','$this->idOperador','$this->idTurno','$annio','$mes','$dia','$this->id_maquina');");
    }

    public function actualizarRegistroBitacora($id_registro) {

        $this->query("BING;");
        $this->query("CALL ActualizarREgistroBitacora('$this->id_empresa','$this->id_maquina','$this->idSeccionMaquina','$this->idOperador','$this->IdEquipo','$this->idParteEquipo','$this->tiempoImpruductivo','$this->origen_tiempoImproductivo','$this->IdCausa','$this->detalle','$this->usuario','$this->idTurno','$this->date','$id_registro');");


        $this->query("COMMIT;");
    }

    function getParametroDeBusqueda(Permiso $obj_permiso, Bitacora $bitacora, $maquina) {





        /*
          esta funcion devuelve un parametro de busqueda con el siguiente formato
          like "%%" para el administrador y like"%argumento%" para los otros usuarios
         */

        if ($obj_permiso->isAdministrador() || $obj_permiso->isMatto()) {
            $maquina = $bitacora->crearConsultalike($maquina);
        } else {

            $maquina = $bitacora->determinarCuantasMaquinasConsultar($maquina);
        }

        return $maquina;
    }

    public function determinarCuantasMaquinasConsultar($maquina) {



        $maquinaBuscar = '';
        $prefijo = '';
        $id_area = $this->consultarSeccionSegunUsuario();



        $this->next_result();

        $consulta = $this->listaDesplegableMaquinaSegunArea($id_area);
        $numeroDeMaquinas = $consulta->num_rows;
        $this->next_result();

        if ($this->usuarioManejaMasdeUnaMaquina($numeroDeMaquinas)) {

            $prefijo = $this->getPrefijoMaquinaParaBuscar($maquina, $id_area);
            $maquinaBuscar = $this->crearConsultalikeConPrefijo($prefijo);
        } else {

            $prefijo = $this->getPrefijoMaquina($id_area);
            $maquinaBuscar = $this->crearConsultalikeConPrefijo($prefijo);
        }


        return $maquinaBuscar;
    }

    public function consultarSeccionSegunUsuario() {
        $consulta = $this->consultarAreaSegunusuario($_SESSION['k_userName']);

        $area = $consulta->fetch_array(MYSQLI_ASSOC);
        $id_seccion = $area["id_area"];



        return $id_seccion;
    }

    public function consultarAreaSegunusuario($usuario) {
        return $this->query("CALL Bitacora_ConsultaAreaSegunUsuario('$usuario','$this->id_empresa');");
    }

    public function listaDesplegableMaquinaSegunArea($area) {
        return $this->query("CALL ListaDesplegableMaquinaSegunArea('$area','$this->id_empresa');");
    }

    private function usuarioManejaMasdeUnaMaquina($numeroDeMaquinas) {

        return ($numeroDeMaquinas > 1);
    }

    private function getPrefijoMaquinaParaBuscar($maquina, $id_area) {

        $prefijo = '';


        if ($maquina == 0) {

            /* si el usuario no Seleccion Una Maquina */
            $prefijo = $this->getPrefijoMaquina($id_area);
        } else {
            /* el Selecciona Una maquina para consultar */

            $prefijo = $this->getPrefijoCompletoMaquina($id_area, $maquina);
        }




        return $prefijo;
    }

}

// fin de clase Bitacora
?>

<?php

//  @session_start();
//  $_SESSION['k_userName'] = 'amd';
//  $_SESSION['k_userPass'] = '12345678';
//$p = new Bitacora();
//$p->turnoA(time());
// $p->setidEmpresa($_SESSION['k_empresa']);
//$p->cargarOrigen_b();
//  echo "hola";
?>