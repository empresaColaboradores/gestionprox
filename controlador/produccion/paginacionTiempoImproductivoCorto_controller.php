
<?php

include '../../modelo/Bitacora.php';
include '../../modelo/Paginacion.php';
require_once ('../../modelo/validar_usuario.php');
require_once '../../modelo/raiz_directorio_principal.php';
require_once ('../../modelo/modal_consulta.php');
require_once('../../modelo/Table.php');
?>


<?php


if (validar_user()) {

    
    $bitacora = new Bitacora();
    $paginacion = new Paginacion();
    $bitacora->setIdEmpresa($_SESSION['k_empresa']);






   




    if (empty($fecha_inicial)) {
        $fecha_inicial = '1985-01-01';
    }

    if (empty($fecha_final)) {
        $fecha_final = date("Y-m-d");


        $nuevafecha = strtotime('+1 day', strtotime($fecha_final));
        $nuevafecha = date('Y-m-d', $nuevafecha);

        $fecha_final = $nuevafecha;
    }




    $fecha_inicial = $_SESSION['fecha_inicial'];
    $fecha_final = $_SESSION['fecha_final'];
    $maquina = $_SESSION['maquina'];
    $origen = $_SESSION['origen'];
    $causa = $_SESSION['causa'];
    $detalle = $_SESSION['detalle'];
    $operador = $_SESSION['operador'];
    $equipo = $_SESSION['equipo'];
    $ficha = $_SESSION['ficha'];
    $op = $_SESSION['op'];
    






   


    if (!($fecha_final > $fecha_inicial)) {

        echo("<script>alert('La fecha final debe ser mayor que la inicial!!')</script>");
        raiz();
        exit();
    }




    $paginacion->setNumeroRegistros($bitacora->contarRegistroTimpoImproConPrefijoMaquina($ficha, $op, $maquina, $operador, $origen, $causa, $detalle, $fecha_inicial, $fecha_final));

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

    $paginacion->setLinkPaginacion('paginacionTiempoImproductivoCorto');
    $paginationCtrls = $paginacion->getLink();

    $inicioLimite = $paginacion->getLimiteInicio();
    $numeroPagina = $paginacion->getNumeroRegistroPorPagina();
    
    



   
    $consulta = $bitacora->consultarHistorialTiempoImproductivoProducCortoSegunPrefijoMAquina($maquina, $operador, $origen, $causa, $detalle, $fecha_inicial, $fecha_final, $inicioLimite, $numeroPagina, $ficha, $op);
    $field = $bitacora->field_count-1;
    $mostrarConsulta = $consulta->num_rows;
    
    $fecha = $field - 7;
    $turno = 1;
    $maquina = 3;
    $id_registro = 7;
    $mostarEstadistica = $mostrarConsulta;
    
     $tabla = new Table();
    $tabla->crearArrayConLink($consulta, $field, $id_registro, $turno, $maquina, 'editarRegistroTiempoImproductivo');

  

    if ($mostrarConsulta == 0) {

        mensajeDeErrorModal($titulo = 'LA CONSULTA NO ARROJO RESULTADOS'
                , $subtitulo = 'Seleccione un valor valido para la consulta'
                , $mensaje = 'Para un mejor resultado , intente con otros valores de busqueda');
        exit();
    }





    require_once '../../vista/produccion/MostrarRegistroTiempoImprductivoResumido.php';
} else {
    echo("<script>alert('Usted no esta logiado, ingrese para despues ejecutar la opcion de registro!!')</script>");
    raiz();
}
?>






