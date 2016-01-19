
<?php

include '../modelo/Bitacora.php';
include '../modelo/Paginacion.php';
require_once ('../modelo/validar_usuario.php');
require_once '../modelo/raiz_directorio_principal.php';
require_once ('../modelo/modal_consulta.php');
?>


<?php


if (validar_user()) {

    
    $id_empresa = $_SESSION['k_empresa'];



    $bitacora = new Bitacora();
    $paginacion = new Paginacion();

    $bitacora->setIdEmpresa($_SESSION['k_empresa']);

    $fecha_inicial = $_SESSION['fecha_inicial'];
    $fecha_final = $_SESSION['fecha_final'];
    $maquina = $_SESSION['maquina'];
    $estado = $_SESSION['estado'];

    
   








    if (empty($fecha_inicial)) {
        $fecha_inicial = '1985-01-01';
    }

    if (empty($fecha_final)) {
        $fecha_final = date("Y-m-d");


        $nuevafecha = strtotime('+1 day', strtotime($fecha_final));
        $nuevafecha = date('Y-m-d', $nuevafecha);

        $fecha_final = $nuevafecha;
    }








    $id_empresa = $_SESSION['k_empresa'];


    if (!($fecha_final > $fecha_inicial)) {

        echo("<script>alert('La fecha final debe ser mayor que la inicial!!')</script>");
        raiz();
        exit();
    }

    $paginacion->setNumeroRegistros($bitacora->contarRegistroOT($maquina, $estado, $fecha_inicial, $fecha_final));
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

    $paginacion->setLinkPaginacion('find_ot_paginacion');
    $paginationCtrls = $paginacion->getLink();

    $inicioLimite = $paginacion->getLimiteInicio();
    $numeroPagina = $paginacion->getNumeroRegistroPorPagina();
    
    



    $consulta = $bitacora->consultarOT($maquina, $estado, $fecha_inicial, $fecha_final, $inicioLimite, $numeroPagina);
    $field = $bitacora->field_count;
    $mostrarConsulta = $consulta->num_rows;
    

    if ($mostrarConsulta == 0) {

        mensajeDeErrorModal();
        exit();
    }









    require_once '../vista/MostrarOT.php';
} else {
    echo("<script>alert('Usted no esta logiado, ingrese para despues ejecutar la opcion de registro!!')</script>");
    raiz();
}
?>






