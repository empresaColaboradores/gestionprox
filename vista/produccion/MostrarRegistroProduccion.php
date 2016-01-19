<head>
    <link rel="stylesheet" href="css/hover.css">
    <script type="text/javascript" src="script/bitacora_1.js" ></script> 
    <script type="text/javascript" src="script/paginacion_bitacora_1.js" ></script> 
    <script type="text/javascript" src="script/set_ot.js" ></script> 
</head>

<div id="vista3">

    <?php
    require '../../peticion/produccion/bitacoraTiempoImproductivo_vista.php';
    require_once('../../modelo/FormularioDinamico.php');
    $formulario = new FormularioDinamico();
    $formulario->setIdEmpresa(($_SESSION['k_empresa']));
    $formulario->setUnidadMedidaPrincipal();
    $formulario->next_result();
    ?>


    <div class="row"> <!-- row one -->  

        <div class="page-header">
            <h1 class="text-center"> <small> HISTORIAL PRODUCCION </small></h1>
            <h4 class="text-center"> <small> Fecha Consultada <?php echo"Inicio  ";
    echo $fecha_inicial;
    echo "  Fin  ";
    echo $fecha_final; ?> </small></h4>


        </div>

      


        <div class="col-md-12">

            <table class="table  table-bordered table-bordered ">

                <thead>
                    <tr class="active">
                        <th> Fecha</th> 
                        <th>Maquina </th> 
                        <th>Turno </th>
                        <th>Operador </th>
                        <th><?php $formulario->getLabel(); ?> </th>

                        <th> Velocidad </th>

                        <th>OP </th>

                        <th><?php $formulario->getLabelProduccion(); ?> </th>
                        <th>Lote </th>



                    </tr>
                </thead>

                <tbody>



                   <?php
                    $tabla->imprimirTabla();
                    ?>
                </tbody>

            </table>
        </div>


        <div class="container">

            <div class="navbar-btn text-center">

                <div id="pagination">
                    <?php
                    echo $paginationCtrls . "   ";

                    echo $textLine2 . "<br>";
                    echo "<b>" . $textLine1 . "</b>";
                    ?>
                </div>



                <form  class="form-signin"  method="post" action="controlador/findProduccionExportar_controller.php?excel=excell"  role="form">

                    <button class="btn btn-lg btn-success" type="submit" title="Descarcar Excell"><span class="glyphicon glyphicon-cloud-download"></span></button>
                </form>




            </div>



        </div>


    </div><!-- end the row one -->

</div><!-- end the row one -->