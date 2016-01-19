<?php

if (!isset($_SESSION)) {
    session_start();
}


require_once ('../modelo/validar_usuario.php');
validar_user_amd();


require_once '../modelo/Maquina_Modelo.php';
require_once ('../modelo/raiz_directorio_principal.php');
require_once('../modelo/Table.php');
?>


<?php


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

if (!isset($_POST['equipo'])) {
    $equipo = '';
} else {
    $equipo = ($_POST['equipo']);
}




$maquina = new Maquina();

$maquina->setIdEmpresa(($_SESSION['k_empresa']));

$id_maquina = $maquina->crearConsultalike($id_maquina);
$seccion = $maquina->crearConsultalike($seccion);
$equipo = $maquina->crearConsultalike($equipo);





$consulta=$maquina->consultarPartesDeMaquina($id_maquina, $seccion, $equipo);
$field = $maquina->field_count-1;

$tabla = new Table();
$tabla->crearArraySimple($mysqli_result, $field);



require_once '../vista/amd_MostrarMaquinaSeccionEquipoParte.php';
exit();
?>






