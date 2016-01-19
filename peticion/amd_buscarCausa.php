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
    
    
             
        
   
   
</head>

<div class="container">
    <div class=" row">
        <div class="col-md-4 ol-md-offset-4" > </div>

        <div class="col-md-4">


          <form role="form" id="amd_find_defecto"  action= "../controlador/amdFindCausa_controller.php"  method="post" >
                <h3 class="text-center"> BUSCAR  <small>FALLAS</small></h3>


                <div class="form-group">

                    
                    <input type="text" class="form-control onlyNumbers"  name="id"    placeholder="Id Causa"  autofocus/>

                </div>


                <div class="form-group">

                    
                    <input type="text" class="form-control numberLet"  name="nombre"    placeholder="Nobre Causa" />

                </div>
                

                <button type="submit" class="btn btn-primary">Submit</button>
            </form>






        </div> <!-- fin class columna -->



    </div> <!-- fin row-->

</div>