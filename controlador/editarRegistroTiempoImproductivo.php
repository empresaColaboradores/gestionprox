<?php

include '../modelo/Bitacora.php';
include '../modelo/Paginacion.php';
require_once ('../modelo/validar_usuario.php');
require_once '../modelo/raiz_directorio_principal.php';
require_once ('../modelo/modal_consulta.php');
?>


<?php

if (validar_user()) {




    if (!isset($_GET['id'])) {
        $id_registro = '';
    } else {
        $id_registro = ($_GET['id']);
    }





    $id_empresa = $_SESSION['k_empresa'];

    $bitacora = new Bitacora();
    $bitacora->setIdEmpresa($_SESSION['k_empresa']);






    $mysql_result = $bitacora->consultaRegistroBitacoraPorID($id_registro);
    $rowcount = $mysql_result->fetch_array(MYSQLI_ASSOC);
    $fecha = $rowcount['fecha'];
    $operador = $rowcount['operador'];
    $maquina = $rowcount['id_maquina'];
    $descripcion = $rowcount['descripcion_fall'];
    $nombreCausa = $rowcount['nombre_causa'];
    $hora = $rowcount['hora'];
    $turno = $rowcount['turno'];
    
    $_SESSION['id_registro']=$id_registro;

    

    
    $minuto = ($hora - intval($hora))*60;
    

    $hora = round($hora, 0, 2);




    require_once '../peticion/editarRegistroTiempoImproductivo.php';
} else {
    echo("<script>alert('Usted no esta logiado, ingrese para despues ejecutar la opcion de registro!!')</script>");
    raiz();
}
?>






