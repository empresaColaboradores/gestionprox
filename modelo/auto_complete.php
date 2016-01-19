<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

require_once 'Database.php';


/**
 * Description of auto_complete
 *
 * @author Rocha
 */
class auto_complete extends Database {
    //put your code here
    
     public function __construct() {
        parent::__construct();
    }

    public function __destruct() {
        parent::__destruct();
    }
    
    
    
     public function listadoEquipo($equipo){
         
         $empresa=($_SESSION['k_empresa']);
         return $this->query("CALL Bitacora_ListaDesplegableEquipo('$equipo','$empresa')");
         
        }
        
        public function consultarDefecto($termino){        
        return $this->query("CALL ListaDesplegableDefecto('$termino');");
        
        }
}






?>
