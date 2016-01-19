<?php

require_once('../../modelo/captcha.php');
require_once '../../modelo/Bitacora.php';
require_once ('../../modelo/validar_usuario.php');
require_once ('../../modelo/raiz_directorio_principal.php');
require_once ('../../modelo/modal_consulta.php');
require_once ('../../modelo/ComprobarPermiso.php');
require_once ('../../modelo/Recursos.php');
include '../../modelo/Paginacion.php';
 require_once('../../modelo/Table.php');
?>








<?php

if (validar_user()) {

    $obj_permiso = new Permiso();
    $obj_permiso->setIdEmpresa($_SESSION['k_empresa']);
    $permiso = $obj_permiso->optenerPermisosDeUsuarioEnModulo(ESTADISTICO);



    if (!$obj_permiso->verificaPermisoParaConsulta($permiso)) {
        mensajeModal();
    }






    $fecha_inicial = $_SESSION['fecha_inicial'];
    $fecha_final = $_SESSION['fecha_final'];
    $maquina = $_SESSION['maquina'];
    $operador = $_SESSION['operador'];
    $turno = $_SESSION['turno'];


    






    $bitacora = new Bitacora();
    $paginacion = new Paginacion();
    $bitacora->setIdEmpresa($_SESSION['k_empresa']);
    


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
    
    $tabla = new Table();
    $tabla->crearArray($consultaEstadisticaProduccionEsperada, $field,$fecha,$turno,$maquina);
     





    if ($mostarEstadistica == 0) {

        mensajeDeErrorModal($titulo = 'LA CONSULTA NO ARROJO RESULTADOS'
                , $subtitulo = 'INTENTE CON OTROS PARAMETROS DE BUSQUEDA'
                , $mensaje = 'Para un mejor resultado , intente la busqueda sin parametros, si el error persiste contacte con el administrador');
        exit();
    }




    
    require_once '../../vista/reportes/MostrarEstadisticaProductiva_prueba.php';
} else {
    echo("<script>alert('Usted no esta logiado, ingrese para despues ejecutar la opcion de registro!!')</script>");
    raiz();
    exit();
}
?>






