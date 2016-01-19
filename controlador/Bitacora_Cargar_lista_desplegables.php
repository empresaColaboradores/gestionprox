<?php

$op = $_GET['op'];

if (!isset($_GET['code'])) {
    $code = '';
} else {
    $code = ($_GET['code']);
}

if (!isset($_GET['code2'])) {
    $code2 = '';
} else {
    $code2 = ($_GET['code2']);
}

if (!isset($_GET['code3'])) {
    $code3 = '';
} else {
    $code3 = ($_GET['code3']);
}

if (!isset($_GET['maquina'])) {
    $maquina = '';
} else {
    $maquina = ($_GET['maquina']);
}

if ($op == 1) {
    require_once("../modelo/Bitacora.php");
    require_once ('../modelo/validar_usuario.php');
    $selects = new Bitacora();
    $selects->setidEmpresa($_SESSION['k_empresa']);
    $array = $selects->cargarOrigen($code);
    cargarArchivos($array);
}


if ($op == 2) {

    require_once("../modelo/Bitacora.php");
    require_once ('../modelo/validar_usuario.php');

    $selects = new Bitacora();
    $selects->setidEmpresa($_SESSION['k_empresa']);

    $consulta = $selects->consultarAreaUsuario();
    $selects->next_result();
    $num_total_registros = $consulta->num_rows;



    if ($num_total_registros == 1) {

        $array = $selects->cargarMaquinasSegunArea();
        cargarArchivos($array);
    } else {

        $array = $selects->cargarMaquinas();

        cargarArchivos($array);
    }
}


if ($op == 3) {

    require_once ('../modelo/validar_usuario.php');
    if (!validar_user()) {
        echo "1";
    } else {
        echo "2";
    }
}


if ($op == 4) {

    require_once("../modelo/Bitacora.php");
    require_once ('../modelo/validar_usuario.php');
    $selects = new Bitacora();
    $selects->setidEmpresa($_SESSION['k_empresa']);
    $selects->setCodigoBusqueda($code);
    $selects->setMaquina($maquina);
    $array = $selects->cargarCausas();
    cargarArchivos($array);
}


if ($op == 5) {

    require_once("../modelo/Bitacora.php");
    require_once ('../modelo/validar_usuario.php');
    $selects = new Bitacora();
    $selects->setidEmpresa($_SESSION['k_empresa']);
    $selects->setCodigoBusqueda($code);
    $array = $selects->cargarCausas();
    cargarArchivos($array);
}


if ($op == 6) {
    require_once("../modelo/Bitacora.php");
    require_once ('../modelo/validar_usuario.php');
    $selects = new Bitacora();
    $selects->setidEmpresa($_SESSION['k_empresa']);
    $array = $selects->cargarOrigen_b();
    cargarArchivos($array);
}

if ($op == 7) {

    require_once("../modelo/Bitacora.php");
    require_once ('../modelo/validar_usuario.php');
    $selects = new Bitacora();
    $selects->setidEmpresa($_SESSION['k_empresa']);
    $selects->setCodigoBusqueda($code);
    $array = $selects->cargarCausas_b();
    cargarArchivos($array);
}


if ($op == 8) {

    require_once("../modelo/Bitacora.php");
    require_once ('../modelo/validar_usuario.php');
    $selects = new Bitacora();
    $selects->setidEmpresa($_SESSION['k_empresa']);
    $array = $selects->cargarTipoRollo();
    cargarArchivos($array);
}


if ($op == 9) {

    require_once("../modelo/Bitacora.php");
    require_once ('../modelo/validar_usuario.php');
    $selects = new Bitacora();
    $selects->setCodigoBusqueda($code);
    $selects->setidEmpresa($_SESSION['k_empresa']);

    $array = $selects->cargarListadoOperadoreSeMaquinaSeleccionada();
    cargarArchivos($array);
}



if ($op == 10) {

    require_once("../modelo/Bitacora.php");
    require_once ('../modelo/validar_usuario.php');
    $selects = new Bitacora();
    $selects->setidEmpresa($_SESSION['k_empresa']);
    $array = $selects->cargarListadores();
    cargarArchivos($array);
}


if ($op == 11) {

    require_once("../modelo/Bitacora.php");
    require_once ('../modelo/validar_usuario.php');
    $selects = new Bitacora();
    $selects->setidEmpresa($_SESSION['k_empresa']);

    $array = $selects->cargarListaOrigen();
    cargarArchivos($array);
}


