
<?php

include '../modelo/Bitacora.php';
include '../modelo/Paginacion.php';
require_once ('../modelo/validar_usuario.php');
require_once '../modelo/raiz_directorio_principal.php';
require_once ('../modelo/modal_consulta.php');
require_once('../modelo/Table.php');
require_once ('../modelo/Fecha.php');


if (validar_user()) {





    $fecha_inicial = $_SESSION['fecha_inicial'];
    $fecha_final = $_SESSION['fecha_final'];
    $maquina = $_SESSION['maquina'];
    $estado = $_SESSION['estado'];
    $id_empresa = $_SESSION['k_empresa'];




    if (!isset($_GET['excel'])) {
        $exportar = '';
    } else {
        $exportar = ($_GET['excel']);
    }


    
     $bitacora = new Bitacora();
    $paginacion = new Paginacion();
    $fecha = new Fecha($fecha_inicial, $fecha_final);


    $bitacora->setIdEmpresa($_SESSION['k_empresa']);
    $fecha_inicial = $fecha->getFechaInicial();
    $fecha_final = $fecha->getFechaFinal();




    if (!($fecha_final > $fecha_inicial)) {

        echo("<script>alert('La fecha final debe ser mayor que la inicial!!')</script>");
        raiz();
        exit();
    }

    $paginacion->setNumeroRegistros($bitacora->contarHistorialOT($maquina, $estado, $fecha_inicial, $fecha_final));
    $bitacora->next_result();

     $paginacion->setLimiteInicio();
    $limit = $paginacion->getLimite();
    
    $inicioLimite = 0;
    $numeroPagina = $paginacion->getNumero_registro();



    $consulta = $bitacora->consultarHistorialOrdenDeTrabajo($maquina, $estado, $fecha_inicial, $fecha_final, $inicioLimite, $numeroPagina);
    $field = $bitacora->field_count - 1;
    $mostrarConsulta = $consulta->num_rows;

    $tabla = new Table();


    $tabla->crearArraySimple($consulta, $field);


    


    if ($mostrarConsulta == 0) {

        mensajeDeErrorModal($titulo = 'NO HAY DATOS PARA EXPORTAR'
                , $subtitulo = 'Seleccione un valor valido para la consulta'
                , $mensaje = 'Para un mejor resultado , intente con otros valores de busqueda');
        exit();
    }










    if ($exportar == 'excell') {

        require_once '../vista/exportarHistorialOrdenTrabajoExcell.php';
    } else if ($exportar == '') {
        
    } else {
        echo("<script>alert('Accion invalida no se puede exportar el archivo!!')</script>");
        echo('<script>location.href="../index.php"</script>');
    }
} else {
    echo("<script>alert('Usted no esta logiado, ingrese para despues ejecutar la opcion de registro!!')</script>");
    echo('<script>location.href="../index.php"</script>');
    exit();
}
?>






