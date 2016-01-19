<?php
if (!isset($_SESSION)) {
    session_start();
}

require_once ('../modelo/validar_usuario.php');
validar_user_amd();
?>

<head>

 
     <script language="javascript" src="../script/submitAjax.js"></script>
     <script language="javascript" src="../script/amd_crearListaDesplegable.js"></script> 
     <script language="javascript" src="../script/admin.js"></script> 
    
    
             
        
   
   
</head>

<div class="container">
    <div class=" row">
        <div class="col-md-4 ol-md-offset-4" > </div>

        <div class="col-md-4">


          <form role="form" id="amd_up_usuario" action= "../controlador/amdActualizarUsuario_controller.php"  method="post" >
                <h3 class="text-center"> ACTUALIZAR ESTADO USUARIOS <small>REGISTRADO</small></h3>

                <div class="form-group" id="elementos">

                    <input type="text" class="form-control"  name="usuario"  placeholder="Nobre Usuario">

                </div>

                

                <div class="form-group">
                    <label for="exampleInputPassword1">Estado</label>

                    <select id="estado" name="estado" class="form-control">
                        <option value="0">Selecciona Uno...</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">Motivo</label>
                    <select id="motivo" name="motivo" class="form-control">

                        <option value="0">Selecciona Uno...</option>
                    </select>

                </div>

                


                <button type="submit" class="btn btn-primary">Submit</button>
            </form>






        </div> <!-- fin class columna -->



    </div> <!-- fin row-->

</div>