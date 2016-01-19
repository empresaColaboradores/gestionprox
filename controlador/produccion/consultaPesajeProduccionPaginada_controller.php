

<?php

require_once('../../modelo/captcha.php');
require_once '../../modelo/Bitacora.php';
require_once ('../../modelo/validar_usuario.php');
require_once ('../../modelo/raiz_directorio_principal.php');
require_once ('../../modelo/modal_consulta.php');

require_once ('../../modelo/ComprobarPermiso.php');
require_once ('../../modelo/Recursos.php');
require_once ('../../modelo/Produccion.php');
require_once ('../../modelo/Fecha.php');
include '../../modelo/Paginacion.php';
require_once('../../modelo/Table.php');







if (validar_user()) {

    $obj_permiso = new Permiso();
    $obj_permiso->setIdEmpresa($_SESSION['k_empresa']);
    $permiso = $obj_permiso->optenerPermisosDeUsuarioEnModulo(PESAJE_PRODUCCION);



    if (!$obj_permiso->verificaPermisoParaConsulta($permiso)) {
        mensajeModal();
    }




    $fecha_inicial=$_SESSION['fecha_inicial'] ;
    $fecha_final=$_SESSION['fecha_final'];
    $op=$_SESSION['op'] ;
    $maquina=$_SESSION['maquina'];
    $operador=$_SESSION['operador'];
    $consecutivo=$_SESSION['consecutivo'];
    $tipoMaterial=$_SESSION['tipoMaterial'] ;
    $turno=$_SESSION['turno'] ;
    $id_empresa = $_SESSION['k_empresa'];






    $bitacora = new Bitacora();
    $produccion = new Produccion();
     $paginacion = new Paginacion();
  


  
    $bitacora->setIdEmpresa($id_empresa);
    $produccion->setIdEmpresa($id_empresa);


    $paginacion->setNumeroRegistroNumRows($produccion->consultaOrdenProduccionPrefijoMaquinaConVelocidad($op, $maquina, $turno, $operador, $consecutivo, $tipoMaterial, $fecha_inicial, $fecha_final));
    $produccion->next_result();
    
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

    $paginacion->setLinkPaginacion('paginacionConsultaPesajeProduccion');
    $paginationCtrls = $paginacion->getLink();

    $inicioLimite = $paginacion->getLimiteInicio();
    $numeroPagina = $paginacion->getNumeroRegistroPorPagina();




    $consultaProduccion = $produccion->consultaOrdenProduccionPrefijoMaquinaConVelocidadPaginada($op, $maquina, $turno, $operador, $consecutivo, $tipoMaterial, $fecha_inicial, $fecha_final,$inicioLimite, $numeroPagina);
                                                  
    $fieldProduccion = $produccion->field_count - 1;

    $mostarListadoDeProduccion = $consultaProduccion->num_rows;

    $OrdenProduccion=6;
     $consecutivoPesaje=8;
     $idMaterial=7;
     $idMaquina = 1;
     $idTurno = 2;
     $idOperador=3;     
     
    
    
    $tabla = new Table();
    $tabla->crearArrayConLinkproduccion(
            $consultaProduccion,
            $fieldProduccion,
            $OrdenProduccion,
            $consecutivoPesaje,
            $idMaterial,
            $idMaquina,
            $idTurno ,
            'editarPesajeProduccion');
    

  

    if ($mostarListadoDeProduccion == 0) {

        mensajeDeErrorModal($titulo = 'LA CONSULTA NO ARROJO RESULTADOS'
                , $subtitulo = 'Seleccione un valor valido para la consulta'
                , $mensaje = 'Para un mejor resultado , intente con otros valores de busqueda');
        exit();
    }




    require_once '../../vista/produccion/MostrarRegistroProduccion.php';
} else {
    echo("<script>alert('Usted no esta logiado, ingrese para despues ejecutar la opcion de registro!!')</script>");
    raiz();
    exit();
}
?>






