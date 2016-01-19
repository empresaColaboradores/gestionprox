
<head>
    <link rel="stylesheet" href="css/hover.css">
    <script type="text/javascript" src="script/paginacion_bitacora_1.js" ></script> 
    <script type="text/javascript" src="script/bitacora_1.js" ></script> 
</head>
<div id="vista3">

    <?php require '../peticion/bitacoraTiempoImproductivo_vista.php';?>
    
 


    <div class="page-header">
                 <h1> <small>HISTORIAL REGISTRO BITACORA</small></h1>
                 
                
               
            </div>
  

   


    <div class="row"> <!-- row one -->


        <div class="col-md-12">

            <table class="table table-bordered table-stripe ">

                <thead>
                    <tr class="active">
                        <th style="width:15%"> Fecha</th> 
                        <th>Operador</th>
                        <th >Maquina</th>
                        <th >Detalle </th>
                    </tr>
                </thead>

                <tbody>



                    <?php
                    $tabla->imprimirTabla();
                    ?>
                </tbody>

            </table>
        </div>


    </div><!-- end the row one -->

    <div class="container">

        <div class="navbar-btn text-center">

            <div id="pagination">
                <?php
                echo $paginationCtrls . "   ";

                echo $textLine2 . "<br>";
                echo "<b>" . $textLine1 . "</b>";
                ?>
            </div>



            <form  class="form-signin"  method="post" action="controlador/findHistorial_BitacoraExportar_controller_2.php?excel=excell"  role="form">

                <button class="btn btn-lg btn-success" type="submit" title="Descarcar Excell"><span class="glyphicon glyphicon-cloud-download"></span></button>
            </form>




        </div>



    </div>

</div>