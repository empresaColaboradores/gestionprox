<?php

require_once('../../modelo/captcha.php');
require_once '../../modelo/Bitacora.php';
require_once ('../../modelo/validar_usuario.php');
require_once ('../../modelo/raiz_directorio_principal.php');
require_once ('../../modelo/modal_consulta.php');
require_once ('../../modelo/ComprobarPermiso.php');
require_once ('../../modelo/Recursos.php');
include '../../modelo/Paginacion.php';
require_once ('../../modelo/Fecha.php');
require_once('../../modelo/Table.php');
?>








<?php

if (validar_user()) {



    foreach ($_POST as $key => $datoformulario) {


        if ($key == "maquina") {
            $maquina = (int) $datoformulario;
        }

        if ($key == "operador") {
            $operador = (int) $datoformulario;
        }

        if ($key == "turno") {
            $turno = (int) $datoformulario;
        }
    }




    if (!isset($_POST['fecha_inicial'])) {
        $fecha_inicial = '';
    } else {
        $fecha_inicial = ($_POST['fecha_inicial']);
    }


    if (!isset($_POST['fecha_final'])) {
        $fecha_final = '';
    } else {
        $fecha_final = ($_POST['fecha_final']);
    }

    $obj_permiso = new Permiso();
    $bitacora = new Bitacora();
    $paginacion = new Paginacion();

    if (empty($fecha_inicial)) {
        $fecha_inicial = '1985-01-01';
    }

    if (empty($fecha_final)) {
        $fecha_final = date("Y-m-d");


        $nuevafecha = strtotime('+1 day', strtotime($fecha_final));
        $nuevafecha = date('Y-m-d', $nuevafecha);

        $fecha_final = $nuevafecha;
    }



    $bitacora->setIdEmpresa($_SESSION['k_empresa']);
    $obj_permiso->setIdEmpresa($_SESSION['k_empresa']);
    $permiso = $obj_permiso->optenerPermisosDeUsuarioEnModulo(ESTADISTICO);
    $obj_permiso->next_result();



    if (!$obj_permiso->verificaPermisoParaConsulta($permiso)) {
        mensajeModal();
    }

    $obj_permiso->setIdPerfilUsuario();

    $maquina = $bitacora->getParametroDeBusqueda($obj_permiso, $bitacora, $maquina);
    $operador = $bitacora->crearConsultalike($operador);
    $turno = $bitacora->crearConsultalike($turno);

    $_SESSION['fecha_inicial'] = $fecha_inicial;
    $_SESSION['fecha_final'] = $fecha_final;
    $_SESSION['maquina'] = $maquina;
    $_SESSION['operador'] = $operador;
    $_SESSION['turno'] = $turno;

    $consultaEstadisticaResumidaSoloMaquina = $bitacora->eficienciaPorProcesoSoloMaquina($maquina, $operador, $turno, $fecha_inicial, $fecha_final);
    $fieldResumidoMaquina = $bitacora->field_count - 1;
    $bitacora->next_result();




    $consultaEstadisticaProduccionEsperada = $bitacora->estadisticaResumida($maquina, $operador, $turno, $fecha_inicial, $fecha_final);
    $field = $bitacora->field_count - 1;


    $fechax = $field - 9;
    $turnox = 1;
    $maquinax = 3;
    $mostarEstadistica = $consultaEstadisticaProduccionEsperada->num_rows;




    $tabla3 = new Table();
    $tabla3->crearArraySimple($consultaEstadisticaProduccionEsperada, $field);





    $tabla2 = new Table();
    $tabla2->crearArraySimple($consultaEstadisticaResumidaSoloMaquina, $fieldResumidoMaquina);









    $bitacora->next_result();
    $nombreMaquina = $bitacora->determinarCuantasMaquinasConsultar($maquina);


    /**
     * INICIO CRECION TABLA TIEMPO IMPRODUCTIVO
     */
    $bitacora->setNombreMaquina($nombreMaquina);



    $consultaEncabezadoTimpoImproductivo = $bitacora->consultarEncabezadoDinamica();
    $fieldTEncabezadoDinamico = $bitacora->field_count - 1;
    $mostarListadoEncabezadoDinamico = $consultaEncabezadoTimpoImproductivo->num_rows;
    $bitacora->next_result();

    /*     * *
     * esta funcion devuelve el valor de los encabezados  que se muestran en la tabla
     *  CONSOLIDADO TIEMPO IMPRODUCTIVO
     */


    $tabla4 = new Table();
    $tabla4->crearArraySimple($consultaEncabezadoTimpoImproductivo, $fieldTEncabezadoDinamico);
    $arrayEncabezadoTablaConsolidadoTiempoImproductivo = $tabla4->getArray();



    /* se procede a consultar los ID de los encabezados que se motraran en la tabla 
     * CONSOLIDADO TIEMPO IMPRODUCTIVO
     */
    $consultaFilasTiempoImprductivo = $bitacora->consultarIdEncabezadoDinamico();
    $numeroDeColumnas = $bitacora->field_count - 1;
    $tabla4->crearArraySimple($consultaFilasTiempoImprductivo, $numeroDeColumnas);
    $arrayIdEncabezadoTablaConsolidatoTiempoImproductivo = $tabla4->getArray();
    $bitacora->next_result();





    $vectorId = $bitacora->crearColumnasDinamicaID($arrayIdEncabezadoTablaConsolidatoTiempoImproductivo);

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
    $consulta_dinamica = $bitacora->crearConsultaDinamica($vectorId);


    $tamanio = sizeof($arrayEncabezadoTablaConsolidadoTiempoImproductivo);
    /**
     * recibe los encabezados que se mostraran en la tabla TIEMPO CONSOLIDADO
     * pero ademas agrega el encabezado CAUSA al inicio y al finla TOTOAL, 
     * donse se suma el total de los tiempos improductivos y al inicio se describe
     * cual es la causa que genero ese tiempo
     */
    $vector = $bitacora->crearColumnasDinamica($arrayEncabezadoTablaConsolidadoTiempoImproductivo);
    $numeroEncabezados = sizeof($vector) - 1;



    $consultaTiempoImproductivo_contenido = $bitacora->consultarTiempoImproductivoDinamicaPrefijoMAquina($consulta_dinamica, $tamanio + 2, $maquina, $fecha_inicial, $fecha_final);
    $fieldTiempoImproducto_contenido = $bitacora->field_count - 1;
    $mostarListadoDeTiempoImproductivo_contenido = $consultaTiempoImproductivo_contenido->num_rows;


    $tabla = new Table();
    $tabla->crearArraySimple($consultaTiempoImproductivo_contenido, $fieldTiempoImproducto_contenido);





    /*     * *FIN CREACION TABLA DINAMICA* */



    if ($mostarEstadistica == 0) {

        mensajeDeErrorModal($titulo = 'LA CONSULTA NO ARROJO RESULTADOS'
                , $subtitulo = 'INTENTE CON OTROS PARAMETROS DE BUSQUEDA'
                , $mensaje = 'Para un mejor resultado , intente la busqueda sin parametros, si el error persiste contacte con el administrador');
        exit();
    }



    /**
     * una ves terminada la prueba debe ser eliminada la vista
     */
    require_once '../../vista/reportes/MostrarEstadisticaResumida.php';
} else {
    echo("<script>alert('Usted no esta logiado, ingrese para despues ejecutar la opcion de registro!!')</script>");
    raiz();
    exit();
}
?>






