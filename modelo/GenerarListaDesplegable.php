<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of GenerarListaDesplegable
 *
 * @author Rocha
 */
class GenerarListaDesplegable {
    
    
    /**
     * 
     * @param type $consulta consulta generada previamente 
     * @param type $index1 valor del primer index
     * @param type $index2 contenido del array en el idex1
     * @return type
     */
    public function generarListadoDesplegable($consulta, $index1, $index2) {

        $vector = array();

        while ($array = $consulta->fetch_array(MYSQLI_ASSOC)) {
            $indice = $array[$index1];
            $name = $array[$index2];
            $vector[$indice] = $name;
        }
        return $vector;
    }
    
}
