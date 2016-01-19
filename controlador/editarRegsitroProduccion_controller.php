<?php

require_once ('../modelo/Database.php');
require_once '../modelo/Turno.php';
require_once ('../modelo/validar_usuario.php');
require_once ('../modelo/raiz_directorio_principal.php');
require_once ('../modelo/modal_consulta.php');
require_once ('../modelo/ComprobarPermiso.php');
require_once ('../modelo/Recursos.php');
require_once ('../modelo/Produccion.php');
require_once ('../modelo/GenerarListaDesplegable.php');

require_once ('../modelo/Maquina_refactorizada.php');
require_once ('../modelo/Operador_refactorizado.php');
require_once('../modelo/FormularioDinamico.php');










if (validar_user()) {

    $obj_permiso = new Permiso();
    $obj_permiso->setIdEmpresa($_SESSION['k_empresa']);
    $permiso = $obj_permiso->optenerPermisosDeUsuarioEnModulo(PESAJE_PRODUCCION);



    if (!$obj_permiso->verificaPermisoParaRegistro()) {
        mensajeModal();
    }






    if (!isset($_GET['id'])) {
        $OrdenProduccion = '';
    } else {
        $OrdenProduccion = ($_GET['id']);
    }

    if (!isset($_GET['consecutivoProduccion'])) {
        $consecutivoProduccion = '';
    } else {
        $consecutivoProduccion = ($_GET['consecutivoProduccion']);
    }

    if (!isset($_GET['fichaTecnica'])) {
        $fichaTecnica = '';
    } else {
        $fichaTecnica = ($_GET['fichaTecnica']);
    }

    if (!isset($_GET['maquina'])) {
        $nombreMaquina = '';
    } else {
        $nombreMaquina = ($_GET['maquina']);
    }

    if (!isset($_GET['turno'])) {
        $nombreTurno = '';
    } else {
        $nombreTurno = ($_GET['turno']);
    }

    $id_empresa = $_SESSION['k_empresa'];










    $objetoMaquina = new Maquina_refactorizada();
    $produccion = new Produccion();
    $turno = new Turno();





    $objetoMaquina->setIdEmpresa($id_empresa);
    $objetoMaquina->setNombreMaquina($nombreMaquina);

    $produccion->setIdEmpresa($id_empresa);
    $produccion->setIdMaquina($objetoMaquina->getId());

    $turno->setTurno();
    $turno->setIdEmpresa($id_empresa);
    $turno->setNombreTurno($nombreTurno);
    $produccion->setIdTurno($turno->getIdTurno());

    $produccion->setIdOrdenProduccion($OrdenProduccion);

    $turno->setIdEmpresa($_SESSION['k_empresa']);


    $consecutivoProduccion = preg_replace('/[a-zA-Z]/', '', $consecutivoProduccion);

    $produccion->setConsecutivoProduccion($consecutivoProduccion);


    
    $produccion->setTipoMaterialDigitadoPorElUsuario($fichaTecnica);
    $idFicha = $produccion->getIdFicha();
    
    
    


    $produccion->next_result();
    $produccion->setIdFichaTecnicaOtipoMaterial($idFicha);


  


    $consultaProduccion = $produccion->consultaMaterialPesado();   
    $row = $consultaProduccion->fetch_array(MYSQLI_ASSOC);
    
    $id_op=$row['op'];
    $id_consecutivo=$row['no_producto_final'];
    $kilosUnidades_producidos=$row['kilos_producidos'];
    $fecha=$row['fecha'];
    $velocidad=$row['velocidad'];
    $id_registro=$row['id'];
    
     
    
    
 
    
   
    
    $_SESSION['velocidad']=$velocidad;
    $_SESSION['ficha']=$fichaTecnica;
    
  

    require_once '../peticion/editarPesajeProduccion.php';
} else {
    echo("<script>alert('Usted no esta logiado, ingrese para despues ejecutar la opcion de registro!!')</script>");
    raiz();
    exit();
}
?>






