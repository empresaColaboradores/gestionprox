<?php
if (!isset($_SESSION)) {
    session_start();
}

require_once ('../modelo/validar_usuario.php');
validar_user_amd();

if (!($_SESSION['k_empresa']) == 1) {
    echo("<script>alert('Usted no es el super usuario, ingrese para despues ejecutar la opcion de registro!!')</script>");
    echo('<script>location.href="../index.php"</script>');
    exit();
}

?>

<head>

    <script language="javascript" src="../script/submitAjax.js"></script>
    <script language="javascript" src="../script/admin.js"></script> 
    
    
             
        
   
   
</head>

<div class="container">
    <div class=" row">
        <div class="col-md-4 ol-md-offset-4" > </div>

        <div class="col-md-4">


          <form role="form" id="amd_rg_usuario" action= "../controlador/amdCrearusuario_controller.php"  method="post" >
                <h3 class="text-center"> REGISTRO  <small>USUARIOS PRIMER VES </small></h3>

                <div class="form-group">

                    
                    <input type="text" class="form-control"  name="contactoU"     placeholder="Nobre Usuario" required autofocus/>

                </div>

                

                <div class="form-group">
                    
                    <input type="password"  class="form-control" name="password"  placeholder="Password" required/>
                    

                    
                </div>

                <div class="form-group">
                    
                    <input type="password"  class="form-control" name="password2"  placeholder="Confirme Password" required/>
                    

                    
                </div>


                <div class="form-group">
                    
                     <input type="email"  class="form-control" name="emailU" placeholder="email" required/>

                </div>
                
                 

                


                <button type="submit" class="btn btn-primary">Submit</button>
            </form>






        </div> <!-- fin class columna -->



    </div> <!-- fin row-->

</div>