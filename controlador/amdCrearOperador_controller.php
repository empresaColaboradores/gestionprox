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




$operador = new Operador();



$operador->setNombre($contacto);
$operador->setApllido($apellido);
$operador->setIdEmpresa($_SESSION['k_empresa']);



$consulta = $operador->consultarOperadorDuplicado();
if (($consulta->num_rows) <= 0) {


    $operador->next_result();
    $operador->registrarOperador();



    mostrarRegistroEmpresa($operador);
} else {

    echo('<script>alert("Nit o cedula existente rectifique")</script>');
    raiz_amd();
    exit();
}

function mostrarRegistroEmpresa($operador) {


    $consulta = $operador->consultarOperadorDuplicado();
    $field = $operador->field_count - 1;
    $tabla = new Table();
    $tabla->crearArraySimple($consulta, $field);
    require_once '../vista/amd_MostrarOperador.php';
    exit();
}

?>