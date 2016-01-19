
<?php

include '../modelo/Bitacora.php';
require_once ('../modelo/validar_usuario.php');
require_once '../modelo/raiz_directorio_principal.php';
require_once ('../modelo/modal_consulta.php');
?>


<?php


if (validar_user()) {

  


     if (!isset($_GET['id'])) {
        $id = '';
    } else {
        $id = ($_GET['id']);
    }









   





    $id_empresa = $_SESSION['k_empresa'];
    
    $bitacora = new Bitacora();
    
    $css='';
     $bitacora->setIdEmpresa($_SESSION['k_empresa']);
     
     
     
    $consulta = $bitacora->consultarEstadoOT($id);
    $bitacora->next_result();

    if (($consulta->num_rows) <= 0) {

        mensajeDeErrorModal($titulo = 'LA ORDEN ESTA CERRADA NO SE PUEDE EDITAR'
                , $subtitulo = 'No es posible su modificacion'
                , $mensaje = 'Si requiere editar esta orden, por favor coloquese en conctacto con el Jefe de Mantenimiento');
        exit();
    }

     




  
    $consulta = $bitacora->consultarOTid($id);
    $field = $bitacora->field_count;
    $mostrarConsulta = $consulta->num_rows;
    
    
    $row = $consulta->fetch_array(MYSQLI_ASSOC);

        $fecha_ot = $row['fecha'];
        $ob_op = $row['descripcion_fall'];
        $estado = $row['estado'];
        $id_ot = $row['id'];
        
        if($estado==0){
            $css='readonly';
        }
        
        
        

        $_SESSION['k_make_new_company'] = $id_empresa;


    
    if($mostrarConsulta==0){
            
              mensajeDeErrorModal($titulo='LA ORDEN  NO EXISTE '
                       ,$subtitulo='No es posible su modificacion'
                       ,$mensaje='Si requiere editar esta orden, por favor coloquese en conctacto con el Jefe de Mantenimiento');
                exit();
                exit();
            
        }







    require_once '../vista/set_ot.php';
} else {
    echo("<script>alert('Usted no esta logiado, ingrese para despues ejecutar la opcion de registro!!')</script>");
    raiz();
}
?>






