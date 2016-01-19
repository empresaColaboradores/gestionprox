<head>
   <link rel="stylesheet" href="../css/hover.css">
</head>

<div class="page-header">
                 <h1> <small>LISTADO USUARIOS REGISTRADOS</small></h1>
                
               
            </div>
            

<div class="row"> <!-- row one -->


    <div class="col-md-12">

        <table class="table  table-bordered table-bordered ">

            <thead>
                <tr class="active">
                    <th>Codigo Estado</th>
                    <th>Nombre Estado</th>
                    <th>Cambio Estado</th>
                    <th>Motivo Cambio Estado</th>
                    <th>Usuario</th>
                    <th>Fecha Cambio</th>                   
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