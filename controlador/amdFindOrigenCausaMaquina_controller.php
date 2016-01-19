
<?php

if (!isset($_SESSION)) {
    session_start();
}


require_once '../modelo/Defecto_Modelo.php';
require_once ('../modelo/raiz_directorio_principal.php');
require_once ('../modelo/validar_usuario.php');
require_once('../modelo/Table.php');
validar_user_amd();




if (!isset($_POST['maquina'])) {
    $maquina = '';
} else {
    $maquina = ($_POST['maquina']);
}

if (!isset($_POST['origen'])) {
    $origen = '';
} else {
    $origen = ($_POST['origen']);
}


if (!isset($_POST['causa'])) {
    $causa = '';
} else {
    $causa = ($_POST['causa']);
}




$defecto = new Defecto();

$defecto->setIdEmpresa(($_SESSION['k_empresa']));




$maquina = $defecto->crearConsultalike($maquina);
$origen = $defecto->crearConsultalike($origen);
$causa = $defecto->crearConsultalike($causa);

$consulta = $defecto->consultarMaquinaOrigenCausa_parametros($maquina, $origen, $causa);
$field = $defecto->field_count-1;

$tabla = new Table();
$tabla->crearArraySimple($consulta, $field);





require_once '../vista/amd_MostrarMaquinaOrigenCausa.php';
exit();
?>






