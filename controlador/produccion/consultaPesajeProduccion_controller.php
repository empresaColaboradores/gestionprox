

<?php

require_once('../../modelo/captcha.php');
require_once '../../modelo/Bitacora.php';
require_once ('../../modelo/validar_usuario.php');
require_once ('../../modelo/raiz_directorio_principal.php');
require_once ('../../modelo/modal_consulta.php');

require_once ('../../modelo/ComprobarPermiso.php');
require_once ('../../modelo/Recursos.php');
require_once ('../../modelo/Produccion.php');
require_once ('../../modelo/Fecha.php');
include '../../modelo/Paginacion.php';
require_once('../../modelo/Table.php');







if (validar_user()) {

    $obj_permiso = new Permiso();
    
    $obj_permiso->setIdEmpresa($_SESSION['k_empresa']);
    $permiso = $obj_permiso->optenerPermisosDeUsuarioEnModulo(PESAJE_PRODUCCION);



    if (!$obj_permiso->verificaPermisoParaConsulta($permiso)) {
        mensajeModal();
    }




    foreach ($_POST as $key => $numero) {


        if ($key == "maquina") {
            $maquina = (int) $numero;
        }

        if ($key == "operador") {
            $operador = (int) $numero;
        }

        if ($key == "op") {
            $op = (int) ($numero);
        }


        if ($key == "consecutivo") {
            $consecutivo = (int) ($numero);
        }



        if ($key == "material") {
            $tipoMaterial = (double) ($numero);
        }

        if ($key == "turno") {
            $turno = (int) ($numero);
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


    $id_empresa = $_SESSION['k_empresa'];






    $bitacora = new Bitacora();
    $produccion = new Produccion();
    $cap = new Captchap();
    
    
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


    $cap->verifyFormToken('pesajeProduccion');
    $bitacora->setIdEmpresa($id_empresa);
    $produccion->setIdEmpresa($id_empresa);



    $op = $produccion->crearConsultalike($op);
    $maquina = $bitacora->determinarCuantasMaquinasConsultar($maquina);
    $operador = $produccion->crearConsultalike($operador);
    $consecutivo = $produccion->crearConsultalike($consecutivo);
    $tipoMaterial = $produccion->crearConsultalike($tipoMaterial);
    $turno = $produccion->crearConsultalike($turno);



    $_SESSION['fecha_inicial'] = $fecha_inicial;
    $_SESSION['fecha_final'] = $fecha_final;
    $_SESSION['op'] = $op;
    $_SESSION['maquina'] = $maquina;
    $_SESSION['operador'] = $operador;
    $_SESSION['consecutivo'] = $consecutivo;
    $_SESSION['tipoMaterial'] = $tipoMaterial;
    $_SESSION['turno'] = $turno;
    
    
    $paginacion->setNumeroRegistroNumRows($produccion->consultaOrdenProduccionPrefijoMaquinaConVelocidad($op, $maquina, $turno, $operador, $consecutivo, $tipoMaterial, $fecha_inicial, $fecha_final));
    $produccion->next_result();
    
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

    $paginacion->setLinkPaginacion('paginacionConsultaPesajeProduccion');
    $paginationCtrls = $paginacion->getLink();

    $inicioLimite = $paginacion->getLimiteInicio();
    $numeroPagina = $paginacion->getNumeroRegistroPorPagina();




    $consultaProduccion = $produccion->consultaOrdenProduccionPrefijoMaquinaConVelocidadPaginada($op, $maquina, $turno, $operador, $consecutivo, $tipoMaterial, $fecha_inicial, $fecha_final,$inicioLimite, $numeroPagina);
                                                  
    $fieldProduccion = $produccion->field_count - 1;

    $mostarListadoDeProduccion = $consultaProduccion->num_rows;


     $OrdenProduccion=6;
     $consecutivoPesaje=8;
     $idMaterial=7;
     $idMaquina = 1;
     $idTurno = 2;
     $idOperador=3;     
    
    
    
    $tabla = new Table();
    $tabla->crearArrayConLinkproduccion(
            $consultaProduccion,
            $fieldProduccion,
            $OrdenProduccion,
            $consecutivoPesaje,
            $idMaterial,
            $idMaquina,
            $idTurno ,
            'editarPesajeProduccion');

    

    if ($mostarListadoDeProduccion == 0) {

        mensajeDeErrorModal($titulo = 'LA CONSULTA NO ARROJO RESULTADOS'
                , $subtitulo = 'Seleccione un valor valido para la consulta'
                , $mensaje = 'Para un mejor resultado , intente con otros valores de busqueda');
        exit();
    }




    require_once '../../vista/produccion/MostrarRegistroProduccion.php';
} else {
    echo("<script>alert('Usted no esta logiado, ingrese para despues ejecutar la opcion de registro!!')</script>");
    raiz();
    exit();
}
?>






