<head>
    <script type="text/javascript" src="../script/menu_amd_ajax.js" ></script> 
    <link rel="stylesheet" href="../css/hover.css">
</head>


<div id="vista3">
    <div class="cointaner text-center"> 
        <div>
            
            <button  onclick="rg_area()" class="btn btn-lg btn-primary " title="Crear Area de Trabajo" type="submit"> <span class="glyphicon glyphicon-home"></span></button>
            <button onclick="find_area()"  class="btn btn-lg btn-primary " title="Buscar Area" type="submit"><span class="glyphicon glyphicon-search"></span></button>
            <button onclick="relacionarAreaUsuario()"  class="btn btn-lg btn-primary " title="Relacionar Area-Usuario" type="submit"><span class="glyphicon glyphicon-signal"></span></button>
            <button onclick="relacionarAreaMaquina()"  class="btn btn-lg btn-primary " title="Relacionar Area-Maquina" type="submit"><span class="glyphicon glyphicon-cog"></span></button>
            <button type="button"  onclick="limpiar()"  class="btn btn-lg btn-primary " > <span class="glyphicon glyphicon-remove"></span></button>

        </div>
    </div>
    <div id="vista4"> </div>




</div>






<div class="row"> <!-- row one -->


    <div class="col-md-12">
        <h3 class="text-center"> RELACION <small>AREA-USUARIO</small></h3>

        <table class="table  table-bordered table-bordered ">

            <thead>
                <tr class="active">
                    <th>AREA</th>
                    <th>USUARIO </th>

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