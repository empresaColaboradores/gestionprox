<?php
require_once('../modelo/captcha.php');
$cp= new Captchap();
$token=$cp->captchat('loging');
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">



        <meta http-equiv="content-type" content="text/html; charset=UTF-8"> 
        <meta charset="utf-8">
    
        <meta name="generator" content="Bootply" />
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
        
        <script language="javascript" src="script/submitAjax.js"></script>
        <script language="javascript" src="script/bitacora.js"></script>

        <link href="css/signin.css" rel="stylesheet">

       


       



    </head>
    <body>
        <div class="container">

            <form id="loging" class="form-signin" action= "controlador/loging_controller.php" method="post"  role="form">
          
                <h2 class="form-signin-heading">Ingreso al Sistema</h2>
                 <input type="text" class="form-control"  name="usuario" required autofocus placeholder="Nombre Usuario">
                 <input type="text" class="form-control" name="empresa" required placeholder="Empresa">
                 <input type="password" class="form-control"  name="password"  required placeholder="Password">
                 <input type="hidden" class="form-control"  name="captchat"  value='<?php echo $token; ?>'>
                 
                
                <button class="btn btn-lg btn-primary btn-block" type="submit">Acceder</button>
            </form>

        </div> <!-- /container -->



    </body>

    