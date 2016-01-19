<?php

if (!isset($_SESSION)) {
    session_start();
}

require_once ('../modelo/Database.php');
require_once '../modelo/GenerarListaDesplegable.php';
require_once ('../modelo/validar_usuario.php');
require_once('../modelo/Table.php');
validar_user_amd();


require_once '../modelo/Maquina_refactorizada.php';
require_once ('../modelo/raiz_directorio_principal.php');



if (!isset($_POST['formulario'])) {
    $id_formulario = '';
} else {
    $id_formulario = ($_POST['formulario']);
}

if (!isset($_POST['maquina'])) {
    $id_maquina = '';
} else {
    $id_maquina = ($_POST['maquina']);
}



$maquina = new Maquina_refactorizada();

$maquina->setIdEmpresa(($_SESSION['k_empresa']));
$maquina->setIdMaquina($id_maquina);


if ($maquina->MaquinaTieneAsignadaUnaJerarQui()) {


    $maquina->next_result();
    $maquina->actualizarJerarquiaDeMaquina($id_formulario);

    $consulta = $maquina->visualizarRelacionAreaMaquina();
    $field = $maquina->field_count - 1;
    $tabla = new Table();
    $tabla->crearArraySimple($tabla, $field);




    require_once '../vista/amd_MostrarArbolJerarQuicoMAquina.php';
    exit();
}
?>






