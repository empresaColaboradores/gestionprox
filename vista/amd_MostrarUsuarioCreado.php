<head>
   <link rel="stylesheet" href="../css/hover.css">
</head>

<div class="row"> <!-- row one -->


    <div class="col-md-12">

        <table class="table  table-bordered table-bordered ">

            <thead>
                <tr class="active">
                    
                    <th>Nombre </th>
                    <th>Email</th>
                                   
                </tr>
            </thead>

            <tbody>

               

                <?php
                $url_arrayOCImp = $usuario->llenarArray($consulta,$field-1);
                $usuario->imprimir($url_arrayOCImp);
                ?>
            </tbody>

        </table>
    </div>


</div><!-- end the row one -->