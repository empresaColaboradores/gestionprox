<?php

require_once('../../modelo/captcha.php');
require_once ('../../modelo/Bitacora.php');
require_once ('../../modelo/validar_usuario.php');
require_once ('../../modelo/raiz_directorio_principal.php');
require_once ('../../modelo/modal_consulta.php');
require_once ('../../modelo/ComprobarPermiso.php');
require_once ('../../modelo/Recursos.php');
require_once ('../../modelo/Paginacion.php');
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

    $paginacion->setNumeroRegistroNumRows($bitacora->contarRegistroEnTablaProduccionPrefijoMAquina($maquina, $operador, $turno, $fecha_inicial, $fecha_final));
    $bitacora->next_result();

    $maximoAlertas = $paginacion->getNumero_registro();






    $paginacion->setNumero_RegistrosPorVista(6);
    $page_rows = $paginacion->getNumeroRegistroPorPagina();


    $last = $paginacion->getNumeroUltimoNumeroPagina();


    $paginacion->peticionGetHTTP();


    $page_num = $paginacion->getNumeroPaginaActual();

    $paginacion->setLimiteInicio();




    $limit = $paginacion->getLimite();





    $textLine1 = "Total Alertas(<b> $maximoAlertas</b>)";
    $textLine2 = "&nbsp;&nbsp;Pagina <b> $page_num </b> de <b> $last</b>";



    $paginationCtrls = '';

    $paginacion->setLinkPaginacion('paginacionPesajeProduccion');
    $paginationCtrls = $paginacion->getLink();

    $inicioLimite = $paginacion->getLimiteInicio();
    $numeroPagina = $paginacion->getNumeroRegistroPorPagina();











    $consultaEstadisticaProduccionEsperada = $bitacora->estadisticaProduccionEsperadaPaginadaPruebaPrefijoConVelocidad($maquina, $operador, $turno, $fecha_inicial, $fecha_final, $inicioLimite, $numeroPagina);
    $field = $bitacora->field_count - 1;



    $fecha = $field - 13;
    $turno = 1;
    $maquina = 3;
    $mostarEstadistica = $consultaEstadisticaProduccionEsperada->num_rows;





    if ($mostarEstadistica == 0) {

        mensajeDeErrorModal($titulo = 'LA CONSULTA NO ARROJO RESULTADOS'
                , $subtitulo = 'INTENTE CON OTROS PARAMETROS DE BUSQUEDA'
                , $mensaje = 'Para un mejor resultado , intente la busqueda sin parametros, si el error persiste contacte con el administrador');
        exit();
    }

    $tabla = new Table();
    $tabla->crearArray($consultaEstadisticaProduccionEsperada, $field, $fecha, $turno, $maquina);



    /**
     * una ves terminada la prueba debe ser eliminada la vista
     */
    require_once '../../vista/reportes/MostrarEstadisticaProductiva_prueba.php';
} else {
    echo("<script>alert('Usted no esta logiado, ingrese para despues ejecutar la opcion de registro!!')</script>");
    raiz();
    exit();
}
?>






