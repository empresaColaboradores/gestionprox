<?php

if (!isset($_SESSION)) {
    session_start();
}


require_once ('../modelo/validar_usuario.php');
validar_user_amd();


require_once '../modelo/Defecto_Modelo.php';
require_once ('../modelo/raiz_directorio_principal.php');
require_once('../modelo/Table.php');




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



$defecto = new Defecto();

$defecto->setIdEmpresa(($_SESSION['k_empresa']));
$defecto->setIdMaquina($maquina);
$defecto->setIdOrigen($origen);







if (($defecto->consultarRelacionDefectoMaquina()->num_rows) <= 0) {


    $defecto->next_result();
    $defecto->relacionOrigenMaquina();

    $consulta = $defecto->consultarOrigenMaquina();
    $field = $defecto->field_count - 1;

    $tabla = new Table();
    $tabla->crearArraySimple($consulta, $field);
    





    require_once '../vista/amd_MostrarMaquinaOrigen.php';
    exit();
} else {

    echo('<script>alert("el origen ya esta registrado en esta maquina seleccione otro")</script>');
    raiz_amd();
    exit();
}
?>






