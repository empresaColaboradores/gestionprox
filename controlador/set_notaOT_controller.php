

<?php

require_once('../modelo/captcha.php');
require_once '../modelo/Bitacora.php';
require_once ('../modelo/validar_usuario.php');
require_once ('../modelo/raiz_directorio_principal.php');
require_once ('../modelo/modal_consulta.php');

require_once ('../modelo/ComprobarPermiso.php');
require_once ('../modelo/Recursos.php');
require_once('../modelo/Table.php');


$obj_permiso = new Permiso();
$obj_permiso->setIdEmpresa($_SESSION['k_empresa']);
$permiso = $obj_permiso->optenerPermisosDeUsuarioEnModulo(ORDEN_TRABAJO);



if (!$obj_permiso->verificaPermisoParaRegistro($permiso)) {
    mensajeModal();
}




if (validar_user()) {




    foreach ($_POST as $key => $numero) {


        if ($key == "detalle") {
            $detalle = $numero;
        }

        if ($key == "tecnico") {
            $tecnico = $numero;
        }

        if ($key == "estado") {
            $estado = intval($numero);
        }

        if ($key == "id_ot") {
            $id_ot = intval($numero);
        }
    }










    $bitacora = new Bitacora();
    $cap = new Captchap();
    $bitacora->setIdEmpresa($_SESSION['k_empresa']);



    $consulta = $bitacora->consultarEstadoOT($id_ot);
    $bitacora->next_result();

    if (($consulta->num_rows) <= 0) {

        mensajeDeErrorModal($titulo = 'LA ORDEN ESTA CERRADA NO SE PUEDE EDITAR'
                , $subtitulo = 'No es posible su modificacion'
                , $mensaje = 'Si requiere editar esta orden, por favor coloquese en conctacto con el Jefe de Mantenimiento');
        exit();
    }




   $detalle = strtoupper($detalle); 
    $bitacora->crearNotaMatto($tecnico, $detalle);
    $id_nota = $bitacora->optenerUltimoConsecutivoRegistrado();



    $bitacora->relacionarNota_OT($id_ot, $id_nota);

    $bitacora->actualizarOTid($id_ot, $estado);



    $consulta = $bitacora->consultarNotaMecanicoPorOrdenDeTrabajo($id_ot);
    $field = $bitacora->field_count - 1;
    
    

    $tabla = new Table();
    
    
    $id_ordenDeTrabajo=4;
    $valoresDefecto=0;
    $columnaDondeVaElLink=5;
    
    $tabla->crearArrayConLink($consulta, $field,  $id_ordenDeTrabajo, $columnaDondeVaElLink, $valoresDefecto, 'set_ot');
    
    

  




    require_once '../vista/MostrarNotaRegistrada.php';
} else {
    echo("<script>alert('Usted no esta logiado, ingrese para despues ejecutar la opcion de registro!!')</script>");
    raiz();
    exit();
}
?>






