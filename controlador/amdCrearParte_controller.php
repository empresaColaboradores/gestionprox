<?php

if (!isset($_SESSION)) {
    session_start();
}

require_once '../modelo/Maquina_Modelo.php';
require_once '../modelo/validar_usuario.php';
require_once ('../modelo/raiz_directorio_principal.php');
require_once('../modelo/Table.php');


validar_user_amd();



if (!isset($_POST['parte'])) {
    $parte_equipo = '';
} else {
    $parte_equipo = ($_POST['parte']);
}


if (!isset($_POST['descripcion'])) {
    $descripcion = '';
} else {
    $descripcion = ($_POST['descripcion']);
}




$maquina = new Maquina();

$maquina->setParteEquiponMaquina($parte_equipo);
$maquina->setDetalleSeccion($descripcion);
$maquina->setIdEmpresa($_SESSION['k_empresa']);



$consulta = $maquina->consultarParte();



if (($consulta->num_rows) <= 0) {


    $maquina->next_result();
    $maquina->registrarParteEquipoMquina();





    mostrarRegistroEquipo($maquina);
} else {


    echo('<script>alert("Equipo duplicado rectifique")</script>');
    $maquina->next_result();
    mostrarRegistroSeccion($maquina);
}

function mostrarRegistroEquipo($maquina) {


    $consulta = $maquina->consultarParteEquiponMaquina();
    $field = $maquina->field_count - 1;

    $tabla = new Table();
    $tabla->crearArraySimple($consulta, $field);

    require_once '../vista/amd_MostrarParte.php';
    exit();
}
?>






