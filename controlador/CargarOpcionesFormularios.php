<?php

$op = $_GET['op'];

if (!isset($_GET['maquina'])) {
    $id_maquina = '';
} else {
    $id_maquina = ($_GET['maquina']);
}




if ($op == 23) {

    require_once('../modelo/Database.php');
    require_once('../modelo/FormularioDinamico.php');
    $formulario = new FormularioDinamico();
    $formulario->setIdEmpresa(($_SESSION['k_empresa']));
    $formulario->setPerfilFormularioSegunUsuario($_SESSION['k_userName']);
    $formulario->getFormularioSegunUsuario();
}


if ($op == 24) {

    require_once('../modelo/Database.php');
    require_once('../modelo/FormularioDinamico.php');
    require_once('../modelo/Table.php');

    $formulario = new FormularioDinamico();
    $formulario->setIdEmpresa(($_SESSION['k_empresa']));
    $formulario->setFormularioPesajeProduccion($id_maquina);
    $formulario->getFormularioParaPesarProduccion();
}

/* reemplazara la opcion 23 */

if ($op == 25) {

    require_once('../modelo/Database.php');
    require_once('../modelo/FormularioDinamico.php');
    require_once('../modelo/FormularioSimple.php');
    $formulario = new FormularioDinamico();
    $formulario->setIdEmpresa(($_SESSION['k_empresa']));
    $formulario->setTipoFormularioSegunMaquina($id_maquina);
    $formulario->getFormularioSegunMaquina();
    $formulario->showFormulario();
}

/* cargar tipo formulario */
if ($op == 26) {

    require_once('../modelo/Database.php');
    require_once('../modelo/FormularioDinamico.php');
    $formulario = new FormularioDinamico();
    $formulario->setIdEmpresa(($_SESSION['k_empresa']));
    $array = $formulario->cargarTipoFormulario();
    cargarArchivos($array);
}

function cargarArchivos($array) {

    foreach ($array as $key => $value) {
        echo "<option value=\"$key\">$value</option>";
    }
}

?>