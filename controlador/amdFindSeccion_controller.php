<?php

if (!isset($_SESSION)) {
    session_start();
}

require_once '../modelo/Maquina_Modelo.php';
require_once '../modelo/validar_usuario.php';
require_once ('../modelo/raiz_directorio_principal.php');
require_once('../modelo/Table.php');

validar_user_amd();



if (!isset($_POST['id'])) {
    $id_seccion = '';
} else {
    $id_seccion = ($_POST['id']);
}

if (!isset($_POST['seccion'])) {
    $nombre = '';
} else {
    $nombre = ($_POST['seccion']);
}


if (!isset($_POST['descripcion'])) {
    $descripcion = '';
} else {
    $descripcion = ($_POST['descripcion']);
}




$maquina = new Maquina();


$maquina->setIdEmpresa($_SESSION['k_empresa']);
$consulta = $maquina->consultarSeccionParametros($id_seccion, $nombre, $descripcion);
$field = $maquina->field_count - 1;

$tabla = new Table();
$tabla->crearArraySimple($consulta, $field);



require_once '../vista/amd_MostrarSeccion.php';
exit();



if (($consulta->num_rows) <= 0) {
    echo('<script>alert("No existe Coincidencia con los parametros de busquedas introducidos")</script>');
    raiz_amd();
    exit();
}
?>






