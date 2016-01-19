<?php

if (!isset($_SESSION)) {
    session_start();
}


require_once ('../modelo/validar_usuario.php');
validar_user_amd();


require_once '../modelo/Area_refactorizada.php';
require_once ('../modelo/raiz_directorio_principal.php');
require_once('../modelo/Table.php');



if (!isset($_POST['area'])) {
    $id_area = '';
} else {
    $id_area = ($_POST['area']);
}

if (!isset($_POST['usuario'])) {
    $nombreUsuario = '';
} else {
    $nombreUsuario = ($_POST['usuario']);
}


$area = new Area_refactorizada();

$area->setIdEmpresa(($_SESSION['k_empresa']));
$area->setIdArea($id_area);


if ($area->existRelacionBetweenAreaUsuario($nombreUsuario)) {


    $area->next_result();
    $area->relacionarAreaUsuario($nombreUsuario);



    $consulta = $area->visualizarRelacionAreaUsuario($nombreUsuario);
    $field = $area->field_count-1;

    $tabla = new Table();
    $tabla->crearArraySimple($consulta, $field);



    require_once '../vista/amd_MostrarAreaUsuario.php';
    exit();
} else {

    echo('<script>alert("este Usuario ya tiene una relacion con el area seleccionada")</script>');
    raiz_amd();
    exit();
}
?>






