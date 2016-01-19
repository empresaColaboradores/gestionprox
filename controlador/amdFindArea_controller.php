<?php

if (!isset($_SESSION)) {
    session_start();
}

require_once '../modelo/Area_refactorizada.php';
require_once '../modelo/validar_usuario.php';
require_once ('../modelo/raiz_directorio_principal.php');
require_once('../modelo/Table.php');

validar_user_amd();




if (!isset($_POST['id'])) {
    $id_area = '';
} else {
    $id_area = ($_POST['id']);
}

if (!isset($_POST['equipo'])) {
    $nombreArea = '';
} else {
    $nombreArea = ($_POST['equipo']);
}








$area = new Area_refactorizada();


$area->setIdEmpresa($_SESSION['k_empresa']);
$id_area = $area->crearConsultalike($id_area);
$nombreArea = $area->crearConsultalike($nombreArea);





$consulta = $area->consultarArea($id_area, $nombreArea, $descripcion);
$consulta->num_rows;
$field = $area->field_count-1;

$tabla = new Table();
$tabla->crearArraySimple($consulta, $field);

require_once '../vista/amd_MostrarArea.php';
exit();


if (!($consulta->num_rows) <=0) {
    
     echo('<script>alert("No existe Coincidencia con los parametros de busquedas introducidos")</script>');
    raiz_amd();
    exit();

} 
?>






