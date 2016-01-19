<?php
if (!isset($_SESSION)) {
    session_start();
}


require_once('../modelo/captcha.php');
$cp = new Captchap();
$token = $cp->captchat('pesajeProduccion');
require_once '../modelo/validar_usuario.php';
require '../modelo/Database.php';
require_once('../modelo/FormularioDinamico.php');
$formulario = new FormularioDinamico();
$formulario->setIdEmpresa(($_SESSION['k_empresa']));
$formulario->setUnidadMedidaPrincipal();
$formulario->next_result();

require_once('../modelo/modal_consulta.php');
/*estas variables se establecen previamente al tratar de actualizar un regsitro
 * por tal motivo y por seguridad se eliminan en este formulario
 */
unset($_SESSION['velocidad']);
unset($_SESSION['ficha']);
?>

<head>






    <script language="javascript" src="script/submitAjax.js"></script>
    <script language="javascript" src="script/lista_desplegablePesajeProduccion.js"></script> 
    <script language="javascript" src="script/valida_campos_bitacora.js"></script>
    <script language="javascript" src="script/FormularioDinamico.js"></script>
    <script language="javascript" src="script/listaTurno.js"></script>
    <script src="script/bootbox.min.js"></script>
    


    <script language="javascript" src="script/ValidaPesajeProduccion.js"></script>
    



</head>

<div class="page-header text-center">
    <h1> <small> PONER AL DIA EL REPORTE DE PRODUCCION</small></h1>


</div>

<div class="container">
    <div class=" row">
        <form role="form" id="registroProduccion_xyz" action="controlador/pesajeProduccionTurnoDiferente_controller.php" method="post" >



            <div class="col-md-3 ol-md-offset-2" > </div>
            <div class="col-md-3 ol-md-offset-2" >


                <div class="form-group">
                    <label for="exampleInputPassword1">Maquina</label>

                    <select id="maquina" name="maquina" class="form-control">
                        <?php echo $formulario->getOptionValue(); ?>
                    </select>

                </div>


                <div class="form-group">
                    <label for="exampleInputPassword1">Operador</label>
                    <select id="operador" name="operador" class="form-control">

                        <option value="0">Selecciona Uno...</option>
                    </select>

                </div>

                <div class="form-group">

                    <label for="exampleInputPassword1">OP</label>
                    <input type="text"  id="op" class="form-control form-inline onlyNumbers"  maxlength="20" name="op" required placeholder="Orden Produccion">

                </div>
                
                 <div class="form-group">
                    <label for="exampleInputPassword1">Turno</label>

                    <select id="turno" name="turno" class="form-control">
                        <option value="0">Selecciona Uno...</option>
                    </select>
                </div>



            </div>

            <div class="col-md-3 ol-md-offset-2" >



                <div class="form-group">

                    <label for="exampleInputPassword1"> <?php $formulario->getLabel(); ?> </label>

                    <input type="text" class="form-control form-inline onlyNumbers"  maxlength="7" name="kilos" required placeholder="<?php $formulario->getText(); ?>">
                    <input type="hidden" class="form-control"  maxlength="999" name="captchat"  value='<?php echo $token; ?>'>



                </div>
                
                <!-- dinamico -->
                <div class="form-group" id="dinamicoKilosVelocidad">
                   
                </div>

               <!-- dinamico -->

                <div class="form-group">
                    <label for="exampleInputPassword1">Material</label>

                    <?php $formulario->getSelectOrText(); ?>


                </div>
               
                <div class="form-group">
                    <label for="exampleInputPassword1">Fecha</label>
                    <input type="text" name="fecha" class="form-control " placeholder="aaaa-mm-dd"/>
                </div>


               

               




                <button id="enviar" class="btn btn-lg btn-primary btn-block" type="submit">Registrar</button>













            </div>

            <div class="col-md-3 ol-md-offset-2" >


            </div>







    </div>




        </form>

    </div> <!-- fin row-->