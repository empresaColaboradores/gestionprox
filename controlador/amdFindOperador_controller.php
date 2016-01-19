<?php

if (!isset($_SESSION)) {
    session_start();
}

require_once '../modelo/Operador_Modelo.php';
require_once '../modelo/validar_usuario.php';
require_once ('../modelo/raiz_directorio_principal.php');
require_once('../modelo/Table.php');

validar_user_amd();




if (!isset($_POST['nombre'])) {
    $contacto = '';
} else {
    $contacto = ($_POST['nombre']);
}

if (!isset($_POST['apellido'])) {
    $apellido = '';
} else {
    $apellido = ($_POST['apellido']);
}

if (!isset($_POST['id'])) {
    $id = '';
} else {
    $id = ($_POST['id']);
}







$operador = new Operador();




$operador->setIdEmpresa($_SESSION['k_empresa']);

$consulta = $operador->consultaOperador($id_operador, $Nombre, $apellido);
$field = $operador->field_count-1;

$tabla = new Table();
$tabla->crearArraySimple($consulta, $field);



require_once '../vista/amd_MostrarOperador.php';

if ($consulta->num_rows <= 0) {

    echo("<script>alert(\"El operador  que intenta buscar no existe \")</script>");
    raiz_amd();
    exit;
}
?>