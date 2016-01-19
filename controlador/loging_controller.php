<?php

session_start();

require_once('../modelo/captcha.php');
require_once('../modelo/modelo_login.php');
require_once '../modelo/raiz_directorio_principal.php';





if (!isset($_POST['usuario'])) {
    $nombre = '';
} else {
    $nombre = ($_POST['usuario']);
}

if (!isset($_POST['password'])) {
    $pass = '';
} else {
    $pass = ($_POST['password']);
}

if (!isset($_POST['empresa'])) {
    $empresa = '';
} else {
    $empresa = ($_POST['empresa']);
}



$md = new Validar($nombre, $pass, $empresa);






$query[0] = $md->consultaEstadoUsuario($nombre);
                  




$md->next_result();



$row = $query[0]->fetch_array(MYSQLI_ASSOC);
$codigo = $row['id_estado'];


 


/* 1 activado, 2 no activado */
if ($codigo == 1) {
    if (!isset($_SESSION['k_userName'])) {



        $md->getUser();


        $md->next_result();
        raiz();
    } else {

        echo("<script>alert('Ya se inicio una session')</script>");
        raiz();
        exit();
    }
}
else {
    echo("<script>alert('El usuario no esta activado aun, por favor contactar con el administrador')</script>");
    raiz();
    exit();
}
?>


