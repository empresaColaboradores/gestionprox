<?php
if (!isset($_SESSION)) {
    session_start();
}


require_once('../../modelo/captcha.php');
$cp = new Captchap();
$token = $cp->captchat('pesajeProduccion');


require_once '../../modelo/validar_usuario.php';
?>

<head>






    <script language="javascript" src="script/submitAjax.js"></script>
    <script language="javascript" src="script/lista_desplegablePesajeProduccion.js"></script> 



</head>

<div class="page-header text-center">
    <h1> <small> CONSULTA ORDEN PRODUCCION</small></h1>


</div>

<div class="container">
    <div class=" row">
        <form role="form" id="registroProduccion" action="controlador/produccion/consultaPesajeProduccion_controller.php" method="post" >



            <div class="col-md-3 ol-md-offset-2" > </div>
            <div class="col-md-3 ol-md-offset-2" >
                
                
                <div class="form-group">

                    <label for="exampleInputPassword1">OP</label>
                    <input type="text" class="form-control form-inline onlyNumbers"  maxlength="20" name="op"  placeholder="Orden Produccion">

                </div>

               
                <div class="form-group">
                    <label for="exampleInputPassword1">Maquina</label>

                    <select id="maquina" name="maquina" class="form-control">
                        <option value="0">Selecciona Uno...</option>
                    </select>
                </div>
                
                
                   <div class="form-group">
                    <label for="exampleInputPassword1">Operador</label>
                    <select id="operador" name="operador" class="form-control">

                        <option value="0">Selecciona Uno...</option>
                    </select>

                </div>
                
                <div class="form-group">

                    <label for="exampleInputPassword1">Turno</label>
                    <input type="text" class="form-control form-inline onlyNumbers"   name="turno"  placeholder="Valor numerico 1=A,2=B,3=C">
                    



                </div>

                


            </div>

            <div class="col-md-3 ol-md-offset-2" >

                <div class="form-group">

                    <label for="exampleInputPassword1">Consecutivo</label>
                    <input type="text" class="form-control form-inline onlyNumbers"   name="consecutivo"  placeholder="Consecutivo del sticker sin letras">
                    <input type="hidden" class="form-control"  maxlength="999" name="captchat"  value='<?php echo $token; ?>'>



                </div>

               

                <div class="form-group">
                    <label for="exampleInputPassword1">Material</label>

                    <select id="material" name="material" class="form-control">
                        <option value="0">Selecciona Uno...</option>
                    </select>
                </div>
                
                
               <div class="form-group">
                    <label for="exampleInputPassword1">Fecha Inicial</label>
                    <input type="date" name="fecha_inicial" class="form-control "  placeholder="aaaa-mm-dd"/>
                </div>

                <div class="form-group">
                    <label for="exampleInputPassword1">Fecha Final</label>
                    <input type="date" name="fecha_final" class="form-control " placeholder="aaaa-mm-dd"/>
                </div>










 <button class="btn btn-lg btn-primary btn-block" type="submit">Consultar</button>







               





            </div>

            <div class="col-md-3 ol-md-offset-2" >


            </div>












        </form>

    </div> <!-- fin row-->