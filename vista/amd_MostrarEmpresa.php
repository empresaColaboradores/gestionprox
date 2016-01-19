<head>
   <link rel="stylesheet" href="../css/hover.css">
   <script type="text/javascript" src="../script/MostrarEmpresa.js" ></script>
</head>


<div class="cointaner text-center"> 
        <div> 
    

            <button  class="btn btn-lg btn-primary " onClick="crearEMP()" title="Crear Empresa" type="submit"><span class="glyphicon glyphicon-th"></span> </button>
            <button  class="btn btn-lg btn-primary " onClick="buscarEPM()" title="Buscar Empresa" type="submit"><span class="glyphicon glyphicon-zoom-in"></span> </button>
            <button type="button"  title="Crear Usuario"  onClick="crearUsuario()" class="btn btn-primary btn-lg"><span class="glyphicon glyphicon-user"></span></button>
            <button type="button"  title="Buscar Usuario"  onClick="buscarUsuario()" class="btn btn-primary btn-lg"><span class="glyphicon glyphicon-search"></span> <small><span class="glyphicon glyphicon-user"></span></small></button>
            
            
            <button type="button"  title="cancelar" onclick="limpiar()"  class="btn btn-primary btn-lg"> <span class="glyphicon glyphicon-remove"></span></button>


        </div>
    </div>
    <div id="vista2"> </div>



<div class="row"> <!-- row one -->


    <div class="col-md-12">

        <table class="table  table-bordered table-bordered ">
            
            <h3 class="text-center">LISTADO DE   <small> EMPRESA</small></h3>

            <thead>
                <tr class="active">
                    <th>Codigo</th>
                    <th>Nombre </th>
                    <th>Nit/CC</th>
                                   
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