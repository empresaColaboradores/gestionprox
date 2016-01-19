<?php

require_once ('../modelo/Database.php');
require_once('../modelo/captcha.php');
require_once ('../modelo/validar_usuario.php');
require_once ('../modelo/raiz_directorio_principal.php');
require_once ('../modelo/modal_consulta.php');
require_once ('../modelo/ComprobarPermiso.php');
require_once ('../modelo/Recursos.php');
require_once ('../modelo/Produccion.php');
require_once ('../modelo/Fecha.php');
require_once '../modelo/GenerarListaDesplegable.php';

require_once ('../modelo/Maquina_refactorizada.php');
require_once ('../modelo/Operador_refactorizado.php');
require_once '../modelo/Turno.php';
require_once('../modelo/Table.php');







if (validar_user()) {

    $obj_permiso = new Permiso();
    $obj_permiso->setIdEmpresa($_SESSION['k_empresa']);
    $permiso = $obj_permiso->optenerPermisosDeUsuarioEnModulo(PESAJE_PRODUCCION);



    if (!$obj_permiso->verificaPermisoParaRegistro()) {
        mensajeModal();
    }


    $cap = new Captchap();
    $cap->verifyFormToken('pesajeProduccion');

   




    foreach ($_POST as $key => $numero) {


        if ($key == "maquina") {
            $maquina = (int) $numero;
        }

        if ($key == "operador") {
            $operador = (int) $numero;
        }

        if ($key == "op") {
            $op = (int) ($numero);
        }


        if ($key == "consecutivo") {
            $consecutivo = (int) ($numero);
        }

        if ($key == "kilos") {
            $unidadesKilosMetros = (double) ($numero);
        }

        if ($key == "outPut") {
            $outPut = (double) ($numero);
        }

        if ($key == "kilosProducido") {
            $kilosProducido = (double) ($numero);
        }

        if ($key == "fecha") {
            $fecha = ($numero);
        }

        if ($key == "turno") {
            $turno = (int) ($numero);
        }


        /* solo el usuario reproceso selecciona el mateiral los demas los digitan */
        if (($_SESSION['k_userName']) == strtoupper('reproceso')) {

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



    




 $Objetofecha = new Fecha($fecha, '');

    $produccion = new Produccion();
    $objetoMaquina = new Maquina_refactorizada();
    $ObjetoOperador = new Operador_refactorizado();
    $ObjetoTurno = new Turno();






    $produccion->setIdEmpresa($id_empresa);
    $ObjetoOperador->setIdEmpresa($id_empresa);

    $objetoMaquina->setIdEmpresa($id_empresa);
    $objetoMaquina->setIdMaquina($maquina);
    $objetoMaquina->existsMaquina();
    $objetoMaquina->next_result();
    $produccion->setIdMaquina($objetoMaquina->getIdMaquina());


    $ObjetoOperador->setIdOperador($operador);
    $ObjetoOperador->existsOperador();
    $ObjetoOperador->next_result();
    $produccion->setIdOperador($ObjetoOperador->getIdOperador());



    $produccion->setIdOrdenProduccion($op);
    $produccion->compruebaConsecutivoDuplicado();
   



     
    $ObjetoTurno->setIdTurnoManual($turno);
    $produccion->setIdTurno($ObjetoTurno->getTurno());
    $produccion->setFechaRegistroProduccion($Objetofecha->getFechaInicial()); 
   
   



    $consecutivo = $produccion->getUltimoConsecutivo() + 2;
    $produccion->setConsecutivoProduccion($consecutivo);
    $produccion->next_result();




    $produccion->setProducido($unidadesKilosMetros);
    $produccion->setKilosPesado($kilosProducido);




    if (($_SESSION['k_userName']) == strtoupper('reproceso')) {



        /* solo el usuario reproceso selecciona el tipo de material el no digita */
        $produccion->setIdFichaTecnicaOtipoMaterial($tipoMaterial);
    } else {



        /* todos los usuarios ingrese la ficha manual */
        $produccion->setTipoMaterialDigitadoPorElUsuario($tipoMaterial);
        $idFicha = $produccion->getIdFicha();


        $produccion->next_result();
        $produccion->setIdFichaTecnicaOtipoMaterial($idFicha);
        $produccion->setVelocidadProduccion($outPut);
    }




    $produccion->compruebaExistenciaMaterial();
    $produccion->next_result();


   $produccion->setUsuarioSistema($_SESSION['k_userName']);
    $produccion->ponerAldiaElRegistroDeProduccion();



    /* registrar tiempo improductivo automatico solo para el usuario 
     * entubado que  no sabe utilizar aun el reporte de tiempo improductivo
     */
    if (($_SESSION['k_userName']) == strtoupper('ENTUBADO')) {



        $bitacora->setIdSeccion(10);
        $bitacora->setEquipo(7);
        $bitacora->setMinuto(0);
        $bitacora->setHora(0);
        $bitacora->setTiempoImproductivo(0);
        $bitacora->setIdParteEquipo(12);
        $bitacora->setIdDefecto(18);
        $bitacora->setIdCausa(29);
        $bitacora->setDetalle('registro,  automatico de prueba, esto mientras los  operadores aprenden a utilizar  la aplicacion');

        $bitacora->registrarTiempoImproductivo();
    }









    $consultaProduccion = $produccion->visualizarProduccionRegistrada();
    $fieldProduccion = $produccion->field_count - 1;

    $mostarListadoDeProduccion = $consultaProduccion->num_rows;
    $produccion->next_result();
    
    $OrdenProduccion=6;
     $consecutivoPesaje=8;
     $idMaterial=7;
     $idMaquina = 1;
     $idTurno = 2;
     $idOperador=3;     
     $mostarEstadistica = $mostrarConsulta;
    
    
    $tabla = new Table();
    $tabla->crearArrayConLinkproduccion(
            $consultaProduccion,
            $fieldProduccion,
            $OrdenProduccion,
            $consecutivoPesaje,
            $idMaterial,
            $idMaquina,
            $idTurno ,
            'editarPesajeProduccion');

    require_once '../vista/MostrarRegistroProduccion.php';
} else {
    echo("<script>alert('Usted no esta logiado, ingrese para despues ejecutar la opcion de registro!!')</script>");
    raiz();
    exit();
}
?>






