<head>
   <link rel="stylesheet" href="../css/hover.css">
   <script type="text/javascript" src="../script/MostrarOperador.js" ></script>
</head>


<div class="cointaner text-center"> 
        <div> 
    

            <button  class="btn btn-lg btn-primary " onClick="buscarSM()" title="Buscar Seccion" type="submit"><span class="glyphicon glyphicon-search"></span> </button>
            <button type="button"  title="Relacionar Seccion con una Maquina"  onClick="relacionarSM()" class="btn btn-primary btn-lg"><span class="glyphicon glyphicon-indent-left"></span></button>
             <button  class="btn btn-lg btn-primary " onClick="buscarSEPM()" title="Listar  Seccion-Equipo-Parte Por maquina" type="submit"><span class="glyphicon glyphicon-zoom-in"></span> </button>
            
            <button type="button"  title="cancelar" onclick="limpiar()"  class="btn btn-primary btn-lg"> <span class="glyphicon glyphicon-remove"></span></button>


        </div>
    </div>
    <div id="vista2"> </div>






<div class="row"> <!-- row one -->


    <div class="col-md-12">
         <h3 class="text-center"> LISTADO SECCION  <small>MAQUINA</small></h3>

        <table class="table  table-bordered table-bordered ">

            <thead>
                <tr class="active">
                    <th>Maquina</th>
                    <th>Seccion-Maquina </th>
                                   
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