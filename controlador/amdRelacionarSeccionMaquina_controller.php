<?php

if (!isset($_SESSION)) {
    session_start();
}


require_once ('../modelo/validar_usuario.php');
validar_user_amd();


require_once '../modelo/Maquina_Modelo.php';
require_once ('../modelo/raiz_directorio_principal.php');
require_once('../modelo/Table.php');



if (!isset($_POST['maquina'])) {
    $id_maquina = '';
} else {
    $id_maquina = ($_POST['maquina']);
}

if (!isset($_POST['seccion'])) {
    $seccion = '';
} else {
    $seccion = ($_POST['seccion']);
}




$maquina = new Maquina();

$maquina->setIdEmpresa(($_SESSION['k_empresa']));
$maquina->setIdMaquina($id_maquina);
$maquina->setIdSeccion($seccion);


if (($maquina->consultarRelacionSeccionMaquina()->num_rows) <= 0) {


    $maquina->next_result();
    $maquina->relacionSeccionMaquina();
    $consulta = $maquina->consultarRelacionSeccionMaquinaMostrar();
    $field = $maquina->field_count;

    $tabla = new Table();
    $tabla->crearArraySimple($consulta, $field);
 



    require_once '../vista/amd_MostrarMaquinaSeccion.php';
    exit();
} else {

    echo('<script>alert("La seccion  seleccionada ya existe seleccione otra")</script>');
    raiz_amd();
    exit();
}
?>






