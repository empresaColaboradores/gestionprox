<head>
    <link rel="stylesheet" href="css/hover.css">
    <script type="text/javascript" src="script/paginacion_bitacora_1.js" ></script> 
    <script type="text/javascript" src="script/bitacora_1.js" ></script>
    <script type="text/javascript" src="script/set_ot.js" ></script> 
</head>
<div id="vista3">



    <?php require '../../peticion/produccion/bitacoraTiempoImproductivo_vista.php';?>

    <div id="vista4"> </div>



     <div class="page-header">
                 <h1> <small> HISTORIAL TIEMPO IMPRODUCTIVO </small></h1>
 <h4 class="text-center"> <small> Fecha Consultada <?php  echo"Inicio  "; echo $fecha_inicial; echo "  Fin  "; echo $fecha_final; ?> </small></h4>
                
               
            </div>

    <div class="row"> <!-- row one -->


        <div class="col-md-12">

            <table class="table table-bordered table-stripe ">

                <thead>
                    <tr class="active">
                    <th style="width:14%"> Fecha</th> 
                    <th>Operador </th> 
                    <th >Maq.</th> 
                    
                       
                       <th>Detalle </th>
                   
                     
                    
                     <th>Tipo Falla </th>
                   
                     
                                       
                    <th>HI </th>                 
                   
                    <th>Turno </th>
                    <th>Id </th>



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



            <form  class="form-signin"  method="post" action="controlador/exportarReporteTiempoImproductivoController.php?excel=excell"  role="form">

                <button class="btn btn-lg btn-success" type="submit" title="Descarcar Excell"><span class="glyphicon glyphicon-cloud-download"></span></button>
            </form>




        </div>



    </div>

</div>