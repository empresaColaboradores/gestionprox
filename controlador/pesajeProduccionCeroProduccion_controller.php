<?php


require_once '../modelo/Bitacora.php';
require_once '../modelo/Turno.php';
require_once ('../modelo/validar_usuario.php');
require_once ('../modelo/raiz_directorio_principal.php');
require_once ('../modelo/modal_consulta.php');

require_once ('../modelo/ComprobarPermiso.php');
require_once ('../modelo/Recursos.php');
require_once ('../modelo/Produccion.php');







if (validar_user()) {

    $obj_permiso = new Permiso();
    $obj_permiso->setIdEmpresa($_SESSION['k_empresa']);
    $permiso = $obj_permiso->optenerPermisosDeUsuarioEnModulo(PESAJE_PRODUCCION);



    if (!$obj_permiso->verificaPermisoParaRegistro($permiso)) {
        mensajeModal();
    }




    foreach ($_POST as $key => $numero) {




        if (($_SESSION['k_userName']) != strtoupper('formado')) {

            if ($key == "material") {
                $tipoMaterial = (double) ($numero);
            }
        } else {
            if ($key == "material") {
                $tipoMaterial = ($numero);
            }
        }
    }

    $id_empresa = $_SESSION['k_empresa'];








    $bitacora = new Bitacora();
    $produccion = new Produccion();
    $turno = new Turno();

  
    $bitacora->setIdEmpresa($id_empresa);
    $produccion->setIdEmpresa($id_empresa);

    $maquina = $_SESSION['maquina'];
    $operador = $_SESSION['operador'];
    
    

    $bitacora->setMaquina($maquina);
    $bitacora->setOperador($operador);
    $bitacora->setOp(1);

    $turno->setIdEmpresa($_SESSION['k_empresa']);
    $turno->setTurno();


    $bitacora->setTurno($turno->getTurno());




    $consecutivo = $produccion->getUltimoConsecutivo() + 2;
    $produccion->setConsecutivoProduccion($consecutivo);
    $produccion->next_result();




    $produccion->setKilosProducidoSinValidacion(0);



    if (($_SESSION['k_userName']) == strtoupper('formado')) {
        
         if ($maquina == 6) {
            
            $produccion->setTipoMaterial(9944);
        } else {

            if ($maquina == 7) {
                $produccion->setTipoMaterial(9945);
            }
        }
       
    } 


    


    $bitacora->compruebaExistenciaMaquina();
    $bitacora->next_result();

    $produccion->compruebaConsecutivoDuplicado();
    $produccion->next_result();

    $bitacora->compruebaExistenciaOperador();
    $bitacora->next_result();


    $produccion->compruebaExistenciaMaterial();
    $produccion->next_result();


    $bitacora->setUsuario($_SESSION['k_userName']);


   
    if (!$produccion->existUnidadesPesadas($bitacora)) {
        $produccion->next_result();
        $produccion->registrarProduccion($bitacora);
    }




    require_once '../vista/MostrarRegistroCeroProduccion.php';
} else {
    echo("<script>alert('Usted no esta logiado, ingrese para despues ejecutar la opcion de registro!!')</script>");
    raiz();
    exit();
}
?>






