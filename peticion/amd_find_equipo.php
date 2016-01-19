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


          <form role="form" id="amd_rg_seccion" action= "../controlador/amdFindEquipo_controller.php"   method="post" >
                <h3 class="text-center"> BUSCAR  <small>EQUIPO</small></h3>
                
                
                <div class="form-group">

                    
                    <input type="text" class="form-control onlyNumbers"  name="id"    placeholder="Id Equipo"  autofocus/>

                </div>

                <div class="form-group">

                    
                    <input type="text" class="form-control alphaNumber"  name="equipo"    placeholder="Nobre Equipo de la Maquina" />

                </div>
                
                              
                 <div class="form-group">
                    <label for="exampleInputPassword1">Descripcion Equipo</label>
                    <textarea class="form-control alphaNumber" rows="3" name="descripcion" maxlength="200"></textarea>
                    
                </div>

                

                <button type="submit" class="btn btn-primary">Buscar</button>
            </form>






        </div> <!-- fin class columna -->



    </div> <!-- fin row-->

</div>