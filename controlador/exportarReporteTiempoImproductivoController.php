
<?php

include '../modelo/Bitacora.php';
require_once ('../modelo/validar_usuario.php');
require_once '../modelo/raiz_directorio_principal.php';
require_once ('../modelo/modal_consulta.php');
require_once('../modelo/Table.php');
?>


<?php


if (validar_user()) {

  








   





    
      
        if (!isset($_GET['excel'])) {
            $exportar = '';
        } else {
            $exportar = ($_GET['excel']);
        }






    $bitacora = new Bitacora();
   

    $bitacora->setIdEmpresa($_SESSION['k_empresa']);
    

     $fecha_inicial = $_SESSION['fecha_inicial'];
    $fecha_final = $_SESSION['fecha_final'];
    $maquina = $_SESSION['maquina'];
    $origen = $_SESSION['origen'];
    $causa = $_SESSION['causa'];
    $detalle = $_SESSION['detalle'];
    $operador = $_SESSION['operador'];
    $equipo = $_SESSION['equipo'];
    $ficha = $_SESSION['ficha'];
    $op = $_SESSION['op'];
    
    
    






    $id_empresa = $_SESSION['k_empresa'];


    if (!($fecha_final > $fecha_inicial)) {

        echo("<script>alert('La fecha final debe ser mayor que la inicial!!')</script>");
        raiz();
        exit();
    }




    

     $consulta = $bitacora->exportarTiempoImproductivoExcell2($maquina, $operador, $origen, $causa,$detalle, $fecha_inicial, $fecha_final,$ficha,$op);
    $field = $bitacora->field_count-1;
    $mostrarConsulta = $consulta->num_rows;
    
      $tabla = new Table();
    $tabla->crearArraySimple($consulta, $field);
    
    



    
    if($mostrarConsulta==0){
            
               mensajeDeErrorModal($titulo='LA CONSULTA NO ARROJO RESULTADOS'
                       ,$subtitulo='Seleccione un valor valido para la consulta'
                       ,$mensaje='Para un mejor resultado , intente con otros valores de busqueda');
                exit();
            
        }






    






    if ($exportar == 'excell') {

        require_once '../vista/exportarRegistroTimpoImproductivoExcell.php';
    } else if ($exportar == '') {
        require_once '../vista/bitacoraRegistro_vista.php';
    } else {
        echo("<script>alert('Accion invalida no se puede exportar el archivo!!')</script>");
        echo('<script>location.href="../index.php;"</script>');
    }
} else {
    echo("<script>alert('Usted no esta logiado, ingrese para despues ejecutar la opcion de registro!!')</script>");
    raiz();
}
?>






