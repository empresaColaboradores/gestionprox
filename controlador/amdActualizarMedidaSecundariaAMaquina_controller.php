<?php

if (!isset($_SESSION)) {
    session_start();
}


require_once ('../modelo/validar_usuario.php');
validar_user_amd();



require_once('../modelo/Database.php');
require_once("../modelo/GenerarListaDesplegable.php");
require_once '../modelo/Maquina_refactorizada.php';
require_once '../modelo/modal_consulta.php';
require_once('../modelo/Table.php');





if (!isset($_POST['id_maquina'])) {
    $id_maquina = '';
} else {
    $id_maquina = ($_POST['id_maquina']);
}

if (!isset($_POST['unidadMedidaActual'])) {
    $id_unidad = '';
} else {
    $id_unidad = ($_POST['unidadMedidaActual']);
}

if (!isset($_POST['unidadMedidaDeseada'])) {
    $id_unidadMedidaDeseada= '';
} else {
    $id_unidadMedidaDeseada = ($_POST['unidadMedidaDeseada']);
}






$maquina = new Maquina_refactorizada();




$maquina->setIdEmpresa($_SESSION['k_empresa']);
$maquina->setIdMaquina($id_maquina);

$maquina->noExistsRelacionMaquinaMedidaSEcundaria($id_unidad); 
$maquina->next_result();
$maquina->actualizarMedidaDeProduccionSecundaria($id_unidad,$id_unidadMedidaDeseada);



$consulta= $maquina->visualizarMedidaSecundariasAsignadaAmaquina();
$field = $maquina->field_count - 1;

$maquina->next_result();


$tabla = new Table();
$tabla->crearArraySimple($consulta, $field);


require_once '../vista/amd_MostrarUnidadDeMedidaSecundariaAsignadosAMaquinas.php';
exit();
?>






