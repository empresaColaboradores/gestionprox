<head>
    <link rel="stylesheet" href="css/hover.css">
    <script type="text/javascript" src="script/paginacion_bitacora_1.js" ></script> 
    <script type="text/javascript" src="script/bitacora_1.js" ></script> 
    <script language="javascript" src="script/set_ot.js"></script>
</head>
<?php
require_once('../../modelo/FormularioDinamico.php');
$formulario = new FormularioDinamico();
$formulario->setIdEmpresa(($_SESSION['k_empresa']));
$formulario->setUnidadMedidaPrincipal();

$formulario->next_result();
?>

<div id="vista3">



    <?php require '../../peticion/reportes/menu_estadistica.php';?>
    


    <div class="row"> <!-- row one -->




        <div class="col-md-12">

            <div class="col-md-12">

                <h3 class="text-center"> REPORTE <small>PRODUCCION POR MAQUINA </small> </h3>
                <h4 class="text-center"> <small> Fecha Consultada <?php
                        echo"Inicio  " . $_SESSION['fecha_inicial'] . "  Fin  ";
                        echo $_SESSION['fecha_final'];
                        ?> </small></h4>

                <table class="table  table-bordered table-bordered ">

                    <thead>
                        <tr class="active">




                            <th >Maq.</th>                   

                            <th>Producido </th>
                            <th><a  data-toggle="tooltip" data-placement="top" data-original-title="CAPACIDAD MAQUINA">C.MAQ</a></th>
                            <th><a  data-toggle="tooltip" data-placement="top" data-original-title="TURNOS TRABAJADOS">TURNOS</a></th>
                      
                            
                            <th><a  data-toggle="tooltip" data-placement="top" data-original-title="TIEMPO PRODUCTIVO">TP</a></th>
                            <th><a data-toggle="tooltip" data-placement="top" data-original-title="TIEMPO NO PRODUCTIVO">TNP</a></th>
                            
                            <th><a  data-toggle="tooltip" data-placement="top" data-original-title='<?php $formulario->getToolTipUnidadesKilosAbreviado()?>'><?php $formulario->getLabelUnidadesKilosAbreviado(); ?> </a></th>
                            

                             <th><a  data-toggle="tooltip" data-placement="top" data-original-title="EFICIENCIA MAQUINA">EFM(%)</a></th>
                     <th><a  data-toggle="tooltip" data-placement="top" data-original-title="EFICIENCIA OPERADORES">EFO(%)</a></th>





                        </tr>
                    </thead>

                    <tbody>


                        <?php
                        $tabla2->imprimirTabla();
                        ?>
                    </tbody>

                </table>
            </div>


        </div>

    </div>



    <div class="row"> <!-- row one -->




        <div class="col-md-12">

            <h3 class="text-center"> REPORTE <small>PRODUCCION MAQUINA POR OPERADOR </small> </h3>
            <h4 class="text-center"> <small> Fecha Consultada <?php
                    echo"Inicio  " . $_SESSION['fecha_inicial'] . "  Fin  ";
                    echo $_SESSION['fecha_final'];
                    ?> </small></h4>

            <table class="table  table-bordered table-bordered ">

                <thead>
                    <tr class="active">



                        <th>Operador </th>
                        <th >Maq.</th>                   

                        <th>Producido </th>
                      
                       <th><a  data-toggle="tooltip" data-placement="top" data-original-title="CAPACIDAD MAQUINA">C.MAQ</a></th>
                        <th><a  data-toggle="tooltip" data-placement="top" data-original-title="TURNOS TRABAJADOS">TURNOS</a></th>
                       <th><a  data-toggle="tooltip" data-placement="top" data-original-title="TIEMPO PRODUCTIVO">TP</a></th>
                            <th><a data-toggle="tooltip" data-placement="top" data-original-title="TIEMPO NO PRODUCTIVO">TNP</a></th>
                         <th><a  data-toggle="tooltip" data-placement="top" data-original-title='<?php $formulario->getToolTipUnidadesKilosAbreviado()?>'><?php $formulario->getLabelUnidadesKilosAbreviado(); ?> </a></th>

                             <th><a  data-toggle="tooltip" data-placement="top" data-original-title="EFICIENCIA MAQUINA">EFM(%)</a></th>
                     <th><a  data-toggle="tooltip" data-placement="top" data-original-title="EFICIENCIA OPERADORES">EFO(%)</a></th>





                    </tr>
                </thead>

                <tbody>


                    <?php
                    
                    $tabla3->imprimirTabla();
                    ?>
                </tbody>

            </table>
        </div>


        <div class="row"> <!-- row one -->


            <div class="col-md-12">

                <h3 class="text-center"> CONSOLIDADO <small>TIEMPO IMPRODUCTIVO</small></h3>

                <table class="table  table-bordered table-bordered ">

                    <thead>
                        <tr class="active">

<?php for ($i = 0; $i <= $numeroEncabezados; $i++) { ?>

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


        <div class="container">

            <div class="navbar-btn text-center">





                <form  class="form-signin"  method="post" action="#"  role="form">

                    <button class="btn btn-lg btn-success" type="submit" title="Descarcar Excell"><span class="glyphicon glyphicon-cloud-download"></span></button>
                </form>




            </div>



        </div>


    </div><!-- end the row one -->



</div>