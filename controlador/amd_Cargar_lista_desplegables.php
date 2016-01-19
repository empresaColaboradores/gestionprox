<?php

/* * *
 * opcion 1 es gargar lista desplegable de origen
 * opcion 2 es cargar lista desplegable de maquinas
 */

$op = $_GET['op'];

if (!isset($_GET['code'])) {
    $code = '';
} else {
    $code = ($_GET['code']);
}

if (!isset($_GET['maquina'])) {
    $maquina = '';
} else {
    $maquina = ($_GET['maquina']);
}

if ($op == 1) {
    require_once("../modelo/Bitacora.php");
    require_once ('../modelo/validar_usuario.php');
    $selects = new Bitacora();
    $array = $selects->cargarOrigen($code);
    cargarArchivos($array);
}


if ($op == 2) {

    require_once("../modelo/Usuario_Modelo.php");
    require_once ('../modelo/validar_usuario.php');
    
    $selects = new Usuario();
    $array = $selects->cargarEstado();
    cargarArchivos($array);
}


if ($op == 3) {

    require_once ('../modelo/validar_usuario.php');
    if (!validar_user()) {
        echo "1";
    } else {
        echo "2";
    }
}



if ($op == 4) {


    require_once("../modelo/Usuario_Modelo.php");
    require_once ('../modelo/validar_usuario.php');

   
    
    $selects = new Usuario();
    $array = $selects->cargarMotivos();
    cargarArchivos($array);
}





function cargarArchivos($array) {

    foreach ($array as $key => $value) {
        echo "<option value=\"$key\">$value</option>";
    }
}

?>