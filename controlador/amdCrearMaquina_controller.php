
<?php

if (!isset($_SESSION)) {
    session_start();
}



require_once '../modelo/Maquina_Modelo.php';
require_once '../modelo/validar_usuario.php';
require_once ('../modelo/raiz_directorio_principal.php');
require_once('../modelo/Table.php');

validar_user_amd();





if (!isset($_POST['maquina'])) {
    $empresaNombre = '';
} else {
    $empresaNombre = ($_POST['maquina']);
}






$maquina = new Maquina();



$maquina->setNombre($empresaNombre);
$maquina->setIdEmpresa($_SESSION['k_empresa']);



$consulta = $maquina->consultarMaquinaDuplicada();
if (($consulta->num_rows) <= 0) {


    $maquina->next_result();
    $maquina->registrarMaquina();
    $row = $consulta->fetch_array(MYSQLI_ASSOC);






    mostrarRegistroEmpresa($maquina);
} else {

    echo('<script>alert("Maquina duplicada")</script>');
    raiz_amd();
    exit();
}

function mostrarRegistroEmpresa($maquina) {



    $consulta = $maquina->consultarMaquinaDuplicada($maquina->getIdEmpresa());
    $field = $maquina->field_count - 1;

    $tabla = new Table();
    $tabla->crearArraySimple($consulta, $field);

    require_once '../vista/amd_MostrarMaquina.php';
    exit();
}
?>






