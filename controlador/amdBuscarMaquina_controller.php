
<?php

if (!isset($_SESSION)) {
    session_start();
}

require_once '../modelo/Maquina_Modelo.php';
require_once '../modelo/validar_usuario.php';
require_once ('../modelo/raiz_directorio_principal.php');
require_once('../modelo/Table.php');

validar_user_amd();



if (!isset($_POST['maquina'])) {
    $empresaNombre = '';
} else {
    $empresaNombre = ($_POST['maquina']);
}

if (!isset($_POST['codigo'])) {
    $codigo = '';
} else {
    $codigo = ($_POST['codigo']);
}






$maquina = new Maquina();




$maquina->setIdEmpresa($_SESSION['k_empresa']);
$codigo = $maquina->crearConsultalike($codigo);



$consulta = $maquina->consultarMaquinasRegistradas($codigo, $empresaNombre);
$field = $maquina->field_count-1;

$tabla = new Table();
$tabla->crearArraySimple($consulta, $field);



require_once '../vista/amd_MostrarMaquina.php';
exit();
?>






