<?php


if (!isset($_SESSION)) {
    session_start();
}





function validar_user_amd() {

    if (isset($_SESSION['k_userName']) && (strtolower($_SESSION['k_userName']) == 'amd')) {
          
         
        
       
    } else {

    echo("<script>alert('Contenido restringido, contactese con el administrador')</script>");
    echo('<script>location.href="../index.php;"</script>');
    exit();


    }
}



function nombre() {

    if (isset($_SESSION['k_userName'])) {
        return "Usted es:" . $_SESSION["k_userName"] . "   ";
    } else {
        return "usted es: un visitante  ";
    }
}

if (!validar_user()) {
    echo("<script>alert('Usted no ha iniciado session, Inicie session para utilizar la aplicacion')</script>");
    echo('<script>location.href="../"</script>');
    exit();
}


function validar_user() {

    if (isset($_SESSION['k_userName'])) {
             return 1;
    } 
    
    return 0;
}
?>
