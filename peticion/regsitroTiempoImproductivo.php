<?php
if (!isset($_SESSION)) {
    session_start();
}


require_once '../modelo/validar_usuario.php';
require_once('../modelo/captcha.php');
$cp = new Captchap();
$token = $cp->captchat('rg_bitacora_2');

require_once('../modelo/Database.php');
require_once('../modelo/FormularioDinamico.php');
$formulario = new FormularioDinamico();
$formulario->setIdEmpresa(($_SESSION['k_empresa']));

?>




<head>
    <script language="javascript" src="script/submitAjax.js"></script>
    <script language="javascript" src="script/Bitatoca_crearListaDesplegable.js"></script> 
    <script language="javascript" src="script/valida_campos_bitacora.js"></script>
    <script language="javascript" src="script/FormularioDinamico.js"></script>
    <script language="javascript" src="script/bootbox.min.js"></script>
    <script language="javascript" src="script/validaRegistroTiempoImproductivo.js"></script>
    
</head>


<div class="container">
    <div class=" row">
        <form role="form" id="rg_bitacora" action="controlador/registrarTiempoImproductivo.php" method="post" >
            <h3 class="text-center"> REGISTRO TIEMPO <small>IMPRODUCTIVO</small> </h3>


            <div class="col-md-3 ol-md-offset-2" > </div>
            <div class="col-md-3 ol-md-offset-2" >

                <div class="form-group">
                    <label for="exampleInputPassword1">Maquina</label>
                    <select id="maquina" name="maquina" class="form-control">
                  <?php echo $formulario->getOptionValue();?>
                    </select>
                </div>


                <div class="form-group">
                    <label for="exampleInputPassword1">Seccion</label>

                    <select id="seccion" name="seccion" class="form-control">
                        <option value="0">Selecciona Uno...</option>
                    </select>
                </div>
                
                 <div class="form-group" id="dinamico">
                   
                </div>



                <div class="form-group form-inline">


                    <label for="exampleInputPassword1">Tiempo Improductivo</label>




                    <div class="form-group form-inline">


                        <label for="exampleInputPassword1">Hora</label>
                        <input type="text" class="form-control form-inline onlyNumbers" size="2" maxlength="2" name="hora" required placeholder="Hora">
                        <label for="exampleInputPassword1">Minuto</label>
                        <input type="text" class="form-control form-inline onlyNumbers" size="2" maxlength="2" name="minuto" required placeholder="Minuto">

                    </div>

                </div>




            </div>

            <div class="col-md-3 ol-md-offset-2" >




                <div class="form-group">
                    <label for="exampleInputPassword1">Operador</label>
                    <select id="operador" name="operador" class="form-control">

                        <option value="0">Selecciona Uno...</option>
                    </select>

                </div>







                <div class="form-group">
                    <label for="exampleInputPassword1">Causa</label>
                    <select id="origen" name="origen" class="form-control">

                        <option value="0">Selecciona Uno...</option>
                    </select>

                </div>


                <div class="form-group">
                    <label for="exampleInputPassword1">Tipo</label>
                    <select id="causa" name="causa" class="form-control">

                        <option value="0">Selecciona Uno...</option>
                    </select>

                </div>

                <div class="form-group">
                    <label for="exampleInputPassword1">Descripcion de Falla</label>
                    <textarea class="form-control alphaNumber" rows="3" name="detalle"  maxlength="999" required></textarea>
                    <input type="hidden" class="form-control"  maxlength="999" name="captchat"  value='<?php echo $token; ?>'>
                </div>


               <button class="btn btn-lg btn-primary btn-block" id="enviar" type="submit"><span  style="font-size:32px"class="glyphicon glyphicon-thumbs-up"></span></button>





            </div>

            <div class="col-md-3 ol-md-offset-2" >


            </div>












        </form>

    </div> <!-- fin row-->

</div>