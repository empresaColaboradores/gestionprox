<head>
   <link rel="stylesheet" href="../css/hover.css">
   <script type="text/javascript" src="../script/MostrarOperador.js" ></script>
</head>


<div class="cointaner text-center"> 
        <div> 
    

            <button type="button"  title="Relacionar Defecto Causa y Maquina"  onClick="relacionarCD()" class="btn btn-primary btn-lg"><span class="glyphicon glyphicon-indent-left"></span></button>
             <button type="button"  title="Buscar Defecto-Maquina"  onClick="buscarDM()" class="btn btn-primary btn-lg"><span class="glyphicon glyphicon-search"></span></button>
            
            <button type="button"  title="cancelar" onclick="limpiar()"  class="btn btn-primary btn-lg"> <span class="glyphicon glyphicon-remove"></span></button>


        </div>
    </div>
    <div id="vista2"> </div>

    
    <div class="page-header text-center">
    <h1> <small> LISTADO DE FALLAS</small></h1>


</div>


<div class="row"> <!-- row one -->


    <div class="col-md-12">

        <table class="table  table-bordered table-bordered ">

            <thead>
                <tr class="active">
                   <th> Codigo</th>
                   <th > Nombre</th>
                   <th > Detalle</th>
                                   
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