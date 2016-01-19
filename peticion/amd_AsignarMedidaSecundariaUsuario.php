<?php
if (!isset($_SESSION)) {
    session_start();
}

require_once ('../modelo/validar_usuario.php');
validar_user_amd();
?>

<head>
 <script language="javascript" src="../script/submitAjax.js"></script>
 <script language="javascript" src="../script/admin.js"></script>
 <script language="javascript" src="../script/asignarMedidaDeProduccionSecundaria.js"></script>    
    
   
</head>

<div class="container">
    <div class=" row">
        <div class="col-md-4 ol-md-offset-4" > </div>

        <div class="col-md-4">


            <form role="form" id="amd_maquina_origen" action="../controlador/amdAsignarMedidaSecundariaAMaquina_controller.php"  method="post" >
                <h3 class="text-center"> ASIGNAR MEDIDA DE PRODUCCION <small>SECUNDARIA </small></h3>

                
             


               <div class="form-group">
                    <label for="exampleInputPassword1">Maquina</label>

                    <select id="maquina" name="id_maquina" class="form-control">
                        <option value="0">Selecciona Uno...</option>
                    </select>
                </div>
                
                 <div class="form-group">
                    <label for="exampleInputPassword1">Unidad de Produccion Secundaria</label>

                    <select id="secondUnit" name="unidadMedida" class="form-control">
                        <option value="0">Selecciona Uno...</option>
                    </select>
                </div>
                
                



                <button type="submit" class="btn btn-primary">Submit</button>
            </form>






        </div> <!-- fin class columna -->



    </div> <!-- fin row-->

</div>