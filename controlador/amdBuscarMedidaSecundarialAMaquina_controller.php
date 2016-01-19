<?php

if (!isset($_SESSION)) {
    session_start();
}


require_once ('../modelo/validar_usuario.php');
validar_user_amd();




require_once('../modelo/Database.php');
require_once '../modelo/Maquina_refactorizada.php';
require_once '../modelo/modal_consulta.php';
require_once("../modelo/GenerarListaDesplegable.php");
require_once('../modelo/Table.php');





if (!isset($_POST['id_maquina'])) {
    $id_maquina = '';
} else {
    $id_maquina = ($_POST['id_maquina']);
}

if (!isset($_POST['unidadMedida'])) {
    $id_unidadSecundaria = '';
} else {
    $id_unidadSecundaria = ($_POST['unidadMedida']);
}


$maquina = new Maquina_refactorizada();
$maquina->setIdEmpresa($_SESSION['k_empresa']);

$id_maquina = $maquina->crearConsultalike($id_maquina);
$id_unidad = $maquina->crearConsultalike($id_unidadSecundaria);


$consulta = $maquina->listarMedidaSecundariasAsignadaAmaquina($id_maquina,$id_unidad);
$field = $maquina->field_count - 1;


$tabla = new Table();
$tabla->crearArraySimple($consulta, $field);


require_once '../vista/amd_MostrarUnidadDeMedidaSecundariaAsignadosAMaquinas.php';
exit();
?>






