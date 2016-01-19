<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of FormularioSimple
 *
 * @author Rocha
 */
class FormularioSimple  implements FormularioInterfaz{
     
   

    public function getFormularioSegunMaquina() {
        
    }

    public function showFormulario() {
        
         echo '<input type="hidden" class="form-control"  name="equipo"  value=\'12\'>
                <input type="hidden" class="form-control"  name="parte"   value=\'11\'>';
        
    }

}
