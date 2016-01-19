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
    <script language="javascript" src="../script/valida_campos_bitacora.js"></script>
    
    
             
        
   
   
</head>

<div class="container">
    <div class=" row">
        <div class="col-md-4 ol-md-offset-4" > </div>

        <div class="col-md-4">


          <form role="form" id="amd_rg_seccion" action= "../controlador/amdCrearEquipo_controller.php"   method="post" >
                <h3 class="text-center"> REGISTRO  <small>EQUIPO</small></h3>

                <div class="form-group">

                    
                    <input type="text" class="form-control alphaNumber"  name="equipo"    placeholder="Nobre Equipo" required autofocus/>

                </div>
                
                              
                 <div class="form-group">
                    <label for="exampleInputPassword1">Descripcion seccion</label>
                    <textarea class="form-control alphaNumber" rows="3" name="descripcion" maxlength="200" required></textarea>
                    
                </div>

                

                <button type="submit" class="btn btn-primary">Submit</button>
            </form>






        </div> <!-- fin class columna -->



    </div> <!-- fin row-->

</div>