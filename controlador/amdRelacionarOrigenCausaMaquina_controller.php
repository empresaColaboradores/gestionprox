
        <?php
      

        if (!isset($_SESSION)) {
            session_start();
        }
        
    
    require_once '../modelo/Defecto_Modelo.php';
     require_once ('../modelo/raiz_directorio_principal.php');
   require_once ('../modelo/validar_usuario.php');
        validar_user_amd();
        
 
   
    /**
     * se valida si el usuario  ha iniciado una seccion valida
     * para asi proceder con el resto de las funciones 
     */
  

        /*
         * se valida que todas las variables
         * esten inicializadas de lo contrario
         * se inicializa con una cadena vacia 
         * para evitar  un valor inesperado
         */
        if (!isset($_POST['maquina'])) {
            $maquina = '';
        } else {
            $maquina = ($_POST['maquina']);
        }

        if (!isset($_POST['origen'])) {
            $origen = '';
        } else {
            $origen = ($_POST['origen']);
        }
        
        
         if (!isset($_POST['causa'])) {
            $causa = '';
        } else {
            $causa = ($_POST['causa']);
        }






        

        /**
         * se crea objeto para manipular los datos 
         */
        $defecto = new Defecto();

        $defecto->setIdEmpresa(($_SESSION['k_empresa']));
        $defecto->setIdMaquina($maquina);
        $defecto->setIdOrigen($origen);
        $defecto->setIdCausa($causa);










         


            /************************************
             * Consulta repetido
             * ************************************
             */
            if (($defecto->consultarRelacionDefectoMaquinaCausa()->num_rows) <= 0) {


                $defecto->next_result();
                $defecto->relacionMaquinaOrigenCausa();
             

                /**
                 * consultar Origen maquina
                 */
                $consulta = $defecto->consultarMaquinaOrigenCausa();
                $field = $defecto->field_count;



                require_once '../vista/amd_MostrarMaquinaOrigenCausa.php';
                exit();
            } else {

                echo('<script>alert("el origen ya esta registrado en esta maquina seleccione otro")</script>');
                raiz_amd();
                exit();
            }
      
   
    ?>






