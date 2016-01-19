<?php

include '../modelo/Bitacora.php';
include '../modelo/Paginacion.php';
require_once ('../modelo/validar_usuario.php');
require_once '../modelo/raiz_directorio_principal.php';
require_once ('../modelo/modal_consulta.php');
require_once('../modelo/Table.php');
?>


<?php


if (validar_user()) {

  


     if (!isset($_GET['id'])) {
        $fecha = '';
    } else {
        $fecha = ($_GET['id']);
    }
    
    if (!isset($_GET['turno'])) {
        $turno = '';
    } else {
        $turno = ($_GET['turno']);
    }
    
    if (!isset($_GET['maquina'])) {
        $maquina = '';
    } else {
        $maquina = ($_GET['maquina']);
    }
    
   














    $id_empresa = $_SESSION['k_empresa'];
    
    $bitacora = new Bitacora();
    $paginacion = new Paginacion();
    $css='';
     $bitacora->setIdEmpresa($_SESSION['k_empresa']);
     

      $fecha=strtotime($fecha);

      $dia = date('d',$fecha);
      $mes = date('m',$fecha);
      $annio = date('Y',$fecha);
     
      

  
    $consulta = $bitacora->consultaCausaBajaProductividad($annio,$mes,$dia,$maquina,$turno);
    $field = $bitacora->field_count-1;
    $mostrarConsulta = $consulta->num_rows;
    
    
    
    $tabla = new Table();
    $tabla->crearArraySimple($consulta, $field );
    
    
   

    
    if($mostrarConsulta==0){
            
              mensajeDeErrorModal($titulo='EL OPERADOR NO REALIZO EL REPORTE DE TURNO'
                       ,$subtitulo=''
                       ,$mensaje='');
                exit();
               
            
        }







    require_once '../vista/MostrarCausaQueGeneraronLaBajaProduccion.php';
} else {
    echo("<script>alert('Usted no esta logiado, ingrese para despues ejecutar la opcion de registro!!')</script>");
    raiz();
}
?>






