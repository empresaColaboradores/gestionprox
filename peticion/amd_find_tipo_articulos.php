<!--

registra articulo
este archivo registra un articulo juntamente con el archivo
rg_articulos.js para manejar las peticiones asicronas y la validacion 
de los formatos  que deben tener los datos antes de ser enviados al 
servidor


se utiliza el archivo
 "../controlador/ValidacionAjax.php";

para realizar las validaciones en tiempo real, por medio de la tecnica
de programacion AJax


los archivos  de los cuales depende este son:
rg_articulos.js.......................validar formato y peticiones asincronas
registroArticulo_controller.php.......para recibir los datos del formulario
Ficha_Tecnica.php...................para manejar la logica de negocio



-->

<?php 
require_once '../modelo/validar_usuario.php';
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        
       
        
        
        
        <script language="javascript" src="../script/submitAjax.js"></script>
        <script language="javascript" src="../script/admin.js"></script>
        <script language="javascript" src="../script/Unidades_crearListaDesplegable.js"></script>
       
        
         
      



    </head>

    <body>


            <div class="container">
    <div class=" row">
        <div class="col-md-4 ol-md-offset-4" > </div>

        <div class="col-md-4">


          <form role="form" id="amd_find_tipo_articulo" action= "../controlador/amdFindTipoArticulo_controller.php" method="post" >
                <h3 class="text-center"> BUSCAR TIPO <small>PRODUCTOS</small></h3>

                <div class="form-group" >

                    <input type="text"  class="form-control " name="codigo" size="40" maxlength="20"   placeholder="Codigo de Producto" />
                      

                </div>

                <div class="form-group" >

                    <input type="tex"  class="form-control " name="nombre_tipo_articulo" size="40" maxlength="40"   placeholder="Nombre Tipo de Articulo"/>
                      

                </div>


                <div class="form-group" >

                    
                    <input type="tex"  class="form-control " name="cantidad_pp" size="40" maxlength="40"  id="refP"  placeholder="Cantidad minima permitida en Pedidos"/>
                      

                </div>


                

                <div class="form-group">
                    

                    <label for="Tipo_pedido"> UNIDADES</label>
                                <select id="tipoUnidades" name="selectP_ra" class="form-control">
                                    <option value="B">Selecciona Uno...</option>
                                </select>
                </div>


               
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>






        </div> <!-- fin class columna -->



    </div> <!-- fin row-->

</div>



       


    </body>
</html>



