<?php

if (!isset($_SESSION)) {
    session_start();
}


require_once ('../modelo/validar_usuario.php');
validar_user_amd();





require_once("../modelo/GenerarListaDesplegable.php");
require_once('../modelo/Database.php');
require_once '../modelo/Maquina_refactorizada.php';
require_once '../modelo/modal_consulta.php';
require_once('../modelo/Table.php');





if (!isset($_POST['usuario'])) {
    $usuario = '';
} else {
    $usuario = ($_POST['usuario']);
}

if (!isset($_POST['unidadMedidaPrincipal'])) {
    $id_unidad = '';
} else {
    $id_unidad = ($_POST['unidadMedidaPrincipal']);
}






$maquina = new Maquina_refactorizada();

$maquina->setIdEmpresa($_SESSION['k_empresa']);
$maquina->existsRelacionMaquinaMedidaPrincipal($usuario);
$maquina->asignarMedidaDeProduccionPrincipal($usuario,$id_unidad);
$maquina->next_result();



$consulta= $maquina->visualizarMedidaPrincipalsAsignadaAmaquina();
$field = $maquina->field_count - 1;


$tabla = new Table();
$tabla->crearArraySimple($consulta, $field);


require_once '../vista/amd_MostrarUnidadDeMedidaProductivaAsignadosAMaquinas.php';
exit();
?>






