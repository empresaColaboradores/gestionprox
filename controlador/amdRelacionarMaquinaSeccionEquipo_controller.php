<?php

if (!isset($_SESSION)) {
    session_start();
}


require_once ('../modelo/validar_usuario.php');
validar_user_amd();


require_once '../modelo/Maquina_Modelo.php';
require_once ('../modelo/raiz_directorio_principal.php');
require_once('../modelo/Table.php');



if (!isset($_POST['maquina'])) {
    $id_maquina = '';
} else {
    $id_maquina = ($_POST['maquina']);
}

if (!isset($_POST['seccion'])) {
    $seccion = '';
} else {
    $seccion = ($_POST['seccion']);
}

if (!isset($_POST['equipo'])) {
    $equipo = '';
} else {
    $equipo = ($_POST['equipo']);
}





$maquina = new Maquina();

$maquina->setIdEmpresa(($_SESSION['k_empresa']));
$maquina->setIdMaquina($id_maquina);
$maquina->setIdSeccion($seccion);
$maquina->setEquiponMaquina($equipo);



if (($maquina->consultarRelacionSeccionMaquina()->num_rows) >= 1) {
    $maquina->next_result();


    if (($maquina->consultarRelacionSeccionEquipo()->num_rows) <= 0) {

        $maquina->next_result();
        consultarRelacionEquipoMaquina($maquina, $maquina->relacionMaquinaEquipo(), $maquina->relacionMaquinaSeccionEquipo());
    } else {
        $maquina->next_result();
        consultarRelacionEquipoMaquina($maquina, $maquina->relacionMaquinaEquipo());
    }
} else {

    echo('<script>alert("La maquina seleccionada  no tiene una relacion con la seccion seleccionada , por favor seleccione una que si")</script>');
    raiz_amd();
    exit();
}

function consultarRelacionEquipoMaquina($maquina, $relacionMaquinaEquipo, $relacionMaquinaSeccion = "select 1;") {

    if (($maquina->consultarRelacionMaquinaEquipo()->num_rows) <= 0) {
        $maquina->next_result();
        relacionarMaquinaSeccionEquipo($maquina, $relacionMaquinaEquipo, $relacionMaquinaSeccion);
    } else {
        echo('<script>alert("El equipo seleccionado   ya tiene una relacion con la maquina seleccionada")</script>');
        raiz_amd();
        exit();
    }
}

function relacionarMaquinaSeccionEquipo($maquina, $relacionarMaquinaEquipo, $relacionarSeccionEquipo = "SELECT 1;") {

    $maquina->procesaTransacciones($relacionarMaquinaEquipo, $relacionarSeccionEquipo);


    $consulta = $maquina->consultarMaquinaSeccionEquipoRegistrado();
    $field = $maquina->field_count-1;

    $tabla = new Table();
    $tabla->crearArraySimple( $consulta, $field);
    


    require_once '../vista/amd_MostrarMaquinaSeccionEquipo.php';
    exit();
}
?>






