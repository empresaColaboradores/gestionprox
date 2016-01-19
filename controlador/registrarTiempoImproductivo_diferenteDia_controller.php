<?php
require_once ('../modelo/validar_usuario.php');
require_once('../modelo/captcha.php');
require_once '../modelo/Bitacora.php';
require '../modelo/GenerarListaDesplegable.php';

require_once '../modelo/Constantes.php';

require_once '../modelo/Maquina_refactorizada.php';
require_once '../modelo/SeccionMaquina.php';
require_once '../modelo/EquipoMaquina.php';
require_once '../modelo/ParteMaquina.php';

require_once '../modelo/Operador_refactorizado.php';
require_once '../modelo/Tiempo_Improductivo.php';

require_once '../modelo/UsuarioRefactorizado.php';


require_once ('../modelo/raiz_directorio_principal.php');
require_once ('../modelo/modal_consulta.php');
require_once ('../modelo/ComprobarPermiso.php');
require_once ('../modelo/Recursos.php');
require_once ('../modelo/Fecha.php');

require_once ('../modelo/Hora.php');
require_once('../modelo/Table.php');









if (validar_user()) {


    $obj_permiso = new Permiso();
    $obj_permiso->setIdEmpresa($_SESSION['k_empresa']);
    $permiso = $obj_permiso->optenerPermisosDeUsuarioEnModulo(TIEMPO_IMPRODUCTIVO);



    if (!$obj_permiso->verificaPermisoParaRegistro($permiso)) {
        mensajeModal();
    }




    foreach ($_POST as $key => $datosFormularios) {

        if ($key == "maquina") {
            $maquina = (int) $datosFormularios;
        }

        if ($key == "seccion") {
            $seccion = (int) $datosFormularios;
        }

        if ($key == "equipo") {
            $equipo = (int) ($datosFormularios);
        }
        
         if ($key == "turno") {
            $turno = (int) ($datosFormularios);
        }
        
        if ($key == "fecha") {
            $fecha =  ($datosFormularios);
        }

        if ($key == "parte") {
            $parte_equipo = (int) ($datosFormularios);
        }

        if ($key == "operador") {
            $operador = (int) $datosFormularios;
        }
        
        
         if ($key == "hora") {
            $hora = (int) $datosFormularios;
        }
        
        if ($key == "minuto") {
            $minuto= (int) $datosFormularios;
        }
       
        if ($key == "origen") {
            $origen = (int) $datosFormularios;
        }

        if ($key == "causa") {
            $causa = (int) $datosFormularios;
        }

        if ($key == "titulo") {
            $titulo = (int) $datosFormularios;
        }



        if ($key == "detalle") {
            $detalle = strtoupper($datosFormularios);
        }
    }

    $id_empresa = $_SESSION['k_empresa'];




    

    


    $bitacora = new Bitacora();
    $parteMaquina = new ParteMaquina();
    $TiempoImproductivo = new Tiempo_Improductivo();
    $TipoTiempo = new TipoTiempo_Improductivo();
    $ObjetoOperador = new Operador_refactorizado();
    $Usuario = new UsuarioRefactorizado();
  
    $cap = new Captchap();
    $Objetofecha = new Fecha($fecha, '');
    $ObjetoHora = new Reloj($hora, $minuto);
    $cap->verifyFormToken('rg_bitacora_2');
    $bitacora->setIdEmpresa($_SESSION['k_empresa']);
    $id_ot = ''; /* representa el id de una ot */
    $titulo_vista = '';

    $Usuario->setNombreUsuario($_SESSION['k_userName']);


    $parteMaquina->setIdEmpresa($_SESSION['k_empresa']);
    $parteMaquina->setIdMaquina($maquina);
    $parteMaquina->setIdSeccion($seccion);
    $parteMaquina->setIdEquipo($equipo);
    $parteMaquina->setIdParteMaquina($parte_equipo);


    $parteMaquina->existsMaquina();
    $parteMaquina->next_result();

    $parteMaquina->existsSeccionMaquina();
    $parteMaquina->next_result();


    $parteMaquina->existsEquipo();
    $parteMaquina->next_result();

    $parteMaquina->existsParteEquipoMaquina();
    $parteMaquina->next_result();

    $_SESSION['maquina']=$maquina;


    $bitacora->setMaquina($parteMaquina->getIdMaquina());
    $bitacora->setSeccion($parteMaquina->getIdSeccion());
    $bitacora->setEquipo($parteMaquina->getIdEquipo());
    $bitacora->setParteEquipo($parteMaquina->getIdparteMaquina());



    $TipoTiempo->setIdEmpresa($_SESSION['k_empresa']);
    $TipoTiempo->setIdTipoTiempoImproductivo($origen);
    $TipoTiempo->existsTipoCausaTiempoImproductivo();
    $TipoTiempo->next_result();

    $TiempoImproductivo->setIdEmpresa($_SESSION['k_empresa']);
    $TiempoImproductivo->setIdCausa($causa);
    $TiempoImproductivo->existsCausa();
    $TiempoImproductivo->next_result();

    


    $bitacora->setIdDefecto($TipoTiempo->getIdTiempoImproductivo());
    $bitacora->setIdCausa($TiempoImproductivo->getIdCausa());



    $ObjetoOperador->setIdEmpresa($_SESSION['k_empresa']);
    $ObjetoOperador->setIdOperador($operador);
    $ObjetoOperador->existsOperador();
    $ObjetoOperador->next_result();

    $_SESSION['operador']=$operador;


   
    $bitacora->setOperador($ObjetoOperador->getIdOperador());    
   



    /*solo el usuario ext puede reportar mas de 8 horas*/
     if (($_SESSION['k_userName']) != strtoupper('EXT')  ) {         
        
        $ObjetoHora->isHoraFueraDeRango();

        
        
    } 



    $ObjetoHora->isMinutoFueraDeRango();
    $ObjetoHora->convertirHorasToMinutos();
    $bitacora->setTiempoImproductivo($ObjetoHora->getTotalTiempo());
    $bitacora->setDetalle($detalle);
    $bitacora->setUsuario($Usuario->getNombreUsuario());
    $bitacora->setTurno($turno);
    $bitacora->setDate($Objetofecha->getFechaInicial());
    
    
     /**
     * solo extrusion pude registrar mas de 8 horas por turno,
     * 
     */
    if (($_SESSION['k_userName']) != strtoupper('EXT')  ) { /* consultar pagina simple o completa */ 
        
        $bitacora->isTiempoDeOchoHorasPorTurno();
        $bitacora->next_result();
        
    } 
    
    $bitacora->registrarTiempoImproductivoDiaDiferente();
    $id_bitacora = $bitacora->optenerUltimoConsecutivoRegistrado();

    /* aqui va el codigo que crea la ot automatica*/

    $consultaTiempoImproductivo = $bitacora->visualizarRegistroTiempoImproductivo($id_bitacora);


    $fieldTiempoImproducto = $bitacora->field_count - 1;
    $mostarListadoDeTiempoImproductivo = $consultaTiempoImproductivo->num_rows;
    $bitacora->next_result();


    
    $tabla = new Table();
    $tabla->crearArraySimple($consultaTiempoImproductivo, $fieldTiempoImproducto);



    if ($titulo == 1) {
        $titulo_vista = 'ORDEN DE TRABAJO REGISTRADA';
    } else {

        $titulo_vista = 'REGISTRO TIEMPO IMPRODUCTIVO ';
    }



    require_once '../vista/MostrarRegistroTiempoImprductivo.php';
 
}

?>



