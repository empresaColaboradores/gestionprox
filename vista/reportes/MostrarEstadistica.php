<head>
    <link rel="stylesheet" href="css/hover.css">
    <script type="text/javascript" src="script/paginacion_bitacora_1.js" ></script> 
    <script type="text/javascript" src="script/bitacora_1.js" ></script> 
</head>

<div id="vista3">



   <?php require '../../peticion/reportes/menu_estadistica.php'; ?>
    
   



</div>

<div class="row"> <!-- row one -->


    <div class="col-md-12">

        <h3 class="text-center"> REPORTE  <small>DE FALLAS POR MAQUINA</small></h3>
        <h4 class="text-center"> <small> Fecha Consultada <?php echo"Inicio  ";
    echo $fecha_inicial;
    echo "  Fin  ";
    echo $fecha_final; ?> </small></h4>


        <table class="table  table-bordered table-bordered ">

            <thead>
                <tr class="active">

                    <th >Maq.</th> 

                    <th>Total Horas Improductivas </th>
                    <th>Total Fallas</th>




                </tr>
            </thead>

            <tbody>



<?php
$tabla6->imprimirTabla();
?>
            </tbody>

        </table>
    </div>


</div><!-- end the row one -->


<div class="row"> <!-- row one -->


    <div class="col-md-12">

        <h3 class="text-center"> REPORTE  <small>DE FALLAS POR SECCION</small></h3>
        <h4 class="text-center"> <small> Fecha Consultada <?php echo"Inicio  ";
echo $fecha_inicial;
echo "  Fin  ";
echo $fecha_final; ?> </small></h4>


        <table class="table  table-bordered table-bordered ">

            <thead>
                <tr class="active">

                    <th >Maq.</th> 
                    <th >Seccion</th> 

                    <th>Total Horas Improductivas </th>
                    <th>Total Fallas </th>




                </tr>
            </thead>

            <tbody>



<?php
$tabla4->imprimirTabla();
?>
            </tbody>

        </table>
    </div>


</div><!-- end the row one -->


<div class="row"> <!-- row one -->


    <div class="col-md-12">

        <h3 class="text-center"> REPORTE<small> DE FALLAS POR EQUIPO</small></h3>
        <h4 class="text-center"> <small> Fecha Consultada <?php echo"Inicio  ";
echo $fecha_inicial;
echo "  Fin  ";
echo $fecha_final; ?> </small></h4>

        <table class="table  table-bordered table-bordered ">

            <thead>
                <tr class="active">

                    <th >Maq.</th> 

                    <th>Equipo </th>
                    <th>Total Horas </th>
                    <th>Total Fallas </th>



                </tr>
            </thead>

            <tbody>



<?php
$tabla3->imprimirTabla();
?>
            </tbody>

        </table>
    </div>


</div><!-- end the row one -->


<div class="row"> <!-- row one -->


    <div class="col-md-12">

        <h3 class="text-center"> REPORTE<small> DE FALLAS PARTES DE EQUIPO</small></h3>
        <h4 class="text-center"> <small> Fecha Consultada <?php echo"Inicio  ";
echo $fecha_inicial;
echo "  Fin  ";
echo $fecha_final; ?> </small></h4>

        <table class="table  table-bordered table-bordered ">

            <thead>
                <tr class="active">

                    <th >Maq.</th> 
                    <th>Equipo </th>
                    <th>Parte </th>
                    <th>Total Horas </th>
                    <th>Total Fallas </th>



                </tr>
            </thead>

            <tbody>



<?php
$tabla2->imprimirTabla();
?>
            </tbody>

        </table>
    </div>


</div><!-- end the row one -->



<div class="row"> <!-- row one -->


    <div class="col-md-12">

        <h3 class="text-center"> CONSOLIDADO <small>TIEMPO IMPRODUCTIVO</small></h3>

        <table class="table  table-bordered table-bordered ">

            <thead>
                <tr class="active">

<?php for ($i = 0; $i <= $numeroColumnas; $i++) { ?>

                        <th ><?php echo $vector[$i]; ?></th> 

    <?php
}
?>




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