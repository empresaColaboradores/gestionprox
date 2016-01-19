

<?php

require_once('../modelo/captcha.php');
require_once '../modelo/Bitacora.php';
require_once ('../modelo/validar_usuario.php');
require_once ('../modelo/raiz_directorio_principal.php');
require_once ('../modelo/modal_consulta.php');

require_once ('../modelo/ComprobarPermiso.php');
require_once ('../modelo/Recursos.php');
require_once '../modelo/Turno.php';
require_once '../modelo/GenerarListaDesplegable.php';
require_once('../modelo/Table.php');







if (validar_user()) {

    $obj_permiso = new Permiso();
    $obj_permiso->setIdEmpresa($_SESSION['k_empresa']);
    $permiso = $obj_permiso->optenerPermisosDeUsuarioEnModulo(TIEMPO_IMPRODUCTIVO);



    if (!$obj_permiso->verificaPermisoParaRegistro($permiso)) {
        mensajeModal();
    }




    foreach ($_POST as $key => $numero) {


        if ($key == "maquina") {
            $maquina = (int) $numero;
        }

        if ($key == "operador") {
            $operador = (int) $numero;
        }

        if ($key == "kwh") {
            $kwh = (double) $numero;
        }



        if ($key == "detalle") {
            $detalle = strtoupper($numero);
        }
    }

    $id_empresa = $_SESSION['k_empresa'];








    $bitacora = new Bitacora();
    $cap = new Captchap();
    $turno = new Turno();
    $cap->verifyFormToken('rg_bitacora_1');
    $bitacora->setIdEmpresa($id_empresa);

    $turno->setIdEmpresa($_SESSION['k_empresa']);
    $turno->setTurno();

    $bitacora->setMaquina($maquina);
    $bitacora->setOperador($operador);
    $bitacora->setkwh(0);
    $bitacora->setDetalle($detalle);
   $bitacora->setTurno($turno->getTurno());


    $bitacora->compruebaExistenciaMaquina();
    $bitacora->next_result();

    $bitacora->compruebaExistenciaOperador();
    $bitacora->next_result();

    $usuario = ($_SESSION['k_userName']);

    $bitacora->registroBitacora($usuario);

    $id_bitacora = $bitacora->optenerUltimoConsecutivoRegistrado();



    $consultaTiempoImproductivo = $bitacora->consultaBitacora($id_bitacora);
    $fieldTiempoImproducto = $bitacora->field_count - 1;
    $mostarListadoDeTiempoImproductivo = $consultaTiempoImproductivo->num_rows;
    $bitacora->next_result();
    
    $tabla= new Table();
    $tabla->crearArraySimple($consultaTiempoImproductivo, $fieldTiempoImproducto);
    


    require_once '../vista/MostrarRegistroBitacora.php';
} else {
    echo("<script>alert('Usted no esta logiado, ingrese para despues ejecutar la opcion de registro!!')</script>");
    raiz();
    exit();
}


?>






