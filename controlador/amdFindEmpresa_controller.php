
<?php

if (!isset($_SESSION)) {
    session_start();
}
?>




<?php

require_once '../modelo/Empresa_Modelo.php';
require_once '../modelo/validar_usuario.php';
require_once ('../modelo/raiz_directorio_principal.php');
require_once('../modelo/Table.php');
?>








<?php

if ((($_SESSION['k_userName']) == 'amd') && ($_SESSION['k_empresa']) == '1') {


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


    if (!isset($_POST['id'])) {
        $id = '';
    } else {
        $id = ($_POST['id']);
    }



    $empresa = new Empresa();

    $id = $empresa->crearConsultalike($id);
    $nit_cc = $empresa->crearConsultalike($nit_cc);
    $empresaNombre = $empresa->crearConsultalike($empresaNombre);





    $consulta = $empresa->consultaEmpresa($id, $nit_cc, $empresaNombre);
    $field = $empresa->field_count - 1;

    $tabla = new Table();
    $tabla->crearArraySimple($consulta, $field);
    

    if ($consulta->num_rows <= 0) {

        echo("<script>alert(\"La empresa que intenta buscar no existe \")</script>");
        raiz_amd();


        exit;
    }

    require_once '../vista/amd_MostrarEmpresa.php';
} else {
    echo("<script>alert('contenido restringido consulte con el administrador!!')</script>");
    raiz();
    exit();
}
?>