if ($op == 12) {

    require_once("../modelo/Bitacora.php");
    require_once ('../modelo/validar_usuario.php');
    $selects = new Bitacora();
    $selects->setidEmpresa($_SESSION['k_empresa']);

    $selects->setCodigoBusqueda($code);
    $array = $selects->cargarListaCausas();
    cargarArchivos($array);
}



if ($op == 13) {

    require_once("../modelo/Bitacora.php");
    require_once ('../modelo/validar_usuario.php');
    $selects = new Bitacora();
    $selects->setidEmpresa($_SESSION['k_empresa']);
    $array = $selects->cargarListaCausas_busquedas();
    cargarArchivos($array);
}




if ($op == 14) {
    require_once("../modelo/Bitacora.php");
    require_once ('../modelo/validar_usuario.php');
    $selects = new Bitacora();
    $selects->setidEmpresa($_SESSION['k_empresa']);
    $array = $selects->cargar_seccion_maquina($code);

    cargarArchivos($array);
}




if ($op == 15) {
    require_once("../modelo/Bitacora.php");
    require_once ('../modelo/validar_usuario.php');
    $selects = new Bitacora();
    $selects->setidEmpresa($_SESSION['k_empresa']);
    $array = $selects->cargar_equipo_maquina2($code, $code2);
    cargarArchivos($array);
}



if ($op == 16) {
    require_once("../modelo/Bitacora.php");
    require_once ('../modelo/validar_usuario.php');
    $selects = new Bitacora();
    $selects->setidEmpresa($_SESSION['k_empresa']);
    $array = $selects->cargar_seccion($code);
    cargarArchivos($array);
}



if ($op == 17) {
    require_once("../modelo/Bitacora.php");
    require_once ('../modelo/validar_usuario.php');
    $selects = new Bitacora();
    $selects->setidEmpresa($_SESSION['k_empresa']);
    $array = $selects->cargar_parte_equipo($code, $code2, $code3);
    cargarArchivos($array);
}



if ($op == 18) {
    require_once("../modelo/Bitacora.php");
    require_once ('../modelo/validar_usuario.php');
    $selects = new Bitacora();
    $selects->setidEmpresa($_SESSION['k_empresa']);
    $array = $selects->cargar_equipo();
    cargarArchivos($array);
}


if ($op == 19) {
    require_once("../modelo/Bitacora.php");
    require_once ('../modelo/validar_usuario.php');
    $selects = new Bitacora();
    $selects->setidEmpresa($_SESSION['k_empresa']);
    $array = $selects->cargar_parte_equipo2();
    cargarArchivos($array);
}


if ($op == 20) {

    require_once("../modelo/Bitacora.php");
    require_once ('../modelo/validar_usuario.php');
    $selects = new Bitacora();
    $selects->setidEmpresa($_SESSION['k_empresa']);
    $selects->setCodigoBusqueda($code);
    $array = $selects->cargarCausasSegunOrigen_b();
    cargarArchivos($array);
}

if ($op == 21) {

    require_once("../modelo/Bitacora.php");
    require_once ('../modelo/validar_usuario.php');
    $selects = new Bitacora();
    $selects->setidEmpresa($_SESSION['k_empresa']);
    $selects->setCodigoBusqueda($code);
    $array = $selects->cargarTecnicos();
    cargarArchivos($array);
}



if ($op == 22) {

    require_once("../modelo/Bitacora.php");
    require_once ('../modelo/validar_usuario.php');
    $selects = new Bitacora();
    $selects->setidEmpresa($_SESSION['k_empresa']);
    $selects->setCodigoBusqueda($code);
    $array = $selects->cargarTipoMateriales();
    cargarArchivos($array);
}

if ($op == 23) {

    require_once('../modelo/Database.php');
    require_once('../modelo/FormularioDinamico.php');

    $formulario = new FormularioDinamico();
    $formulario->setIdEmpresa(($_SESSION['k_empresa']));
    $formulario->setPerfilFormularioSegunUsuario($_SESSION['k_userName']);
    $formulario->getFormularioSegunUsuario();
}



