<head>
    <script type="text/javascript" src="../script/menu_amd_ajax.js" ></script> 
    <link rel="stylesheet" href="../css/hover.css">
</head>


<div id="vista3">
    <div class="cointaner text-center"> 
        <div>
            
            <button  onclick="asignarArbolJerarquicoAMaquina()" class="btn btn-lg btn-primary " title="Crear Area de Trabajo" type="submit"> <span class="glyphicon glyphicon-sort-by-attributes">Asignar Arbol Jerarquico</span></button>
            <button onclick="buscarArbolJerarquicoAMaquina()"  class="btn btn-lg btn-primary " title="Buscar Area" type="submit"><span class="glyphicon glyphicon-search"></span>Buscar Arbol Jerarquico</button>
             <button onclick="actualizarArbolJerarquicoAMaquina()"  class="btn btn-lg btn-primary " title="Relacionar Area-Maquina" type="submit"><span class="glyphicon glyphicon-cog">Actualizar Arbol Jerarquico</span></button>
            <button type="button"  onclick="limpiar()"  class="btn btn-lg btn-primary " > <span class="glyphicon glyphicon-remove"></span></button>

        </div>
    </div>
    <div id="vista4"> </div>




</div>






<div class="row"> <!-- row one -->


    <div class="col-md-12">
        <h3 class="text-center"> MAQUINA <small>TIPO DE JERARQUIA</small></h3>

        <table class="table  table-bordered table-bordered ">

            <thead>
                <tr class="active">
                    <th>AREA</th>
                    <th>MAQUINA </th>

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