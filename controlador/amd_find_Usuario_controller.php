<?php

if (!isset($_SESSION)) {
    session_start();
}





require_once '../modelo/Usuario_Modelo.php';
require_once '../modelo/validar_usuario.php';
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





if ($motivo == '0') {
    $motivo = '';
}

if ($estado == '0') {
    $estado = '';
}







$usuario = new Usuario();
$usuario->setIdEmpresa($_SESSION['k_empresa']);

$consulta = $usuario->query($usuario->consultaEstadoUsuarioPorParametros($usuario2, $estado, $motivo));
$field = $usuario->field_count-1;


$tabla = new Table();
$tabla->crearArraySimple($consulta , $field);




if ($consulta->num_rows >= 1) {


    require_once '../vista/amd_MostrarEstadoUsuario.php';
} else {

    echo("<script>alert(\"El Usuario que intenta buscar no existe\")</script>");

    exit();
}
?>
