
<?php

if (!isset($_SESSION)) {
    session_start();
}


require_once '../modelo/Operador_Modelo.php';
require_once '../modelo/validar_usuario.php';
require_once ('../modelo/raiz_directorio_principal.php');
require_once('../modelo/Table.php');

validar_user_amd();



if (!isset($_POST['maquina'])) {
    $maquina = '';
} else {
    $maquina = ($_POST['maquina']);
}

if (!isset($_POST['operador'])) {
    $ope = '';
} else {
    $ope = ($_POST['operador']);
}




$operador = new Operador();
$operador->setIdEmpresa(($_SESSION['k_empresa']));


$maquina= $operador->crearConsultalike($maquina);
$ope= $operador->crearConsultalike($ope);



$consulta = $operador->listarOperadorMaquina($maquina, $ope);
$field = $operador->field_count-1;


$tabla = new Table();
$tabla->crearArraySimple($consulta, $field);



require_once '../vista/amd_MostrarOperador_Maquina.php';
exit();
?>






