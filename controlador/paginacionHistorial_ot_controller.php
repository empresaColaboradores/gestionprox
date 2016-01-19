
<?php

include '../modelo/Bitacora.php';
include '../modelo/Paginacion.php';
require_once ('../modelo/validar_usuario.php');
require_once '../modelo/raiz_directorio_principal.php';
require_once ('../modelo/modal_consulta.php');
require_once('../modelo/Table.php');
require_once ('../modelo/Fecha.php');
?>


<?php

if (validar_user()) {


    $id_empresa = $_SESSION['k_empresa'];


    $fecha_inicial = $_SESSION['fecha_inicial'];
    $fecha_final = $_SESSION['fecha_final'];
    $maquina = $_SESSION['maquina'];
    $estado = $_SESSION['estado'];

    $bitacora = new Bitacora();
    $paginacion = new Paginacion();
    $bitacora->setIdEmpresa($_SESSION['k_empresa']);
    $fecha = new Fecha($fecha_inicial, $fecha_final);





    $paginacion->setNumeroRegistros($bitacora->contarHistorialOT($maquina, $estado, $fecha_inicial, $fecha_final));
    $bitacora->next_result();

    $maximoAlertas = $paginacion->getNumero_registro();


    $paginacion->setNumero_RegistrosPorVista(5);
    $page_rows = $paginacion->getNumeroRegistroPorPagina();




    $last = $paginacion->getNumeroUltimoNumeroPagina();




    $paginacion->peticionGetHTTP();


    $page_num = $paginacion->getNumeroPaginaActual();

    $paginacion->setLimiteInicio();






    $textLine1 = "Total Alertas(<b> $maximoAlertas</b>)";
    $textLine2 = "&nbsp;&nbsp;Pagina <b> $page_num </b> de <b> $last</b>";


    $paginationCtrls = '';

    $paginacion->setLinkPaginacion('find_ot_historial_paginacion');
    $paginationCtrls = $paginacion->getLink();

    $inicioLimite = $paginacion->getLimiteInicio();
    $numeroPagina = $paginacion->getNumeroRegistroPorPagina();

 



    $consulta = $bitacora->consultarHistorialOrdenDeTrabajo($maquina, $estado, $fecha_inicial, $fecha_final, $inicioLimite, $numeroPagina);
    $field = $bitacora->field_count-1;
    $mostrarConsulta = $consulta->num_rows;


    if ($mostrarConsulta == 0) {

        mensajeDeErrorModal($titulo = 'LA CONSULTA NO ARROJO RESULTADOS'
                , $subtitulo = 'Seleccione un valor valido para la consulta'
                , $mensaje = 'Para un mejor resultado , intente con otros valores de busqueda');
        exit();
        
    }


    $tabla = new Table();
    $tabla->crearArraySimple($consulta, $field);




    require_once '../vista/mostrarHistorialOrdenTrabajo.php';
} else {
    echo("<script>alert('Usted no esta logiado, ingrese para despues ejecutar la opcion de registro!!')</script>");
    raiz();
}
?>






