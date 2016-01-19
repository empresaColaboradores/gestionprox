<head>
   <link rel="stylesheet" href="../css/hover.css">
</head>


<div class="page-header">
                 <h1> <small>LISTADO MAQUINAS</small></h1>
                
               
            </div>



<div class="row"> <!-- row one -->


    <div class="col-md-12">

        <table class="table  table-bordered table-bordered ">

            <thead>
                <tr class="active">
                    <th>Codigo</th>
                    <th>Nombre </th>
                                   
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