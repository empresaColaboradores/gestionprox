<head>
   <link rel="stylesheet" href="css/hover.css">
   
</head>
<?php /* muestra los tiempos improductivos, pero sin la descripcion de las partes
de las maquinas-secion-equipo, es una vista mas sencilla*/
?>

<br>

<div class="row"> <!-- row one -->


    <div class="col-md-12">

        <table class="table  table-bordered table-bordered ">

            <thead>
                <tr class="active">
                  
                      <th style="width:14%"> Fecha</th> 
                       <th>Detalle </th>
                       <th>Tipo Falla </th>
                       <th>HI </th>
                         

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