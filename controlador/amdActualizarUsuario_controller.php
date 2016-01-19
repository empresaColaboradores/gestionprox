
<?php

if (!isset($_SESSION)) {
    session_start();
}


require_once '../modelo/Usuario_Modelo.php';
require_once '../modelo/validar_usuario.php';
require_once ('../modelo/raiz_directorio_principal.php');
require_once ('../modelo/modal_consulta.php');
require_once('../modelo/Table.php');

validar_user_amd();




if (!isset($_POST['usuario'])) {
    $usuario2 = '';
} else {
    $usuario2 = ($_POST['usuario']);
}

if (!isset($_POST['estado'])) {
    $estado = '';
} else {
    $estado = ($_POST['estado']);
}



if (!isset($_POST['motivo'])) {
    $motivo = '';
} else {
    $motivo = ($_POST['motivo']);
}




$usuario = new Usuario();


$usuario->setIdEmpresa($_SESSION['k_empresa']);
$usuario->setNombreUsuario($usuario2);
$usuario->setTipoEstado($estado);
$usuario->setMotivoEstado($motivo);


$usuario->consultaNombreUsuario();
$usuario->next_result();

 $usuario->actualizarEstdoUsario();



$consulta = $usuario->query($usuario->consultaEstadoUsuarioPorParametros($usuario2, '', ''));
$field = $usuario->field_count-1;

$tabla = new Table();
$tabla->crearArraySimple($consulta, $field);

require_once '../vista/amd_MostrarEstadoUsuario.php';
exit();
?>