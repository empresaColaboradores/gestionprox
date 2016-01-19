<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of FormularioCompleto
 *
 * @author Rocha
 */
class FormularioCompleto  implements FormularioInterfaz{
    
   

    public function getFormularioSegunMaquina() {
        
    }

    public function showFormulario() {
         echo '<div class="form-group">
                        <label for="exampleInputPassword1">Equipo</label>
                        <select id="equipo"  onclick="cargar_parte_equipo();" name="equipo" class="form-control">
                            <option value="0">Selecciona Uno...</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">Parte que falla</label>

                        <select id="parte" name="parte" class="form-control">
                            <option value="0">Selecciona Uno...</option>
                        </select>
                    </div>';
        
    }

}
