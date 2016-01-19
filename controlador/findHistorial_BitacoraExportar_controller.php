
        <?php
     
        include '../modelo/Bitacora.php';
        include '../modelo/Paginacion.php';
        require_once ('../modelo/validar_usuario.php');
        require_once '../modelo/raiz_directorio_principal.php';
        
   
    if (validar_user()) {

       



        if (!isset(   $_SESSION['ficha'])) {
            $ficha = '';
        } else {
            $ficha = ($_SESSION['ficha']);
        }

        if (!isset($_SESSION['usuario'])) {
            $usuario = '';
        } else {
            $usuario = ($_SESSION['usuario']);
        }

        if (!isset( $_SESSION['maquina'])) {
            $maquina = '';
        } else {
            $maquina = ( $_SESSION['maquina']);
        }



        if (!isset($_SESSION['op'])) {
            $op = '';
        } else {
            $op = ($_SESSION['op']);
        }


        if (!isset($_SESSION['detalle'])) {
            $detalle = '';
        } else {
            $detalle = ($_SESSION['detalle']);
        }

         
      

        if (!isset($_SESSION['fecha_inicial'])) {
            $fecha_inicial = '';
        } else {
            $fecha_inicial = ($_SESSION['fecha_inicial']);
        }


        if (!isset($_SESSION['fecha_final'])) {
            $fecha_final = '';
        } else {
            $fecha_final = ($_SESSION['fecha_final']);
        }

        if (!isset( $_SESSION['defecto'])) {
            $defecto = '';
        } else {
            $defecto = ( $_SESSION['defecto']);
        }

        if (!isset($_SESSION['causa'])) {
            $causa = '';
        } else {
            $causa = ($_SESSION['causa']);
        }
        
        if (!isset($_GET['excel'])) {
            $exportar = '';
        } else {
            $exportar = ($_GET['excel']);
        }






        $bitacora = new Bitacora();
       



        if ($defecto == 0) {
            $defecto = '';
        }

        if ($maquina == '0') {
            $maquina = '';
        }

        if ($causa == 0) {
            $causa = '';
        }

        
      
      


        if (empty($fecha_inicial)) {
            $fecha_inicial = '1985-01-01';
        }

        if (empty($fecha_final)) {
            $fecha_final = date("Y-m-d");
        }





        if (!($fecha_final > $fecha_inicial)) {

            echo("<script>alert('La fecha final debe ser mayor que la inicial!!')</script>");
            raiz();
        }
        
         $id_empresa = $_SESSION['k_empresa'] ;
         
          /*datos opcionales*/
        $formula=$_SESSION['formula'] ;
        $ancho=$_SESSION['ancho'] ;
        $calibre=$_SESSION['calibre'] ;
        $densidad=$_SESSION['densidad'] ;
        /*fi datos opcionales*/

        
        

       

        
        
        $consulta = $bitacora->consultarHistorialBitacoraTiempoImproductivo($ficha, $usuario, $maquina, $op, $detalle, $defecto, $causa, $fecha_inicial, $fecha_final, '',$ancho,$calibre,$densidad,$formula,$id_empresa);
        $field = $bitacora->field_count;
        $bitacora->next_result();


        
        $consultaConsolidadoTimpProduccion = $bitacora->consultaTotalizadoHorasimproductivas($ficha, $usuario, $maquina, $op, $detalle, $defecto,$causa, $fecha_inicial, $fecha_final, '',$ancho,$calibre,$densidad,$id_empresa);
        $columnasConsolidadoTimpProduccion = $bitacora->field_count - 1;
        $mostarConsolidadoTimpProduccion = $consultaConsolidadoTimpProduccion->num_rows;
        $bitacora->next_result();


       
        $consultaDetalleTimpProduccion = $bitacora->consultaDetalleHorasimproductivas($ficha, $usuario, $maquina, $op, $detalle, $defecto, $causa, $fecha_inicial, $fecha_final,$ancho,$calibre,$densidad,$id_empresa);
        $columnasDetalleTimpProduccion = $bitacora->field_count - 1;
        $mostarDetalleTimpProduccion = $consultaDetalleTimpProduccion->num_rows;
        $bitacora->next_result();






      

        
         if ($exportar == 'excell') {

            require_once '../vista/bitacoraMostrarRegistro_Excell.php';
        } else if ($exportar == '') {
            require_once '../vista/bitacoraRegistro_vista.php';
        } else {
            echo("<script>alert('Accion invalida no se puede exportar el archivo!!')</script>");
            echo('<script>location.href="../index.php;"</script>');
        }

       
    } else {
        echo("<script>alert('Usted no esta logiado, ingrese para despues ejecutar la opcion de registro!!')</script>");
        echo('<script>location.href="../index.php;"</script>');
        exit();
    }
    ?>






