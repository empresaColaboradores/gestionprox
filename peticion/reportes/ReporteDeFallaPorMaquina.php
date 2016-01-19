<?php
if (!isset($_SESSION)) {
    session_start();
}



require_once '../../modelo/validar_usuario.php';
?>

<head>
    
    
             
            
        
   
    <script language="javascript" src="script/submitAjax.js"></script>
    <script language="javascript" src="script/valida_campos_bitacora.js"></script>
    <script language="javascript" src="script/Bitatoca_crearListaDesplegable.js"></script> 
    
    
  
</head>

<div class="container">
    <div class=" row">
        <div class="col-md-4 ol-md-offset-4" > </div>

        <div class="col-md-4">


          <form role="form" id="rg_bitacora" action="controlador/reportes/estadistico_controller.php" method="post" >
                <h3 class="text-center"> REPORTE DE FALLAS <small>POR MAQUINA</small></h3>

                
                <div class="form-group">
                    <label for="exampleInputPassword1">Maquina</label>

                    <select id="maquina" name="maquina" class="form-control">
                        <option value="0">Selecciona Uno...</option>
                    </select>
                </div>
                
                 <div class="form-group">
                    <label for="exampleInputPassword1">Seccion</label>

                    <select id="seccion" name="seccion" class="form-control">
                        <option value="0">Selecciona Uno...</option>
                    </select>
                </div>
                
                <div class="form-group">
                    <label for="exampleInputPassword1">Equipo</label>

                    <select id="equipo" name="equipo" class="form-control">
                        <option value="0">Selecciona Uno...</option>
                    </select>
                </div>
                
                  <div class="form-group">
                    <label for="exampleInputPassword1">Fecha Inicial</label>
                    <input type="date" name="fecha_inicial" class="form-control "  placeholder="aaaa-mm-dd"/>
                </div>

                <div class="form-group">
                    <label for="exampleInputPassword1">Fecha Final</label>
                    <input type="date" name="fecha_final" class="form-control "  placeholder="aaaa-mm-dd"/>
                </div>
                

                <div class="form-group">
                     
                     <button class="btn btn-lg btn-primary btn-block" type="submit">Generar</button>

                  
                </div>



               
                
               
            </form>
            
           





        </div> <!-- fin class columna -->



    </div> <!-- fin row-->

</div>