
        <?php
     
        include '../modelo/Bitacora.php';
        include '../modelo/Paginacion.php';
        require_once ('../modelo/validar_usuario.php');
        require_once '../modelo/raiz_directorio_principal.php';
        ?>










    <?php
  
    if (validar_user()) {

     


        if (empty($fecha_inicial)) {
            $fecha_inicial = '1985-01-01';
        }

        if (empty($nuevafecha)) {
            $fecha_final = date("Y-m-d");


            $nuevafecha = strtotime('+1 day', strtotime($fecha_final));
            $nuevafecha = date('Y-m-d', $nuevafecha);
        }


        if (!isset($_SESSION['maquina'])) {
            $maquina = '';
        } else {
            $maquina = ( $_SESSION['maquina']);
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


         if (!isset($_SESSION['maquina'])) {
            $maquina = '';
        } else {
            $maquina = ($_SESSION['maquina']);
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




        $bitacora->setIdEmpresa($_SESSION['k_empresa']);


        if (!($nuevafecha > $fecha_inicial)) {

            echo("<script>alert('La fecha final debe ser mayor que la inicial!!')</script>");
            raiz();
            exit();
        }







        $consulta = $bitacora->consultarHistorialBitacora_registro($maquina, $operador, $detalle, $fecha_inicial, $nuevafecha, '');
        $field = $bitacora->field_count;
        $bitacora->next_result();


        if ($exportar == 'excell') {

            require_once '../vista/bitacoraMostrarRegistro_Excell_2.php';
        } else if ($exportar == '') {
            require_once '../vista/bitacoraRegistro_vista.php';
        } else {
            echo("<script>alert('Accion invalida no se puede exportar el archivo!!')</script>");
        raiz();
        exit();
        }
    } else {
        echo("<script>alert('Usted no esta logiado, ingrese para despues ejecutar la opcion de registro!!')</script>");
      raiz();
        exit();
    }
    ?>






