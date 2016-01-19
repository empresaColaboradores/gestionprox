
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


         <form  class="contact_form"name='cambia' method='post' action='../controlador/change_pass_controller.php'>
                <h3 class="text-center"> CAMBIO <small>DE CLAVE</small></h3>

                
                <div class="form-group">

                    <label for="exampleInputPassword1">Nombre Usuario</label>
                    <input type="text" class="form-control nombre_rs"  name="nombre" required placeholder="Nombre Usuario" autofocus>
                </div>

                
               <div class="form-group">

                    <label for="exampleInputPassword1">Clave actual</label>
                    <input type="password" class="form-control nombre_rs"  name="clave_actual" required placeholder="Clave Actual">
                </div>

                <div class="form-group">

                    <label for="exampleInputPassword1">Nueva clave</label>
                    <input type="password" class="form-control nombre_rs"  name="nueva_clave" required placeholder="Nueva Clave">
                </div>
                
                <div class="form-group">

                    <label for="exampleInputPassword1">Confirmar clave</label>
                    <input type="password" class="form-control nombre_rs"  name="confirma_clave" required placeholder="Confirme Clave">
                </div>


              

                




                <button type="submit" class="btn btn-primary">Cambiar Clave</button>
            </form>






        </div> <!-- fin class columna -->



    </div> <!-- fin row-->

</div>