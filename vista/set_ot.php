<?php
if (!isset($_SESSION)) {
    session_start();
}
?>






<html>
    
    <head>
   <script language="javascript" src="script/submitAjax.js"></script>
    <script language="javascript" src="script/valida_campos_bitacora.js"></script>
    <script language="javascript" src="script/Bitacora_ListaTecnicos.js"></script> 
    </head>

    <body>

     




        <div class="page-header">
            <div class="container">
                <div  id="vista">

                    <div class="container">
                        <div class=" row">

                            <div class="page-header text-center">
                                <h1> <small> GESTION ORDENES DE TRABAJO</small></h1>


                            </div>


                            <div class="col-md-4 ol-md-offset-4" > </div>

                            <div class="col-md-4 ol-md-offset-4" > 


                                <form role="form" id="find_timp" action="controlador/set_notaOT_controller.php" method="post" >


                                     <div class="form-group">
                                        <label for="exampleInputPassword1">Consecutivo OT</label>
                                         <input type="text" class="form-control "  name="id_ot"    readonly value="<?php echo $id_ot ; ?>" required autofocus/>
                                        
                                    </div>

                                    <div class="form-group">
                                        <label for="exampleInputPassword1">Observaciones Operador</label>
                                        <textarea class="form-control"  rows="3" name="detalle"  readonly><?php echo $ob_op ; ?></textarea>
                                        
                                    </div>

                                    <div class="form-group">
                                        <label for="exampleInputPassword1">Observaciones T&eacute;cnico</label>
                                        
                                        <textarea class="form-control alphaNumber " rows="3" name="detalle"  <?php echo $css; ?>></textarea>
                                        
                                    </div>

                                    <div class="form-group">
                                        <label for="exampleInputPassword1">Tecnico</label>
                                        <select id="operador" name="tecnico" class="form-control">

                                            <option value="0">Selecciona Uno...</option>
                                        </select>

                                    </div>

                                    <div class="form-group">
                                        <label for="exampleInputPassword1">Estado</label>

                                        <select id="equipo" name="estado" class="form-control">
                                            <option value="1">ABIERTA</option>
                                            <option value="2">CERRADO</option>
                                        </select>
                                    </div>



                                    <button class="btn btn-lg btn-primary btn-block" type="submit">Registrar</button>









                                </form>



                            </div>


                            <div class="col-md-4 ol-md-offset-4" > </div>



                        </div> <!-- fin row-->

                    </div>



                </div>

            </div>
        </div>


        <div class="panel-footer">
            <div class="container text-center">
                <p class="text-muted">Software para la Gestion de la Produccion</p>
            </div>
        </div>







      
    </body>
</html>