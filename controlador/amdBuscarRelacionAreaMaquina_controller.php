<?php

if (!isset($_SESSION)) {
    session_start();
}


require_once ('../modelo/validar_usuario.php');
require_once('../modelo/Table.php');
validar_user_amd();


require_once '../modelo/Area_refactorizada.php';
require_once ('../modelo/raiz_directorio_principal.php');



if (!isset($_POST['area'])) {
    $id_area = '';
} else {
    $id_area = ($_POST['area']);
}

if (!isset($_POST['mauquina'])) {
    $id_maquina = '';
} else {
    $id_maquina = ($_POST['maquina']);
}


$area = new Area_refactorizada();

$area->setIdEmpresa(($_SESSION['k_empresa']));
$area->setIdArea($id_area);





$id_area = $area->crearConsultalike($id_area);
$id_maquina = $area->crearConsultalike($id_maquina);
$consulta = $area->consultarRelacionAreaMaquina($id_maquina, $id_area);
$field = $area->field_count-1;

$tabla = new Table();
$tabla->crearArraySimple($consulta, $field);





require_once '../vista/amd_MostrarAreaMaquina.php';
exit();
?>






