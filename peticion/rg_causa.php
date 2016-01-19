<?php
if (!isset($_SESSION)) {
    session_start();
}

require_once '../modelo/validar_usuario.php';
validar_user_amd();

require_once('../modelo/captcha.php');
$cp= new Captchap();
$token=$cp->captchat('amd_rg_causa');

?>


<head>

        <script language="javascript" src="../script/valida_campos_amd.js"></script>  
        <script language="javascript" src="../script/submitAjax.js"></script>
        <script language="javascript" src="../script/admin.js"></script>
    
   
 
   
</head>

<div class="container">
    <div class=" row">
        <div class="col-md-4 ol-md-offset-4" > </div>

        <div class="col-md-4">


          <form role="form" id="amd_rg_causa" action= "../controlador/amdCrearCausa_controller.php" method="post" >
                <h3 class="text-center"> REGISTRO TIPO TIEMPO<small>IMPRODUCTIVO</small></h3>

                

                
               <div class="form-group">

                    <label for="exampleInputPassword1">Nombre Tipo</label>
                    <input type="text" class="form-control numberLet"  name="nombre" required placeholder="Nombre Tipo tiempo improductivo">
                </div>

              

                <div class="form-group">
                    <label for="exampleInputPassword1">Detalle</label>
                    <textarea class="form-control numberLet " rows="3" name="detalle"  maxlength="999" required></textarea>
                     <input type="hidden" class="form-control"  name="captchat"  value='<?php echo $token; ?>'>
                      
                </div>





                <button type="submit" class="btn btn-primary">Submit</button>
            </form>






        </div> <!-- fin class columna -->



    </div> <!-- fin row-->

</div>