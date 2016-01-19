<?php

if (!isset($_SESSION)) {
    session_start();
}


require_once ('../modelo/validar_usuario.php');
validar_user_amd();


require_once '../modelo/Maquina_Modelo.php';
require_once ('../modelo/raiz_directorio_principal.php');



if (!isset($_POST['maquina'])) {
    $id_maquina = '';
} else {
    $id_maquina = ($_POST['maquina']);
}

if (!isset($_POST['seccion'])) {
    $seccion = '';
} else {
    $seccion = ($_POST['seccion']);
}

if (!isset($_POST['equipo'])) {
    $equipo = '';
} else {
    $equipo = ($_POST['equipo']);
}

if (!isset($_POST['parte'])) {
    $parte_equipo = '';
} else {
    $parte_equipo = ($_POST['parte']);
}




$maquina = new Maquina();

$maquina->setIdEmpresa(($_SESSION['k_empresa']));
$maquina->setIdMaquina($id_maquina);
$maquina->setIdSeccion($seccion);
$maquina->setEquiponMaquina($equipo);
$maquina->setParteEquiponMaquina($parte_equipo);



if (($maquina->consultarRelacionSeccionMaquina()->num_rows) >= 1) {

    $maquina->next_result();


    if (($maquina->consultarRelacionSeccionEquipo()->num_rows) >= 1) {


        $maquina->next_result();


        if (($maquina->consultarRelacionMaquinaEquipo()->num_rows) >= 1) {

            $maquina->next_result();



            if (($maquina->consultarRelacionMaquinaParte()->num_rows) <= 0) {

                $maquina->next_result();

                if (($maquina->consultarRelacionParteEquipo()->num_rows) <= 0) {
                    $maquina->next_result();

                    $maquina->procesaTransacciones($maquina->relacionMaquinaParteEquipo(),
                                                   $maquina->relacionParteEquipo());




                    $consulta = $maquina->consultarRelacionParteMaquinaMostrar();
                    $field = $maquina->field_count;

                    require_once '../vista/amd_MostrarMaquinaSeccionEquipoParte.php';
                    exit();
                } else {

                    echo('<script>alert("La parte  seleccionada, ya tiene una relacion con  el equipo seleccionado, seleccione una que no")</script>');
                    raiz_amd();
                    exit();
                }
            } else {

                echo('<script>alert("La parte del seleccionada, ya tiene una relacion con  la maquina seleccionada, seleccione una que no")</script>');
                raiz_amd();
                exit();
            }
        } else {

            echo('<script>alert("El equipo seleccionado   no teine una relacion con la maquina, seleccione uno que si")</script>');
            raiz_amd();
            exit();
        }
    } else {

        echo('<script>alert("La seccion   no tiene una relacion con la maquiuna , por favor seleccione una que si")</script>');
        raiz_amd();
        exit();
    }
} else {

    echo('<script>alert("La maquina seleccionada  no tiene una relacion con la seccion seleccionada , por favor seleccione una que si")</script>');
    raiz_amd();
    exit();
}
?>






