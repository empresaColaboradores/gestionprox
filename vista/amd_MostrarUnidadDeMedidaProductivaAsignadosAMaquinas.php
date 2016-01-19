<head>
    <script type="text/javascript" src="../script/menu_amd_ajax.js" ></script> 
    <link rel="stylesheet" href="../css/hover.css">
</head>


<div id="vista3">
    <div class="cointaner text-center"> 
        <div>

            <button  onclick="asignarMedidaPrincipal()" class="btn btn-lg btn-primary " title="AsginarMedidaProduccionPrincipal" type="submit"> Asignar Medida Principal</button>
            <button  onclick="actualizarMedidaPrincipal()" class="btn btn-lg btn-primary " title="ActualizarMedidaProduccionPrincipal" type="submit"> Actualizar Medida Principal</button>
            <button onclick="asignarMedidaSecundaria()"  class="btn btn-lg btn-primary " title="AsginarMedidaProduccionSecundaria" type="submit">Asignar Medida Secundaria</button>
            <button  onclick="actualizarMedidaSecundaria()" class="btn btn-lg btn-primary " title="ActualizarMedidaProduccionPrincipal" type="submit"> Actualizar Medida Secundaria</button>   
            <button type="button"  onclick="limpiar()"  class="btn btn-lg btn-primary " > <span class="glyphicon glyphicon-remove"></span></button>

        </div>
    </div>
    <div id="vista4"> </div>




</div>






<div class="row"> <!-- row one -->


    <div class="col-md-12">
        <h3 class="text-center"> UNIDAD PRODUCTIVA PRINCIPAL <small>ASIGNADA A MAQUINA</small></h3>

        <table class="table  table-bordered table-bordered ">

            <thead>
                <tr class="active">

                    <th>MAQUINA </th>
                    <th>UNIDAD DE MEDIDA PRINCIPAL</th>

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