<?php
if (!isset($_SESSION)) {
    session_start();
}


require_once('../modelo/captcha.php');
$cp = new Captchap();
$token = $cp->captchat('rg_bitacora_2');


require_once '../modelo/validar_usuario.php';
?>

<head>







    
    <script language="javascript" src="script/submitAjax.js"></script>
    <script language="javascript" src="script/valida_campos_bitacora.js"></script>
   <script language="javascript" src="script/Bitatoca_crearListaDesplegable_busqueda.js"></script>

    


</head>




<div class="container">
    <div class=" row">
        
        <div class="col-md-4 ol-md-offset-4" > </div>



<div class="col-md-4 ol-md-offset-4" > 

        <form role="form" id="find_timp" action="controlador/find_ot_controller.php" method="post" >
            <h3 class="text-center"> CONSULTA  ORDEN DE <small>TRABAJO</small></h3>

         
          
                 <div class="form-group">
                    <label for="exampleInputPassword1">Maquina</label>

                    <select id="maquina" name="maquina" class="form-control">
                        <option value="0">Selecciona Uno...</option>
                    </select>
                </div>
                
                
                 
                
                <div class="form-group">
                    <label for="exampleInputPassword1">Estado</label>

                    <select  name="estado" class="form-control">
                        <option value="0">TODAS</option>
                        <option value="1">ABIERTA</option>
                        <option value="2">CERRADO</option>
                    </select>
                </div>
                
                      

                


                

                <div class="form-group">
                    <label for="exampleInputPassword1">Fecha Inicial</label>
                    <input type="date" name="fecha_inicial" class="form-control "  placeholder="Fecha Inicio de busqueda"/>
                </div>

                <div class="form-group">
                    <label for="exampleInputPassword1">Fecha Final</label>
                    <input type="date" name="fecha_final" class="form-control "  placeholder="Fecha Final de busqueda"/>
                </div>
                
                <button class="btn btn-lg btn-primary btn-block" type="submit">Buscar</button>

            </div>
          





            
        </form>

</div>




<div class="col-md-4 ol-md-offset-4" > </div>



    </div> <!-- fin row-->

</div>