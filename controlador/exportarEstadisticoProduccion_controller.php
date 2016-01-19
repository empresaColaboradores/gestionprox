<?php

require_once('../modelo/captcha.php');
require_once '../modelo/Bitacora.php';
require_once ('../modelo/validar_usuario.php');
require_once ('../modelo/raiz_directorio_principal.php');
require_once ('../modelo/modal_consulta.php');
require_once ('../modelo/ComprobarPermiso.php');
require_once ('../modelo/Recursos.php');
include '../modelo/Paginacion.php';
require_once ('../modelo/Fecha.php');
 require_once('../modelo/Table.php');
?>








<?php

if (validar_user()) {









    $obj_permiso = new Permiso();
    $bitacora = new Bitacora();
    $paginacion = new Paginacion();



    $bitacora->setIdEmpresa($_SESSION['k_empresa']);
    $obj_permiso->setIdEmpresa($_SESSION['k_empresa']);
    $permiso = $obj_permiso->optenerPermisosDeUsuarioEnModulo(ESTADISTICO);
    $obj_permiso->next_result();



    if (!$obj_permiso->verificaPermisoParaConsulta($permiso)) {
        mensajeModal();
    }


    if (!isset($_GET['excel'])) {
        $exportar = '';
    } else {
        $exportar = ($_GET['excel']);
    }



    $fecha_inicial = $_SESSION['fecha_inicial'];
    $fecha_final = $_SESSION['fecha_final'];
    $maquina = $_SESSION['maquina'];
    $operador = $_SESSION['operador'];
    $turno = $_SESSION['turno'];
    
    

    $paginacion->setNumeroRegistroNumRows($bitacora->contarRegistroEnTablaProduccionPrefijoMAquina($maquina, $operador, $turno, $fecha_inicial, $fecha_final));
    $bitacora->next_result();

   
    
    

    
   



    $paginacion->setLimiteInicio();
    $limit = $paginacion->getLimite();








    

    $paginacion->setLinkPaginacion('paginacionPesajeProduccion');
    $paginationCtrls = $paginacion->getLink();

    $inicioLimite =0;
    $numeroPagina = $paginacion->getNumero_registro();
    

    $consultaEstadisticaProduccionEsperada = $bitacora->estadisticaProduccionEsperadaPaginadaPruebaPrefijoConVelocidad($maquina, $operador, $turno, $fecha_inicial, $fecha_final, $inicioLimite, $numeroPagina);
    $field = $bitacora->field_count - 1;
   
    
    $fecha = $field - 13;
    $turno = 1;
    $maquina = 3;
    $mostarEstadistica = $consultaEstadisticaProduccionEsperada->num_rows;
    
    $tabla = new Table();
    $tabla->crearArray($consultaEstadisticaProduccionEsperada, $field,$fecha,$turno,$maquina);
     



    if ($exportar == 'excell') {

        require_once '../vista/exportarEstadisticoProduccionEsperadaExcell.php';
    } else {
        mensajeDeErrorModal($titulo = 'LA CONSULTA NO ARROJO RESULTADOS'
                , $subtitulo = 'Seleccione un valor valido para la consulta'
                , $mensaje = 'Para un mejor resultado , intente con otros valores de busqueda');
        exit();
    }
} else {
    echo("<script>alert('Usted no esta logiado, ingrese para despues ejecutar la opcion de registro!!')</script>");
    raiz();
    exit();
}
?>






