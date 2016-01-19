

<?php

if (!isset($_SESSION)) {
    session_start();
}








require_once '../modelo/Usuario_Modelo.php';
require_once '../modelo/validar_usuario.php';
require_once ('../modelo/raiz_directorio_principal.php');





if (validar_user() && (strtolower($_SESSION['k_userName']) == 'amd')) {




    if (!isset($_POST['clave_actual'])) {
        $pass_old = '';
    } else {
        $pass_old = ($_POST['clave_actual']);
    }

    if (!isset($_POST['nueva_clave'])) {
        $pass_new1 = '';
    } else {
        $pass_new1 = ($_POST['nueva_clave']);
    }

    if (!isset($_POST['confirma_clave'])) {
        $pass_new2 = '';
    } else {
        $pass_new2 = ($_POST['confirma_clave']);
    }


    if (!isset($_POST['nombre'])) {
        $nombre = '';
    } else {
        $nombre = ($_POST['nombre']);
    }






    $usuario = new Usuario($_SESSION['k_userName'], $_SESSION['k_userPass']);


    $usuario->setIdEmpresa($_SESSION['k_empresa']);





    $usuario->setNombreUsuario($nombre);






    $usuario->compararClavesUsuario($pass_new1, $pass_new2);
    $usuario->setPassAnterior($pass_old);





    $consulta = $usuario->consultarUsuario();


    $usuario->next_result();






    if (($consulta->num_rows) >= 1) {


        

        $usuario->procesaTransacciones($usuario->cambiarCalve());




        echo('<script>alert("Su clave ha sido cambida")</script>');
        raiz_amd();
        exit();
    } else {
        echo('<script>alert("Error!! su antigua clave no coincide con la ingresada")</script>');
        raiz_amd();
        exit();
    }
} else {
    echo("<script>alert('Usted no esta logiado, ingrese para despues ejecutar la opcion de registro!!')</script>");
    raiz();
}
?>






