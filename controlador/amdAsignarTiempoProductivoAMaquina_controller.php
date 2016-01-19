<?php

if (!isset($_SESSION)) {
    session_start();
}


require_once ('../modelo/validar_usuario.php');
validar_user_amd();




require_once '../modelo/Bitacora_refactorizada.php';
require_once '../modelo/Maquina_refactorizada.php';
require_once '../modelo/Hora.php';
require_once '../modelo/modal_consulta.php';
require_once("../modelo/GenerarListaDesplegable.php");
require_once('../modelo/Table.php');





if (!isset($_POST['horaProductiva'])) {
    $id_hora = '';
} else {
    $id_hora = ($_POST['horaProductiva']);
}

if (!isset($_POST['maquina'])) {
    $id_maquina = '';
} else {
    $id_maquina = ($_POST['maquina']);
}





$bitacora = new Bitacora_refacotirzada();
$maquina = new Maquina_refactorizada();



$bitacora->setIdEmpresa($_SESSION['k_empresa']);
$maquina->setIdEmpresa($_SESSION['k_empresa']);
$maquina->setIdMaquina($id_maquina);

$maquina->existsMaquina();
$maquina->next_result();


$maquina->existsRelacionMaquinaHoraProductiva();
$maquina->next_result();
$maquina->asignarRelacionHoraProductivaAMaquina($id_hora);



$consulta= $maquina->visualizarTiemposProductivosAsignadosAmaquina();
$field = $maquina->field_count - 1;


$tabla = new Table();
$tabla->crearArraySimple($consulta, $field);


require_once '../vista/amd_MostrarTiempoProductivosAsignadosAMaquinas.php';
exit();
?>






