<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of auto_complete_maquina
 *
 * @author Rocha
 */

require_once '../modelo/auto_complete.php';
require_once '../modelo/validar_usuario.php';
validar_user();

$au = new auto_complete(); 


 if (!isset($_GET['term'])) {
            $ficha = '';
        } else {
            $ficha = ($_GET['term']);
        }
        
         
        
            
        $consulta=$au->listadoEquipo($ficha);
        $field = $au->field_count;
        
        $array = $au->llenarArrayFect($consulta);
        
      
     
        
        
     echo json_encode($array);
    

?>
