
<?php

include '../modelo/Bitacora.php';
include '../modelo/Paginacion.php';
require_once ('../modelo/validar_usuario.php');
require_once '../modelo/raiz_directorio_principal.php';
require_once ('../modelo/modal_consulta.php');
require_once('../modelo/Table.php');
require_once ('../modelo/Fecha.php');
require_once ('../modelo/ComprobarPermiso.php');
?>


<?php

if (validar_user()) {



    $fecha_inicial = $_SESSION['fecha_inicial'];
    $fecha_final = $_SESSION['fecha_final'];
    $maquina = $_SESSION['maquina'];
    $estado = $_SESSION['estado'];
    $id_empresa = $_SESSION['k_empresa'];








    
    $bitacora = new Bitacora();
    $paginacion = new Paginacion();
    $fecha = new Fecha($fecha_inicial, $fecha_final);

    $bitacora->setIdEmpresa($_SESSION['k_empresa']);

    $obj_permiso = new Permiso();
    $obj_permiso->setIdEmpresa($_SESSION['k_empresa']);
    $ordenDeTrabajo = 2;
    $permiso = $obj_permiso->optenerPermisosDeUsuarioEnModulo($ordenDeTrabajo);
    $obj_permiso->next_result();

    if (!$obj_permiso->verificaPermisoParaConsulta($permiso)) {
        mensajeModal();
    }


    $obj_permiso->setIdPerfilUsuario();

 



    $fecha_inicial = $fecha->getFechaInicial();
    $fecha_final = $fecha->getFechaFinal();

    $id_empresa = $_SESSION['k_empresa'];



    if ($obj_permiso->isMatto()) {
        $consulta = $bitacora->contarRegistroOtIdMaquina($maquina, $estado, $fecha_inicial, $fecha_final);
    } else {
        $consulta = $bitacora->contarRegistroOT($maquina, $estado, $fecha_inicial, $fecha_final);
    }


    $paginacion->setNumeroRegistros($consulta);

    $bitacora->next_result();

    $maximoAlertas = $paginacion->getNumero_registro();


    $paginacion->setNumero_RegistrosPorVista(5);
    $page_rows = $paginacion->getNumeroRegistroPorPagina();
    $last = $paginacion->getNumeroUltimoNumeroPagina();


    $paginacion->peticionGetHTTP();


    $page_num = $paginacion->getNumeroPaginaActual();
    $paginacion->setLimiteInicio();




    $limit = $paginacion->getLimite();



    $textLine1 = "Total Alertas(<b> $maximoAlertas</b>)";
    $textLine2 = "&nbsp;&nbsp;Pagina <b> $page_num </b> de <b> $last</b>";



    $paginationCtrls = '';

    $paginacion->setLinkPaginacion('find_ot_paginacion');
    $paginationCtrls = $paginacion->getLink();


    $inicioLimite = $paginacion->getLimiteInicio();
    $numeroPagina = $paginacion->getNumeroRegistroPorPagina();




    if ($obj_permiso->isMatto()) {
        $consulta = $bitacora->consultarOTidMaquina($maquina, $estado, $fecha_inicial, $fecha_final, $inicioLimite, $numeroPagina);
    } else {
        $consulta = $bitacora->consultarOT($maquina, $estado, $fecha_inicial, $fecha_final, $inicioLimite, $numeroPagina);
    }
    $field = $bitacora->field_count - 1;
    $mostrarConsulta = $consulta->num_rows;

    $tabla = new Table();
    $id_ordenDeTrabajo = 8;
    $valoresDefecto = 0;

    $tabla->crearArrayConLink($consulta, $field, $id_ordenDeTrabajo, $valoresDefecto, $valoresDefecto, 'set_ot');

    if ($mostrarConsulta == 0) {

        mensajeDeErrorModal($titulo = 'LA CONSULTA NO ARROJO RESULTADOS'
                , $subtitulo = 'Seleccione un valor valido para la consulta'
                , $mensaje = 'Para un mejor resultado , intente con otros valores de busqueda');
        exit();
    }








    require_once '../vista/MostrarOT.php';
} else {
    echo("<script>alert('Usted no esta logiado, ingrese para despues ejecutar la opcion de registro!!')</script>");
    raiz();
}
?>






