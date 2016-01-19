<?php
if (!isset($_SESSION)) {
    session_start();
}

require_once ('../modelo/validar_usuario.php');
validar_user_amd();

if (!($_SESSION['k_empresa']) == 1) {
    echo("<script>alert('Usted no esta logiado, ingrese para despues ejecutar la opcion de registro!!')</script>");
    echo('<script>location.href="../index.php"</script>');
    exit();
}
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


            <form role="form" id="amd_rg_seccion" action= "../controlador/amdCrearEmpresa_controller.php"   method="post" >
                <h3 class="text-center"> REGISTRO  <small>EMPRESA</small></h3>

                <div class="form-group">


                    <input type="text" class="form-control alphaNumber"  name="nit"    placeholder="NIT O CEDULA" required autofocus/>

                </div>


                <div class="form-group">
                    <label for="exampleInputPassword1">Nombre</label>
                    <input class="form-control alphaNumber"  name="empresa" placeholder="Nombre de la empresa o Responsable legal" required></input>
                    </div>



                       <button class="btn btn-lg btn-primary btn-block" type="submit">Registrar</button>
            </form>






        </div> <!-- fin class columna -->



    </div> <!-- fin row-->

</div>