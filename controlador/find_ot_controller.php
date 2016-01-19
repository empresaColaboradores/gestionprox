
<?php

require_once '../modelo/Bitacora.php';
require_once '../modelo/Paginacion.php';
require_once ('../modelo/validar_usuario.php');
require_once '../modelo/raiz_directorio_principal.php';
require_once ('../modelo/modal_consulta.php');
require_once('../modelo/Table.php');
require_once ('../modelo/Fecha.php');
require_once ('../modelo/ComprobarPermiso.php');
?>


<?php

if (validar_user()) {

    foreach ($_POST as $key => $numero) {

        if ($key == "maquina") {
            $maquina = (int) $numero;
        }

        if ($key == "estado") {
            $estado = (int) ($numero);
        }
    }

    $id_empresa = $_SESSION['k_empresa'];





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
    $fecha = new Fecha($fecha_inicial, $fecha_final);

    /* si es el usuario matto, no hace la comprobacion y simplemente toma el parametro 
     */

    $obj_permiso = new Permiso();
    $obj_permiso->setIdEmpresa($_SESSION['k_empresa']);
    $ordenDeTrabajo = 2;
    $permiso = $obj_permiso->optenerPermisosDeUsuarioEnModulo($ordenDeTrabajo);
    $obj_permiso->next_result();

    if (!$obj_permiso->verificaPermisoParaConsulta($permiso)) {
        mensajeModal();
    }


    $obj_permiso->setIdPerfilUsuario();

    $bitacora->setIdEmpresa($_SESSION['k_empresa']);




    $maquina = $bitacora->getParametroDeBusqueda($obj_permiso, $bitacora, $maquina);

   



    $estado = $bitacora->crearConsultalike($estado);

    $fecha_inicial = $fecha->getFechaInicial();
    $fecha_final = $fecha->getFechaFinal();


    $_SESSION['fecha_inicial'] = $fecha_inicial;
    $_SESSION['fecha_final'] = $fecha_final;
    $_SESSION['maquina'] = $maquina;
    $_SESSION['estado'] = $estado;






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
    $last = $paginacion->getNumeroUltimoNumeroPagina();
    $paginacion->peticionGetHTTP();
    $page_num = $paginacion->getNumeroPaginaActual();



    $textLine1 = "Total Alertas(<b> $maximoAlertas</b>)";
    $textLine2 = "&nbsp;&nbsp;Pagina <b> $page_num </b> de <b> $last</b>";





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

        mensajeDeErrorModal($titulo = 'NO EXISTEN ORDENES DE TRABAJO REGISTRADAS'
                , $subtitulo = 'Espere a que se registren para realizar una consulta'
                , $mensaje = 'Si considera que esto es un error, por favor comunicarce con el adminsitrador');
        exit();
    }


    require_once '../vista/MostrarOT.php';
} else {
    echo("<script>alert('Usted no esta logiado, ingrese para despues ejecutar la opcion de registro!!')</script>");
    raiz();
}
?>






