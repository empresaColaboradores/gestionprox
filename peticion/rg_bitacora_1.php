<?php
if (!isset($_SESSION)) {
    session_start();
}

/*
 * registro de bitacora simple
 * solo se registrara el operador, la maquina 
 * detalle y kw/h consumido en el turno
 */

require_once('../modelo/captcha.php');
$cp = new Captchap();
$token = $cp->captchat('rg_bitacora_1');


require_once '../modelo/validar_usuario.php';
?>

<head>






    <script language="javascript" src="script/submitAjax.js"></script>
    <script language="javascript" src="script/valida_campos_bitacora.js"></script>
    <script language="javascript" src="script/Bitatoca_crearListaDesplegable.js"></script> 


</head>

<div class="container">
    <div class=" row">
        <div class="col-md-4 ol-md-offset-4" > </div>

        <div class="col-md-4">


            <form role="form" id="rg_bitacora_1" action="controlador/rg_OrdenProduccion_Reportar_Tiempo_Improductivo_controller_1.php" method="post" >
                <h3 class="text-center"> REGISTRO  <small>BITACORA</small></h3>



                <div class="form-group">
                    <label for="exampleInputPassword1">Maquina</label>

                    <select id="maquina" name="maquina" class="form-control">
                        <option value="0">Selecciona Uno...</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="exampleInputPassword1">Operador</label>
                    <select id="operador" name="operador" class="form-control">

                        <option value="0">Selecciona Uno...</option>
                    </select>

                </div>

             

                

            


                <div class="form-group">
                    <label for="exampleInputPassword1">Detalle</label>
                    <textarea class="form-control alphaNumber" rows="3" name="detalle"  maxlength="999" required></textarea>
                    <input type="hidden" class="form-control"  maxlength="999" name="captchat"  value='<?php echo $token; ?>'>
                </div>





                
                
                <button class="btn btn-lg btn-primary btn-block" type="submit">Registrar</button>
            </form>






        </div> <!-- fin class columna -->



    </div> <!-- fin row-->

</div>