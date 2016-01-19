
<?php


include '../modelo/Bitacora.php';
include '../modelo/Paginacion.php';
require_once ('../modelo/validar_usuario.php');
require_once '../modelo/raiz_directorio_principal.php';
require_once('../modelo/Table.php');



if (validar_user()) {

  



    foreach ($_POST as $key => $numero) {


        if ($key == "maquina") {
            $maquina = (int)$numero;
        }

        if ($key == "operador") {
            $operador = (int)$numero;
        }

        if ($key == "kwh") {
            $kwh = (double)$numero;
        }



        if ($key == "detalle") {
            $detalle = strtoupper($numero);
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




    
    $bitacora = new Bitacora();
    $paginacion = new Paginacion();

    
    if ($maquina == '0') {
        $maquina = '';
    }

    if ($operador == 0) {
        $operador = '';
    }



    if (empty($fecha_inicial)) {
        $fecha_inicial = '1985-01-01';
    }

    if (empty($fecha_final)) {
        $fecha_final = date("Y-m-d");

        
        $nuevafecha = strtotime('+1 day', strtotime($fecha_final));
        $nuevafecha = date('Y-m-d', $nuevafecha);
        
       
        

       
    }



    $fecha_inicial = $_SESSION['fecha_inicial'];
    $fecha_final = $_SESSION['fecha_final'];
    $detalle = $_SESSION['detalle'];
    $maquina = $_SESSION['maquina'];
    $operador = $_SESSION['operador'];


    $bitacora->setIdEmpresa($_SESSION['k_empresa']);


    if (!($nuevafecha > $fecha_inicial)) {

        echo("<script>alert('La fecha final debe ser mayor que la inicial!!')</script>");
        raiz();
        exit();
    }




        $paginacion->setNumeroRegistros($bitacora->contarRegistroBitacora_1($operador,$maquina,$fecha_inicial,$fecha_final));
        $bitacora->next_result();

        $maximoAlertas = $paginacion->getNumero_registro();
        

        
        






    $paginacion->setNumero_RegistrosPorVista(5);
    $page_rows = $paginacion->getNumeroRegistroPorPagina();
   

    $last = $paginacion->getNumeroUltimoNumeroPagina();


    $paginacion->peticionGetHTTP();


    $page_num = $paginacion->getNumeroPaginaActual();
    $paginacion->setLimite();
    $paginacion->setLimiteInicio();



   


    $textLine1 = "Total Alertas(<b> $maximoAlertas</b>)";
    $textLine2 = "&nbsp;&nbsp;Pagina <b> $page_num </b> de <b> $last</b>";


   
    $paginationCtrls = '';

    $paginacion->setLinkPaginacion('bitacoraPaginacion_1');
    $paginationCtrls = $paginacion->getLink();



    $inicioLimite = $paginacion->getLimiteInicio();
    $numeroPagina = $paginacion->getNumeroRegistroPorPagina();
    
    $consulta = $bitacora->consultarHistorialBitacora_registro($maquina, $operador, $detalle, $fecha_inicial, $nuevafecha, $inicioLimite,$numeroPagina);
    $field = $bitacora->field_count-1;
    $bitacora->next_result();
    
    $tabla = new Table();
         $tabla->crearArraySimple($consulta, $field);


    require_once '../vista/bitacoraRegistro_vista_1.php';
} else {
    echo("<script>alert('Usted no esta logiado, ingrese para despues ejecutar la opcion de registro!!')</script>");
    raiz();
}
?>






