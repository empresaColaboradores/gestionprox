
<?php

if (!isset($_SESSION)) {
    session_start();
}


require_once '../modelo/Defecto_Modelo.php';
require_once '../modelo/validar_usuario.php';
require_once('../modelo/captcha.php');
require_once('../modelo/Table.php');

validar_user_amd();


if (!isset($_POST['nombre'])) {
    $Nombre = '';
} else {
    $Nombre = ($_POST['nombre']);
}


if (!isset($_POST['detalle'])) {
    $detalle = '';
} else {
    $detalle = ($_POST['detalle']);
}



$defecto = new Defecto();
$cap = new Captchap();
$cap->verifyFormToken('amd_rg_causa');



$defecto->setNombre($Nombre);
$defecto->setIdEmpresa($_SESSION['k_empresa']);
$defecto->setDetalle($detalle);




$consulta = $defecto->consultaDefecto();
$defecto->next_result();

$defecto->registrarCausa();



mostrarRegistroEmpresa($defecto);

function mostrarRegistroEmpresa($defecto) {


    $consulta = $defecto->consultarCausaRegistradasPorEmpresa();
    $field = $defecto->field_count - 1;
    $tabla = new Table();
    $tabla->crearArraySimple($consulta, $field);

    require_once '../vista/amd_MostrarCausa.php';
    exit();
}
?>






