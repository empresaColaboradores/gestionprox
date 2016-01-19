<?php



$op = $_GET['op'];

if (!isset($_GET['code'])) {
    $code = '';
} else {
    $code = ($_GET['code']);
}

if (!isset($_GET['code2'])) {
    $code2 = '';
} else {
    $code2 = ($_GET['code2']);
}

if (!isset($_GET['code3'])) {
    $code3 = '';
} else {
    $code3 = ($_GET['code3']);
}

if (!isset($_GET['maquina'])) {
    $maquina = '';
} else {
    $maquina = ($_GET['maquina']);
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

    $formulario = new FormularioDinamico();
    $formulario->setIdEmpresa(($_SESSION['k_empresa']));
    $formulario->setPerfilFormularioSegunUsuario($_SESSION['k_userName']);
    $formulario->getFormularioParaPesarProduccion();
}

function cargarArchivos($array) {

    foreach ($array as $key => $value) {
        echo "<option value=\"$key\">$value</option>";
    }
}

?>