if ($op == 24) {

    require_once('../modelo/Database.php');
    require_once('../modelo/FormularioDinamico.php');

    $formulario = new FormularioDinamico();
    $formulario->setIdEmpresa(($_SESSION['k_empresa']));
    $formulario->setPerfilFormularioSegunUsuario($_SESSION['k_userName']);
    $formulario->getFormularioParaPesarProduccion();
}

if ($op == 25) {
    require_once("../modelo/Area_refactorizada.php");
    require_once ('../modelo/validar_usuario.php');
    $selects = new Area_refactorizada();
    $selects->setidEmpresa($_SESSION['k_empresa']);
    $array = $selects->cargar_area();
    cargarArchivos($array);
}

if ($op == 26) {
    require_once("../modelo/Database.php");
    require_once("../modelo/GenerarListaDesplegable.php");
    require_once("../modelo/UsuarioRefactorizado.php");
    require_once ('../modelo/validar_usuario.php');
    $selects = new UsuarioRefactorizado();
    $selects->setidEmpresa($_SESSION['k_empresa']);
    $array = $selects->cargar_usuario();
    cargarArchivos($array);
}

if ($op == 27) {

    require_once ('../modelo/Database.php');
    require_once ('../modelo/GenerarListaDesplegable.php');
    require_once("../modelo/Maquina_refactorizada.php");
    require_once ('../modelo/validar_usuario.php');
    $selects = new Maquina_refactorizada();
    $selects->setidEmpresa($_SESSION['k_empresa']);
    $array = $selects->cargar_maquinas();
    cargarArchivos($array);
}

if ($op == 28) {

    require '../modelo/Database.php';
    require '../modelo/GenerarListaDesplegable.php';
    require '../modelo/Turno.php';
    require_once ('../modelo/validar_usuario.php');
    $turno = new Turno();
    $turno->setidEmpresa($_SESSION['k_empresa']);
    $array = $turno->getListadoDeTurno();
    cargarArchivos($array);
}


if ($op == 29) {

    require '../modelo/Database.php';
    require '../modelo/GenerarListaDesplegable.php';
    require '../modelo/Hora.php';
    require_once ('../modelo/validar_usuario.php');

    $hora = new Reloj(0, 0);
    $database = new Database();
    $generarListadoDesplegable = new GenerarListaDesplegable();
    $hora->setIdEmpresa($_SESSION['k_empresa']);
    $consulta = $database->query($hora->getListadoDeTiempoProductivo());
    $array = $generarListadoDesplegable->generarListadoDesplegable($consulta, 'id', 'tiempo_laboral');
    cargarArchivos($array);
}


if ($op == 30) {

    require '../modelo/Database.php';
    require '../modelo/GenerarListaDesplegable.php';
    require '../modelo/Produccion.php';
    require_once ('../modelo/validar_usuario.php');

    $produccion = new Produccion();
    $generarListadoDesplegable = new GenerarListaDesplegable();
    $produccion->setIdEmpresa($_SESSION['k_empresa']);
    $consulta = $produccion->getListado_unidadDeMedidaPrincipal();
    $array = $generarListadoDesplegable->generarListadoDesplegable($consulta, 'id', 'nombre');
    cargarArchivos($array);
}


if ($op == 31) {
    require_once("../modelo/Database.php");
    require_once("../modelo/GenerarListaDesplegable.php");
    require_once("../modelo/UsuarioRefactorizado.php");
    require_once ('../modelo/validar_usuario.php');
    $selects = new UsuarioRefactorizado();
    $selects->setidEmpresa($_SESSION['k_empresa']);
    $array = $selects->cargar_usuarioPorCodigo();
    cargarArchivos($array);
}

if ($op == 32) {

    require '../modelo/Database.php';
    require '../modelo/GenerarListaDesplegable.php';
    require '../modelo/Produccion.php';
    require_once ('../modelo/validar_usuario.php');

    $produccion = new Produccion();
    $generarListadoDesplegable = new GenerarListaDesplegable();
    $produccion->setIdEmpresa($_SESSION['k_empresa']);
    $consulta = $produccion->getListado_unidadDeMedidaSecundaria();
    $array = $generarListadoDesplegable->generarListadoDesplegable($consulta, 'id', 'nombre');
    cargarArchivos($array);
}

function cargarArchivos($array) {

    foreach ($array as $key => $value) {
        echo "<option value=\"$key\">$value</option>";
    }
}

?>