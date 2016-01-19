
<?php

if (!isset($_SESSION)) {
    session_start();
}


require_once '../modelo/Empresa_Modelo.php';
require_once '../modelo/validar_usuario.php';
require_once ('../modelo/raiz_directorio_principal.php');
require_once('../modelo/Table.php');






if ( (($_SESSION['k_userName']) == 'amd') && ($_SESSION['k_empresa'])=='1' ) {

   
    if (!isset($_POST['empresa'])) {
        $empresaNombre = '';
    } else {
        $empresaNombre = ($_POST['empresa']);
    }

    if (!isset($_POST['nit'])) {
        $nit_cc = '';
    } else {
        $nit_cc = ($_POST['nit']);
    }





    $empresa = new Empresa();
    $empresa->setNombre($empresaNombre);
    $empresa->setNit_cc($nit_cc);



    if (($empresa->consultarEmpresaNit_CC()->num_rows) <= 0) {


        $empresa->next_result();
        $empresa->registrarEmpresa();

        $consulta = $empresa->consultarEmpresaNit_CC();
        $row = $consulta->fetch_array(MYSQLI_ASSOC);

       
        $id_empresa = $row['id_empresa'];

        $_SESSION['k_make_new_company'] = $id_empresa;




          $empresa->next_result();

        mostrarRegistroEmpresa($empresa);
    } else {

        echo('<script>alert("Nit o cedula existente rectifique")</script>');
        $empresa->next_result();
        mostrarRegistroEmpresa($empresa);
        exit();
    }
} else {
    echo("<script>alert('Usted no  es el administrador de Gestionprox, Consulte con el administrador !!!')</script>");
     raiz_amd();
    exit();
}

function mostrarRegistroEmpresa($empresa) {


    
    $consulta = $empresa->consultarEmpresaNit_CC();
    $field = $empresa->field_count-1;
     $tabla = new Table();
    $tabla->crearArraySimple($consulta, $field);
    
    require_once '../vista/amd_MostrarEmpresa.php';
    exit();
}
?>






