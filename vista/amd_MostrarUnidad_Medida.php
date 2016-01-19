<head>
   <link rel="stylesheet" href="../css/hover.css">
 </head>





<div class="row"> <!-- row one -->


    <div class="col-md-12">

        <table class="table  table-bordered table-bordered ">

            <thead>
                <tr class="active">
                    <th > Consecutivo</th>
                    <th  >Codigo Unidad de Medida</th>
                    <th  >Nombre Unidad de Medida</th>
                                   
                </tr>
            </thead>

            <tbody>
                <?php
                $url_arrayOCImp = $ficha->llenarArray($consulta,$field-1);
                $ficha->imprimir($url_arrayOCImp);
                ?>
            </tbody>

        </table>
    </div>


</div><!-- end the row one -->