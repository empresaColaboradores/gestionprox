
        <?php
       
       
        include '../modelo/Bitacora.php';
        
        require_once ('../modelo/validar_usuario.php');
        require_once '../modelo/raiz_directorio_principal.php';
        require_once ('../modelo/modal_consulta.php');
        ?>



  








    <?php
    
    if (validar_user()) {

       


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

        if (!isset($_SESSION['maquina'])) {
            $maquina = '';
        } else {
            $maquina = ( $_SESSION['maquina']);
        }

        if (!isset($_SESSION['origen'])) {
            $origen = '';
        } else {
            $origen = ( $_SESSION['origen']);
        }
        if (!isset($_SESSION['causa'])) {
            $causa = '';
        } else {
            $causa = ($_SESSION['causa']);
        }

        if (!isset($_SESSION['detalle'])) {
            $detalle = '';
        } else {
            $detalle = ($_SESSION['detalle']);
        }

        if (!isset($_SESSION['operador'])) {
            $operador = '';
        } else {
            $operador = ($_SESSION['operador']);
        }

        if (!isset($_GET['excel'])) {
            $exportar = '';
        } else {
            $exportar = ($_GET['excel']);
        }






        $bitacora = new Bitacora();
      
        $bitacora->setIdEmpresa($_SESSION['k_empresa']);







        if (empty($fecha_inicial)) {
            $fecha_inicial = '1985-01-01';
        }

        if (empty($fecha_final)) {
            $fecha_final = date("Y-m-d");


            $nuevafecha = strtotime('+1 day', strtotime($fecha_final));
            $nuevafecha = date('Y-m-d', $nuevafecha);

            $fecha_final = $nuevafecha;
        }




        if (!($fecha_final > $fecha_inicial)) {

            echo("<script>alert('La fecha final debe ser mayor que la inicial!!')</script>");
            raiz();
        }

        $id_empresa = $_SESSION['k_empresa'];


 




        $consulta = $bitacora->exportarTiempoImproductivoExcell($maquina, $operador, $equipo, $origen, $causa, $detalle, $fecha_inicial, $fecha_final);
        $field = $bitacora->field_count;
     

       
       


        if ($exportar == 'excell') {

            require_once '../vista/bitacoraMostrarRegistro_Excell_1.php';
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






