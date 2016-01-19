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
class FormularioBasico implements FormularioInterfaz {

    public function getFormularioSegunMaquina() {
        
    }

    public function showFormulario() {
        echo '
                    <div class="form-group">
                        <label for="exampleInputPassword1">Equipo</label>
                        <select id="equipo"  onclick="cargar_parte_equipo();" name="equipo" class="form-control">
                            <option value="0">Selecciona Uno...</option>
                        </select>
                    </div>
                <input type="hidden" class="form-control"  name="parte"  value=\'11\'>';
    }

}
