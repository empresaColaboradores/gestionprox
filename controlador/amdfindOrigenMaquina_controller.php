       <?php
       

        if (!isset($_SESSION)) {
            session_start();
        }


        require_once ('../modelo/validar_usuario.php');
        validar_user_amd();
        
  
        require_once '../modelo/Defecto_Modelo.php';
        require_once ('../modelo/raiz_directorio_principal.php');
    
    ?>




    







    <?php
    
   
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




        $defecto = new Defecto();

        $defecto->setIdEmpresa(($_SESSION['k_empresa']));
        
        $maquina= $defecto->crearConsultalike($maquina);
        $origen= $defecto->crearConsultalike($origen);
    


               
              
             

                $consulta = $defecto->listarMaquinaOrigenCausa($maquina,$origen);
                $field = $defecto->field_count;



                require_once '../vista/amd_MostrarMaquinaOrigenCausa.php';
                exit();
            
       
        
    

    
    ?>






