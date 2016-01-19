<?php
if (!isset($_SESSION)) {
    session_start();
}


require_once('../../modelo/captcha.php');
$cp = new Captchap();
$token = $cp->captchat('rg_bitacora_2');


require_once '../../modelo/validar_usuario.php';
?>

<head>







    
    <script language="javascript" src="script/submitAjax.js"></script>
    <script language="javascript" src="script/valida_campos_bitacora.js"></script>
   <script language="javascript" src="script/Bitatoca_crearListaDesplegable_busqueda.js"></script>

    


</head>




<div class="container">
    <div class=" row">





        <form role="form" id="find_timp" action="controlador/produccion/consultarTiempoImproductivoCorto_controller.php" method="post" >
            <h3 class="text-center"> CONSULTA TIEMPO <small>IMPRODUCTIVO </small></h3>

            <div class="col-md-3 ol-md-offset-2" > </div>
            <div class="col-md-3 ol-md-offset-2" > 
                 <div class="form-group">
                    <label for="exampleInputPassword1">Maquina</label>

                    <select id="maquina" name="maquina" class="form-control">
                        <option value="0">Selecciona Uno...</option>
                    </select>
                </div>
                
                
                 <div class="form-group">
                    <label for="exampleInputPassword1">Seccion</label>

                    <select id="seccion" name="seccion" class="form-control">
                        <option value="0">Selecciona Uno...</option>
                    </select>
                </div>
                
                <div class="form-group">
                    <label for="exampleInputPassword1">Equipo</label>

                    <select id="equipo" name="equipo" class="form-control">
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
                    <label for="exampleInputPassword1">Causa</label>
                    <select id="origen" name="origen" class="form-control">

                        <option value="0">Selecciona Uno...</option>
                    </select>

                </div>

                
            </div>
            <div class="col-md-3 ol-md-offset-2" > 
                

                <div class="form-group">
                    <label for="exampleInputPassword1">Tipo</label>
                    <select id="causa" name="causa" class="form-control">

                        <option value="0">Selecciona Uno...</option>
                    </select>

                </div>


                <div class="form-group">
                    <label for="exampleInputPassword1">Detalle</label>
                    <textarea class="form-control alphaNumber" rows="3" name="detalle"  maxlength="999"></textarea>
                    <input type="hidden" class="form-control"  maxlength="999" name="captchat"  value='<?php echo $token; ?>'>
                </div>

                <div class="form-group">
                    <label for="exampleInputPassword1">Fecha Inicial</label>
                    <input type="date" name="fecha_inicial" class="form-control "  placeholder="aaaa-mm-dd"/>
                </div>

                <div class="form-group">
                    <label for="exampleInputPassword1">Fecha Final</label>
                    <input type="date" name="fecha_final" class="form-control " placeholder="aaaa-mm-dd"/>
                </div>
                
                <button class="btn btn-lg btn-primary btn-block" type="submit">Buscar</button>

            </div>
            <div class="col-md-3 ol-md-offset-2" > </div>





            
        </form>










    </div> <!-- fin row-->

</div>