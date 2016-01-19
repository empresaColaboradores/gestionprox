<?php

if (!isset($_SESSION)) {
    session_start();
}


require '../modelo/Database.php';
require_once '../modelo/GenerarListaDesplegable.php';
require_once ('../modelo/validar_usuario.php');
validar_user_amd();


require_once '../modelo/Maquina_refactorizada.php';
require_once ('../modelo/raiz_directorio_principal.php');
require_once('../modelo/Table.php');



if (!isset($_POST['formulario'])) {
    $id_formulario = '';
} else {
    $id_formulario = ($_POST['formulario']);
}

if (!isset($_POST['maquina'])) {
    $nombre_maquina = '';
} else {
    $nombre_maquina = ($_POST['maquina']);
}



$maquina = new Maquina_refactorizada();

$maquina->setIdEmpresa(($_SESSION['k_empresa']));

$nombre_maquina = $maquina->crearConsultalike($nombre_maquina);
$maquina->setNombreMaquina($nombre_maquina);

$id_formulario = $maquina->crearConsultalike($id_formulario);

$consulta = $maquina->consultarJerarquiaAsignadaEnMaquina($id_formulario);
$field = $maquina->field_count;

 $tabla = new Table();
 $tabla->crearArraySimple($consulta, $field);
 
 



require_once '../vista/amd_MostrarArbolJerarQuicoMAquina.php';
exit();
?>






