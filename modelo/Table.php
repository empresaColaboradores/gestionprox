<?php

class Table {
    
    private  $array;

    /**
     * esta funcion llena un array para mostrar una tabla
     * que en la ultima columna tiene un link que llama a una 
     * funcion tipo ajax
     */
    public function crearArray($mysqli_result, $field, $fecha, $turno, $maquina) {
        $array = array();

        for ($count = 0; $fila = $mysqli_result->fetch_row(); $count++) {

            for ($j = 0; $j <= $field; $j++) {

                if ($j == $field) {
                    $array[$count][$j] = '<a href="#"  onclick="consultaCausaBajaProductividad(\'' . $fila[$fecha] . '\' , \'' . $fila[$turno] . '\',\'' . $fila[$maquina] . '\' )" >' . $fila[$field] . '</a>';
                    break 1;
                }

                $array[$count][$j] = $fila[$j];
            }
        }

        $this->array = $array;
    }
    
    
    public function crearArraySimple($mysqli_result, $field) {
        $array = array();

        for ($count = 0; $fila = $mysqli_result->fetch_row(); $count++) {

            for ($j = 0; $j <= $field; $j++) {

                

                $array[$count][$j] = $fila[$j];
            }
        }

        $this->array = $array;
    }
    
    public function getArray(){
        
        return $this->array;
    }

    public function imprimirTabla() {



        $contador = 0;

        foreach ($this->array as $filas) {
            $contador++;
            ?>

            <tr class="ver_linea1">
            <?php
            foreach ($filas as $columnasValor) {
                ?>


                    <td> <?php echo $columnasValor; ?></td>





                <?php
            }
            ?>

            </tr>

            <?php
        }// fin del for principal
        ?>


        <?php
        unset($columnasValor); // se elimina la ref al ultimo elemento
        /* http://php.net/manual/es/control-structures.foreach.php */
    }

 
    
      public function crearArrayConLink($mysqli_result, $ultimaColumna, $id, $turno, $maquina,$nombreFuncion) {
        $array = array();

        for ($count = 0; $fila = $mysqli_result->fetch_row(); $count++) {

            for ($columnas = 0; $columnas <= $ultimaColumna; $columnas++) {

                if ($columnas == $ultimaColumna) {
                    $array[$count][$columnas] = '<a href="#"  onclick="'.$nombreFuncion.'(\'' . $fila[$id] . '\')" >' . $fila[$ultimaColumna] . '</a>';
                    break 1;
                }

                $array[$count][$columnas] = $fila[$columnas];
            }
        }

        $this->array = $array;
    }

/**
 * crea una matriz que es impresa en  la vista de produccion
 */
     public function crearArrayConLinkproduccion(
             $mysqli_result,
             $ultimaColumna, 
             $ordenProduccion,
             $consecutivoPesaje,
             $idMaterial,
             $idMaquina,
             $idTurno ,
             $nombreFuncion) {
         
         
         
         
     
         
         
        $array = array();

        for ($count = 0; $fila = $mysqli_result->fetch_row(); $count++) {

            for ($columna = 0; $columna <= $ultimaColumna; $columna++) {

                if ($columna == $ultimaColumna) {
                    $array[$count][$columna] = '<a href="#"  onclick="'.$nombreFuncion.
                            '(\'' . $fila[$ordenProduccion] . '\' '
                            . ' , \'' .  $fila[$consecutivoPesaje]. '\' '
                            . ',\'' . $fila[$idMaterial] . '\' '
                            . ', \''. $fila[$idMaquina].'\', '
                            . '\''.$fila[$idTurno].'\')" >' . $fila[$ultimaColumna] . '</a>';
                    break 1;
                }

                $array[$count][$columna] = $fila[$columna];
            }
        }

        $this->array = $array;
    }



}
?>
    