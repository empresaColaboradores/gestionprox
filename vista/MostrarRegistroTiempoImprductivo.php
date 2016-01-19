<head>
    <link rel="stylesheet" href="css/hover.css">
    <script type="text/javascript" src="script/paginacion_bitacora_1.js" ></script> 
    <script type="text/javascript" src="script/bitacora_1.js" ></script> 
</head>

<div id="vista3">

    <?php require '../peticion/bitacoraTiempoImproductivo_vista.php'; ?>
    <div class="page-header">
        <h1> <small> <?php echo $titulo_vista; ?></small></h1>


    </div>




</div>

<div class="row"> <!-- row one -->


    <div class="col-md-12">

        <table class="table  table-bordered table-bordered ">

            <thead>
                <tr class="active">
                    <th style="width:18%"> Fecha</th>                 
                    <th >Maq.</th> 
                    <th>Equipo </th>
                    <th>Tipo Falla </th>
                    <th>Causa Falla </th>
                    <th>Detalle </th>
                    <th>Operador </th>

                    <th>HI </th>


                    <th>Turno </th>



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