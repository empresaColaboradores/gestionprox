<?php

if (!isset($_SESSION)) {
    session_start();
}

require_once '../modelo/Usuario_Modelo.php';
require_once '../modelo/validar_usuario.php';
require_once('../modelo/Table.php');

validar_user_amd();




if (!isset($_POST['contactoU'])) {
    $contacto = '';
} else {
    $contacto = ($_POST['contactoU']);
}

if (!isset($_POST['password'])) {
    $password = '';
} else {
    $password = ($_POST['password']);
}



if (!isset($_POST['password2'])) {
    $password2 = '';
} else {
    $password2 = ($_POST['password2']);
}

if (!isset($_POST['emailU'])) {
    $email_rc = '';
} else {
    $email_rc = ($_POST['emailU']);
}

if (!isset($_POST['id'])) {
    $id = '';
} else {
    $id = ($_POST['id']);
}


$usuario = new Usuario();



if (($_SESSION['k_empresa']) == 1) {

    $usuario->setIdEmpresa($_SESSION['k_empresa']);
} else {
    $usuario->setIdEmpresa($_SESSION['k_empresa']);
}

$usuario->setNombreUsuario($contacto);


$usuario->compararClavesUsuario($password, $password2);

$usuario->setEmail($email_rc);

$contactoF = $usuario->getNombre();


$tabla = new Table();



if (($usuario->ConsultaNombreDuplicado()->num_rows) <= 0) {

    $usuario->next_result();

    if (($usuario->ConsultaEmailDuplicado()->num_rows) <= 0) {
        $usuario->next_result();

        $bool = $usuario->functionRegistrarUsuario($usuario->registrarUsuario(), $usuario->registrarUsurioPrimeraVez());



        if ($bool) {
            $consulta = $usuario->mostrarDatosUsuario();
            $field = $usuario->field_count-1;

            $tabla->crearArraySimple($consulta, $field);
            
        } else {



            exit;
        }
    } else {

        echo('<script>alert("El email introducido lo utiliza otro usuario, no se puede registrar dos email iguales, por favor cambielo ")</script>');
        raiz_amd();
    }
}


require_once '../vista/amd_MostrarUsuarioCreado.php';
exit();
?>