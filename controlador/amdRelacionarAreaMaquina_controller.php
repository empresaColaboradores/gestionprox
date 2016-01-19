<?php

if (!isset($_SESSION)) {
    session_start();
}


require_once ('../modelo/validar_usuario.php');
validar_user_amd();


require_once '../modelo/Area_refactorizada.php';
require_once ('../modelo/raiz_directorio_principal.php');



if (!isset($_POST['area'])) {
    $id_area = '';
} else {
    $id_area = ($_POST['area']);
}

if (!isset($_POST['maquina'])) {
    $id_maquina = '';
} else {
    $id_maquina = ($_POST['maquina']);
}



$area = new Area_refactorizada();

$area->setIdEmpresa(($_SESSION['k_empresa']));
$area->setIdArea($id_area);
 

if ($area->existRelacionBetweenAreaMaquina($id_maquina)) {


    $area->next_result();
    $area->relacionarAreaMaquina($id_maquina);



    $consulta = $area->visualizarRelacionAreaMaquina($id_maquina);
    $field = $area->field_count;



    require_once '../vista/amd_MostrarAreaMaquina.php';
    exit();
} else {

    echo('<script>alert("La maquina seleccionada tiene una relacion con el area seleccionada")</script>');
    raiz_amd();
    exit();
}
?>






