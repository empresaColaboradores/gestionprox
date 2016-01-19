<?php

if (!isset($_SESSION)) {
    session_start();
}

require_once '../modelo/Defecto_Modelo.php';
require_once '../modelo/validar_usuario.php';
require_once ('../modelo/raiz_directorio_principal.php');
require_once('../modelo/Table.php');

validar_user_amd();



if (!isset($_POST['nombre'])) {
    $Nombre = '';
} else {
    $Nombre = ($_POST['nombre']);
}





$defecto = new Defecto();

$defecto->setNombre($Nombre);
$defecto->setIdEmpresa($_SESSION['k_empresa']);







$consulta = $defecto->consultarDefecto();



if (($consulta->num_rows) <= 0) {


    $defecto->next_result();
    $defecto->registrarDefecto();





    mostrarRegistroEmpresa($defecto);
} else {


    echo('<script>alert("Defecto duplicado rectifique")</script>');
    $defecto->next_result();
    mostrarRegistroEmpresa($defecto);
}

function mostrarRegistroEmpresa($defecto) {


    $consulta = $defecto->consultarDefecto();
    $field = $defecto->field_count - 1;
    $tabla = new Table();
    $tabla->crearArraySimple($consulta, $field);

    require_once '../vista/amd_MostrarDefecto.php';
    exit();
}
?>






