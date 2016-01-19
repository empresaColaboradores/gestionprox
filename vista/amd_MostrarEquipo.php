<head>
   <link rel="stylesheet" href="../css/hover.css">
   <script type="text/javascript" src="../script/MostrarOperador.js" ></script>
</head>


<div class="cointaner text-center"> 
        <div> 
    

           <button  class="btn btn-lg btn-primary " onClick="buscarEM()" title="Buscar Equipo" type="submit"><span class="glyphicon glyphicon-search"></span> </button>
            <button type="button"  title="Relacionar Maquina-Seccion-Equipo"  onClick="relacionarMSE()" class="btn btn-primary btn-lg"><span class="glyphicon glyphicon-indent-left"></span></button>
             <button  class="btn btn-lg btn-primary " onClick="buscarSEPM()" title="Listar  Seccion-Equipo-Parte Por maquina" type="submit"><span class="glyphicon glyphicon-zoom-in"></span> </button>
            
            <button type="button"  title="cancelar" onclick="limpiar()"  class="btn btn-primary btn-lg"> <span class="glyphicon glyphicon-remove"></span></button>


        </div>
    </div>
    <div id="vista2"> </div>



<div class="row"> <!-- row one -->


    <div class="col-md-12">

        <table class="table  table-bordered table-bordered ">
            
            <h3 class="text-center">LISTADO EQUIPO  <small> PERTENECIENTE A UNA SECCION DE MAQUINA</small></h3>

            <thead>
                <tr class="active">
                    <th>Codigo</th>
                    <th>Nombre </th>
                    <th>Descripcion</th>
                                   
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