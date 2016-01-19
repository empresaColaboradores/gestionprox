<?php

include '../../modelo/Bitacora.php';
include '../../modelo/Paginacion.php';
require_once ('../../modelo/validar_usuario.php');
require_once '../../modelo/raiz_directorio_principal.php';
require_once ('../../modelo/modal_consulta.php');

require_once ('../../modelo/ComprobarPermiso.php');
require_once ('../../modelo/Recursos.php');
require_once ('../../modelo/Fecha.php');
require_once('../../modelo/Table.php');
?>


<?php

if (validar_user()) {










    foreach ($_POST as $key => $numero) {







        if ($key == "maquina") {
            $maquina = (int) $numero;
        }

        if ($key == "seccion") {
            $seccion = ($numero);
        }

        if ($key == "operador") {
            $operador = (int) $numero;
        }

        if ($key == "equipo") {
            $equipo = strtoupper($numero);
        }



        if ($key == "origen") {
            $origen = (int) $numero;
        }

        if ($key == "causa") {
            $causa = (int) $numero;
        }

        if ($key == "ficha") {
            $ficha = $numero;
        }

        if ($key == "op") {
            $op = (int) $numero;
        }



        if ($key == "detalle") {
            $detalle = strtoupper($numero);
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

    if (!isset($_POST['ficha'])) {
        $ficha = '';
    } else {
        $ficha = ($_POST['ficha']);
    }

    if (!isset($_POST['op'])) {
        $op = '';
    } else {
        $op = ($_POST['op']);
    }







    $bitacora = new Bitacora();
    $paginacion = new Paginacion();
    $obj_permiso = new Permiso();

    
      if (empty($fecha_inicial)) {
        $fecha_inicial = '1985-01-01';
    }

    if (empty($fecha_final)) {
        $fecha_final = date("Y-m-d");


        $nuevafecha = strtotime('+1 day', strtotime($fecha_final));
        $nuevafecha = date('Y-m-d', $nuevafecha);

        $fecha_final = $nuevafecha;
    }

    


    $obj_permiso->setIdEmpresa($_SESSION['k_empresa']);
    $permiso = $obj_permiso->optenerPermisosDeUsuarioEnModulo(TIEMPO_IMPRODUCTIVO);
    $obj_permiso->next_result();

    if (!$obj_permiso->verificaPermisoParaConsulta($permiso)) {
        mensajeModal();
    }


    $obj_permiso->setIdPerfilUsuario();
    $bitacora->setIdEmpresa($_SESSION['k_empresa']);



    

    $maquina = $bitacora->getParametroDeBusqueda($obj_permiso, $bitacora, $maquina) ; 
    $seccion = $bitacora->crearConsultalike($seccion);
    $equipo = $bitacora->crearConsultalike($equipo);
    $operador = $bitacora->crearConsultalike($operador);
    $origen = $bitacora->crearConsultalike($origen);
    $causa = $bitacora->crearConsultalike($causa);
    $ficha = $bitacora->crearConsultalike($ficha);
    $op = $bitacora->crearConsultalike($op);
    $detalle = $bitacora->crearConsultalike($detalle);










    $_SESSION['fecha_inicial'] = $fecha_inicial;
    $_SESSION['fecha_final'] = $fecha_final;
    $_SESSION['maquina'] = $maquina;
    $_SESSION['origen'] = $origen;
    $_SESSION['causa'] = $causa;
    $_SESSION['detalle'] = $detalle;
    $_SESSION['operador'] = $operador;
    $_SESSION['equipo'] = $equipo;
    $_SESSION['ficha'] = $ficha;
    $_SESSION['op'] = $op;





    $id_empresa = $_SESSION['k_empresa'];


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
    $id_registro=7;
    $mostarEstadistica = $mostrarConsulta;

    $tabla = new Table();
    $tabla->crearArrayConLink($consulta, $field,$id_registro,$turno,$maquina,'editarRegistroTiempoImproductivo');




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






