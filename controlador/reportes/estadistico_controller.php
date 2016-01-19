<?php

require_once('../../modelo/captcha.php');
require_once '../../modelo/Bitacora.php';
require_once ('../../modelo/validar_usuario.php');
require_once ('../../modelo/raiz_directorio_principal.php');
require_once ('../../modelo/modal_consulta.php');
require_once ('../../modelo/ComprobarPermiso.php');
require_once ('../../modelo/Recursos.php');
require_once ('../../modelo/Fecha.php');
require_once('../../modelo/Table.php');
?>








<?php

if (validar_user()) {




    foreach ($_POST as $key => $datoformulario) {


        if ($key == "maquina") {
            $maquina = (int) $datoformulario;
        }

        if ($key == "seccion") {
            $seccion = strtoupper($datoformulario);
        }



        if ($key == "equipo") {
            $equipo = strtoupper($datoformulario);
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



    $id_empresa = $_SESSION['k_empresa'];









    $bitacora = new Bitacora();
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
    $bitacora->setIdEmpresa($_SESSION['k_empresa']);

    $permiso = $obj_permiso->optenerPermisosDeUsuarioEnModulo(ESTADISTICO);
    $obj_permiso->next_result();



    if (!$obj_permiso->verificaPermisoParaConsulta($permiso)) {
        mensajeModal();
    }





    $obj_permiso->setIdPerfilUsuario();


    $maquina = $bitacora->getParametroDeBusqueda($obj_permiso, $bitacora, $maquina);
    $seccion = $bitacora->crearConsultalike($seccion);
    $equipo = $bitacora->crearConsultalike($equipo);




    $consultaTiempoImproductivo = $bitacora->consultarMaquinaMayorIncidenciaPrefijoMAquina($maquina, $fecha_inicial, $fecha_final);
    $fieldTiempoImproducto = $bitacora->field_count - 1;
    $mostarListadoDeTiempoImproductivo = $consultaTiempoImproductivo->num_rows;
    $bitacora->next_result();

    $tabla6 = new Table();
    $tabla6->crearArraySimple($consultaTiempoImproductivo, $fieldTiempoImproducto);



    $seccionMaquina_result = $bitacora->consultarMaquinaSeccionMayorIncidenciaPrefijoMAquina($maquina, $fecha_inicial, $fecha_final);
    $fieldSeccionMaquina = $bitacora->field_count - 1;
    $listado_seccion_maquina = $seccionMaquina_result->num_rows;
    $bitacora->next_result();

    $tabla4 = new Table();
    $tabla4->crearArraySimple($seccionMaquina_result, $fieldSeccionMaquina);


    $equipo_maquina = $bitacora->consultarMaquinaEquipoMayorIncidenciaPrefijoMaquina($maquina, $seccion, $equipo, $fecha_inicial, $fecha_final);
    $field_maqina_equipo = $bitacora->field_count - 1;
    $listado_equipo_maquina = $equipo_maquina->num_rows;
    $bitacora->next_result();

    $tabla3 = new Table();
    $tabla3->crearArraySimple($equipo_maquina, $field_maqina_equipo);


    $equipo_parte_maquina = $bitacora->consultarMaquinaEquipoParteMayorIncidenciaPrefijoMaquina($maquina, $seccion, $equipo, $fecha_inicial, $fecha_final);
    $field_maqina_equipo_parte = $bitacora->field_count - 1;
    $listado_equipo_parte_maquina = $equipo_parte_maquina->num_rows;
    $bitacora->next_result();

    $tabla2 = new Table();
    $tabla2->crearArraySimple($equipo_parte_maquina, $field_maqina_equipo_parte);


    $nombreMaquina = $bitacora->determinarCuantasMaquinasConsultar($maquina);


    $bitacora->setNombreMaquina($nombreMaquina);



    $consultaEncabezadoTimpoImproductivo = $bitacora->consultarEncabezadoDinamica();
    $fieldTEncabezadoDinamico = $bitacora->field_count - 1;
    $mostarListadoEncabezadoDinamico = $consultaEncabezadoTimpoImproductivo->num_rows;
    $bitacora->next_result();

    $tabla5 = new Table();
    $tabla5->crearArraySimple($consultaEncabezadoTimpoImproductivo, $fieldTEncabezadoDinamico);
    $arrayColumnasTiemposImproductivo = $tabla5->getArray();




    $consultaFilasTiempoImprductivo = $bitacora->consultarIdEncabezadoDinamico();
    $numeroDeColumnas = $bitacora->field_count - 1;

    $tabla5->crearArraySimple($consultaFilasTiempoImprductivo, $numeroDeColumnas);
    $arrayIdTiempoImproductivos = $tabla5->getArray();
    $bitacora->next_result();


    /**
     * esta funcion crea
     */
    $vectorId = $bitacora->crearColumnasDinamicaID($arrayIdTiempoImproductivos);


    $consulta_dinamica = $bitacora->crearConsultaDinamica($vectorId);

    $tamanio = sizeof($arrayColumnasTiemposImproductivo);
    $vector = $bitacora->crearColumnasDinamica($arrayColumnasTiemposImproductivo);
    $numeroColumnas = sizeof($vector) - 1;




    $consultaTiempoImproductivo_contenido = $bitacora->consultarTiempoImproductivoDinamicaPrefijoMAquina($consulta_dinamica, $tamanio + 2, $maquina, $fecha_inicial, $fecha_final);
    $fieldTiempoImproducto_contenido = $bitacora->field_count - 1;
    $mostarListadoDeTiempoImproductivo_contenido = $consultaTiempoImproductivo_contenido->num_rows;





    $tabla = new Table();
    $tabla->crearArraySimple($consultaTiempoImproductivo_contenido, $fieldTiempoImproducto_contenido);


    if ($mostarListadoDeTiempoImproductivo == 0 && $listado_equipo_maquina == 0 && $listado_equipo_parte_maquina == 0 && $mostarListadoDeTiempoImproductivo_contenido == 0
    ) {

        mensajeDeErrorModal($titulo = 'LA CONSULTA NO ARROJO RESULTADOS'
                , $subtitulo = 'INTENTE CON OTROS PARAMETROS DE BUSQUEDA'
                , $mensaje = 'Para un mejor resultado , intente la busqueda sin parametros, si el error persiste contacte con el administrador');
        exit();
    }




    require_once '../../vista/reportes/MostrarEstadistica.php';
} else {
    echo("<script>alert('Usted no esta logiado, ingrese para despues ejecutar la opcion de registro!!')</script>");
    raiz();
    exit();
}
?>






