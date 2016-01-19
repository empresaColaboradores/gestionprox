

<?php

require_once('../modelo/captcha.php');
require_once '../modelo/Bitacora.php';
require_once ('../modelo/validar_usuario.php');
require_once ('../modelo/raiz_directorio_principal.php');
require_once ('../modelo/modal_consulta.php');

require_once ('../modelo/ComprobarPermiso.php');
require_once ('../modelo/Recursos.php');
require_once ('../modelo/Produccion.php');
require_once ('../modelo/Fecha.php');
require_once('../modelo/Table.php');







if (validar_user()) {

    $obj_permiso = new Permiso();
    $obj_permiso->setIdEmpresa($_SESSION['k_empresa']);
    $permiso = $obj_permiso->optenerPermisosDeUsuarioEnModulo(PESAJE_PRODUCCION);



    if (!$obj_permiso->verificaPermisoParaConsulta($permiso)) {
        mensajeModal();
    }


    if (!isset($_GET['excel'])) {
        $exportar = '';
    } else {
        $exportar = ($_GET['excel']);
    }



    $id_empresa = $_SESSION['k_empresa'];







    $bitacora = new Bitacora();
    $produccion = new Produccion();



    $fecha_inicial = $_SESSION['fecha_inicial'];
    $fecha_final = $_SESSION['fecha_final'];
    $op = $_SESSION['op'];
    $maquina = $_SESSION['maquina'];
    $operador = $_SESSION['operador'];
    $consecutivo = $_SESSION['consecutivo'];
    $tipoMaterial = $_SESSION['tipoMaterial'];
    $turno = $_SESSION['turno'];

    $bitacora->setIdEmpresa($id_empresa);
    $produccion->setIdEmpresa($id_empresa);










    $consulta = $produccion->consultaOrdenProduccionPrefijoMaquina($op, $maquina, $turno, $operador, $consecutivo, $tipoMaterial, $fecha_inicial, $fecha_final);
    $field = $produccion->field_count-1;
    $mostarListadoDeProduccion = $consultaProduccion->num_rows;
    
     $tabla = new Table();
     $tabla->crearArraySimple($consulta, $field);
     
     


    



    if ($exportar == 'excell') {

        require_once '../vista/exportarPesajeProduccionExcell.php';
    }else{
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






