
<head>
    <link rel="stylesheet" href="css/hover.css">
    <script type="text/javascript" src="script/paginacion_bitacora_1.js" ></script> 
    <script type="text/javascript" src="script/bitacora_1.js" ></script> 
      <script language="javascript" src="script/set_ot.js"></script>
</head>
<div id="vista3">



    <div class="cointaner text-center"> 
        <div> 

            <button  onclick="rg_bitacora()" class="btn btn-lg btn-primary " title="Registrar Bitacora" type="submit"> <span class="glyphicon glyphicon-book"></span></button>
            <button onclick="rg_timpoImp()"  class="btn btn-lg btn-primary " title="Registro Tiempo Improductivo" type="submit"><span class="glyphicon glyphicon-time"></span></button>
            <button onclick="find_bitacora()"  class="btn btn-lg btn-primary " title="Buscar Registro Bitacora" type="submit"><span class="glyphicon glyphicon-search"></span> </button>
            <button onclick="find_timp()"  class="btn btn-lg btn-primary " type="submit"><span class="glyphicon glyphicon-zoom-in"></span></button>
            <button type="button"  onclick="limpiar()"  class="btn btn-lg btn-primary " > <span class="glyphicon glyphicon-remove"></span></button>


        </div>
    </div>
    <div id="vista4"> </div>

     <div class="page-header">
                 <h1> <small> MOSTRAR DETALLE ORDEN DE TRABAJOS </small></h1>
                
               
            </div>

    <div class="row"> <!-- row one -->


        <div class="col-md-12">

            <table class="table table-bordered table-stripe ">

                <thead>
                    <tr class="active">
                        <th style="width:10%"> Fecha</th>
                        <th >Estado</th>
                        <th >Maq.</th> 
                        <th>Seccion </th>
                        <th>Equipo </th>
                        <th>Requerimiento </th>
                        <th>Tipo Falla </th>
                                          
                        <th >Detalle </th>
                                             
                        <th>id </th>
                       
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



            <form  class="form-signin"  method="post" action="controlador/findHistorial_BitacoraExportar_controller_1.php?excel=excell"  role="form">

                <button class="btn btn-lg btn-success" type="submit" title="Descarcar Excell"><span class="glyphicon glyphicon-cloud-download"></span></button>
            </form>




        </div>



    </div>

</div>