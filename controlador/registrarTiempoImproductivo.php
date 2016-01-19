<?php

require_once('../modelo/captcha.php');
require_once '../modelo/Bitacora_refactorizada.php';
require '../modelo/GenerarListaDesplegable.php';
require_once '../modelo/Turno.php';
require_once '../modelo/Constantes.php';

require_once '../modelo/Maquina_refactorizada.php';
require_once '../modelo/SeccionMaquina.php';
require_once '../modelo/EquipoMaquina.php';
require_once '../modelo/ParteMaquina.php';

require_once '../modelo/Operador_refactorizado.php';
require_once '../modelo/Tiempo_Improductivo.php';

require_once '../modelo/UsuarioRefactorizado.php';

require_once ('../modelo/validar_usuario.php');
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






    foreach ($_POST as $key => $numero) {

        if ($key == "maquina") {
            $maquina = (int) $numero;
        }

        if ($key == "seccion") {
            $seccion = (int) $numero;
        }

        if ($key == "equipo") {
            $equipo = (int) ($numero);
        }

        if ($key == "parte") {
            $parte_equipo = (int) ($numero);
        }

        if ($key == "operador") {
            $operador = (int) $numero;
        }


        if ($key == "hora") {
            $hora = (int) $numero;
        }

        if ($key == "minuto") {
            $minuto = (int) $numero;
        }




        if ($key == "origen") {
            $origen = (int) $numero;
        }

        if ($key == "causa") {
            $causa = (int) $numero;
        }

        if ($key == "titulo") {
            $titulo = (int) $numero;
        }



        if ($key == "detalle") {
            $detalle = strtoupper($numero);
        }
    }

    $id_empresa = $_SESSION['k_empresa'];









    $bitacora = new Bitacora_refacotirzada();
    $parteMaquina = new ParteMaquina();
    $TiempoImproductivo = new Tiempo_Improductivo();
    $TipoTiempo = new TipoTiempo_Improductivo();
    $ObjetoOperador = new Operador_refactorizado();
    $Usuario = new UsuarioRefactorizado();
    $turno = new Turno();
    $cap = new Captchap();
    $fecha = new Fecha('', '');
    $ObjetoHora = new Reloj($hora, $minuto);
    $cap->verifyFormToken('rg_bitacora_2');
    $bitacora->setIdEmpresa($_SESSION['k_empresa']);

    $id_ot = ''; /* representa el id de una ot */
    $titulo_vista = '';

    $Usuario->setNombreUsuario($_SESSION['k_userName']);


    $turno->setIdEmpresa($_SESSION['k_empresa']);
    $turno->setTurno();



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

    $_SESSION['maquina'] = $maquina;


    $bitacora->setIdMaquina($parteMaquina->getIdMaquina());
    $bitacora->setIdSeccion($parteMaquina->getIdSeccion());
    $bitacora->setIdEquipo($parteMaquina->getIdEquipo());
    $bitacora->setIdParteEquipo($parteMaquina->getIdparteMaquina());



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

    $_SESSION['operador'] = $operador;



    $bitacora->setIdOperador($ObjetoOperador->getIdOperador());




    /* solo el usuario ext puede reportar mas de 8 horas */
    if (($_SESSION['k_userName']) != strtoupper('EXT')) {

        $ObjetoHora->isHoraFueraDeRango();
    }



    $ObjetoHora->isMinutoFueraDeRango();
    $ObjetoHora->convertirHorasToMinutos();

    $bitacora->setTiempoImproductivo($ObjetoHora->getTotalTiempo());





    $bitacora->setDetalle($detalle);
    $bitacora->setNombreUsuario($Usuario->getNombreUsuario());
    $bitacora->setIdTurno($turno->getTurno());






    /**
     * solo extrusion pude registrar mas de 8 horas por turno,
     * 
     */
    if (($_SESSION['k_userName']) != strtoupper('EXT')) { /* consultar pagina simple o completa */

        $bitacora->isTiempoDeOchoHorasPorTurno();
        $bitacora->next_result();
    }


    $bitacora->registrarTiempoImproductivo();
    $id_bitacora = $bitacora->optenerUltimoConsecutivoRegistrado();

    $bitacora->crearOTAutomatica();
    $id_ot = $bitacora->optenerUltimoConsecutivoRegistrado();
    $bitacora->relacionarOTtimpo($id_bitacora, $id_ot);



    /* aqui va el codigo que crea la ot automatica */

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


    if ($_SESSION['k_userName'] == 'FORMADO') {



        mensajeParaOperadores('PRODUJO UNIDADES EN SU TURNO?', '', $mensaje = '<div class="cointaner text-center"> 
        <div> '
                . '<button  onclick="pesaje_produccion()" class="btn btn-lg btn-primary " title="Pesaje Produccion" type="submit"> <span class="glyphicon glyphicon-th-large">SI</span></button>'
                . '<button  onclick="autoPesajeCeroProduccion()" class="btn btn-lg btn-primary " title="Pesaje Produccion" type="submit"> <span class="glyphicon glyphicon-th-large">NO</span></button>'
                . '</div>
    </div>');
    }



    require_once '../vista/MostrarRegistroTiempoImprductivo.php';
} else {
    echo("<script>alert('Usted no esta logiado, ingrese para despues ejecutar la opcion de registro!!')</script>");
    raiz();
    exit();
}
?>



