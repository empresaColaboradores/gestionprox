<head>
    <link rel="stylesheet" href="css/hover.css">
    <script type="text/javascript" src="script/paginacion_bitacora_1.js" ></script> 
    <script type="text/javascript" src="script/bitacora_1.js" ></script> 
    <script language="javascript" src="script/set_ot.js"></script>

    <script type="text/javascript">
        $(document).ready(function () {
            $('[data-toggle="tooltip"]').tooltip();
        });
    </script>

</head>
<?php
require_once('../../modelo/FormularioDinamico.php');

$formulario = new FormularioDinamico();
$formulario->setIdEmpresa(($_SESSION['k_empresa']));
$formulario->setUnidadMedidaPrincipal();

$formulario->next_result();
?>

<div id="vista3">



    <?php require '../../peticion/reportes/menu_estadistica.php'; ?>
    






    <div class="row"> <!-- row one -->


        <div class="col-md-12">

            <h3 class="text-center"> REPORTE  PRODUCCION POR <small>TURNO-OPERADOR  </small></h3>
            <h4 class="text-center"> <small> Fecha Consultada <?php
                    echo"Inicio  ";
                    echo $fecha_inicial;
                    echo "  Fin  ";
                    echo $fecha_final;
                    ?> </small></h4>

            <table class="table  table-bordered table-bordered ">

                <thead>
                    <tr class="active">

                        <th style="width:14%"> Fecha</th> 
                        <th >Turno</th>
                        <th>Operador </th>
                        <th >Maq.</th>

                        <th><?php $formulario->getLabelProduccion(); ?> </th>
                        <th> <a  data-toggle="tooltip" data-placement="top" data-original-title='<?php $formulario->getToolTipUnidadesKilosProducidoAbreviado() ?>'><?php $formulario->getLabel(); ?>  </a> </th>

                        <th><a  data-toggle="tooltip" data-placement="top" data-original-title="CAPACIDAD MAQUINA">C.MAQ</a></th>
                        <th><a  data-toggle="tooltip" data-placement="top" data-original-title="VELOCIDAD MAQUINA">Vel</a></th>
                        <th><a  data-toggle="tooltip" data-placement="top" data-original-title="TIEMPO PRODUCTIVO">TP</a></th>
                        <th><a data-toggle="tooltip" data-placement="top" data-original-title="TIEMPO NO PRODUCTIVO">TNP</a></th>

                        <th><a  data-toggle="tooltip" data-placement="top" data-original-title='<?php $formulario->getToolTipUnidadesKilosAbreviado() ?>'><?php $formulario->getLabelUnidadesKilosAbreviado(); ?> </a></th>

                        <th><a  data-toggle="tooltip" data-placement="top" data-original-title="EFICIENCIA MAQUINA">EFM(%)</a></th>
                        <th><a  data-toggle="tooltip" data-placement="top" data-original-title="EFICIENCIA OPERADOR">EFO(%)</a></th>


                        <th>Detalle </th>




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
                
                
                <div style="display: inline">

                    <form  style="display: inline" class="form-signin"  method="post" action="controlador/exportarEstadisticoProduccion_controller.php?excel=excell"  role="form">

                        <button class="btn btn-lg btn-success" type="submit" title="Reporte Resumido"><span class="glyphicon glyphicon-cloud-download"></span></button>
                    </form>

                    <form  style="display: inline" class="form-signin"  method="post" action="controlador/exportarEstadisticoProduccionDetallada_controller.php?excel=excell"  role="form">

                        <button class="btn btn-lg btn-success" type="submit" title="Reporte Detallado"><span class="glyphicon glyphicon-cloud-download"></span></button>
                    </form>


                </div>


               


            </div>



        </div>


    </div><!-- end the row one -->



</div>