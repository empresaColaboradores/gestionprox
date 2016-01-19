
<?php

if (!isset($_SESSION)) {
    session_start();
}
?>



<?php

require_once '../modelo/Defecto_Modelo.php';
require_once '../modelo/validar_usuario.php';
require_once ('../modelo/raiz_directorio_principal.php');
require_once('../modelo/Table.php');
validar_user_amd();
?>








<?php

if (!isset($_POST['nombre'])) {
    $Nombre = '';
} else {
    $Nombre = ($_POST['nombre']);
}

if (!isset($_POST['id'])) {
    $id = '';
} else {
    $id = ($_POST['id']);
}


$defecto = new Defecto();
$defecto->setIdEmpresa($_SESSION['k_empresa']);


$consulta = $defecto->consultarDefectos($id_operador, $Nombre, $apellido);
$field = $defecto->field_count - 1;



$tabla = new Table();
$tabla->crearArraySimple($consulta, $field);



if ($consulta->num_rows <= 0) {

    echo("<script>alert(\"El defecto que intenta buscar no existe \")</script>");
    raiz_amd();
    exit;
}

require_once '../vista/amd_MostrarDefecto.php';
exit();
?>






