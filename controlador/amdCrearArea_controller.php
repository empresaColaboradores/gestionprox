
<?php

if (!isset($_SESSION)) {
    session_start();
}



require_once '../modelo/Area_refactorizada.php';
require_once '../modelo/validar_usuario.php';
require_once ('../modelo/raiz_directorio_principal.php');
require_once ('../modelo/modal_consulta.php');
require_once('../modelo/Table.php');

validar_user_amd();





if (!isset($_POST['area'])) {
    $nombreArea = '';
} else {
    $nombreArea = ($_POST['area']);
}






$area = new Area_refactorizada();
$area->setNombreArea($nombreArea);
$area->setIdEmpresa($_SESSION['k_empresa']);



$area->existsArea();
$area->next_result();
$area->registrarArea();


$consulta = $area->visualizarAreRegistrada();
$field = $area->field_count - 1;

$tabla = new Table();
$tabla->crearArraySimple($consulta, $field);
require_once '../vista/amd_MostrarArea.php';
exit();
?>






