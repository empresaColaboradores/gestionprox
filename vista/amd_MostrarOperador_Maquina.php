<head>
   <link rel="stylesheet" href="../css/hover.css">
    <script type="text/javascript" src="../script/MostrarOperador.js" ></script>
</head>


<div class="cointaner text-center"> 
        <div> 
            <button type="button"  title="Relacionar Operador Maquina"  onClick="relacionarOM()" class="btn btn-primary btn-lg"><span class="glyphicon glyphicon-indent-left"></span></button>
            <button type="button"  title="Eliminar Relacion Operador Maquina"  onClick="EliminarRelacionarOPeradorMaquina()" class="btn btn-primary btn-lg"><span class="glyphicon glyphicon-trash"></span></button>
            <button type="button"  title="Listar Operadores segun maquina"  onClick="buscarOM()" class="btn btn-primary btn-lg"><span class="glyphicon glyphicon-search"></span></button>
            
            <button type="button"  title="cancelar" onclick="limpiar()"  class="btn btn-primary btn-lg"> <span class="glyphicon glyphicon-remove"></span></button>

        </div>
    </div>


                <div id='vista2'> </div>


     
     


<div class="row"> <!-- row one -->


    <div class="col-md-12">

        <table class="table  table-bordered table-bordered ">

                 <h3 class="text-center">LISTADO   <small> OPERADORES  POR MAQUINA</small></h3>

            <thead>
                <tr class="active">
                    
                   
                    <th>Maquina</th>
                     <th>Nombre </th>
                      <th>Apellido </th>
                       <th>codigo </th>
                                   
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