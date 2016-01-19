
<?php


/**
 * 
 * Esta clase tiene la responsabilidad 
 * de  validar todos los formatos  que 
 * reciben los objetos en el servidor
 * lo anterior utulizando la tecnica de expresiones regulares
 * para validar  que los datos  recibidos  por los objetos del 
 * servidor corresponden con los formatos validos  dentro de 
 * la logica de negocio
 * 
 */
class ExReg {

    /**
     * nombreProducto se utiliza para validar
     * el nombre y ref de los productos a registrar en la empresa
     * los producto se registran  y quedan guardado en un formato
     * que se llama ficha tecnica
     * @var  String
     */
    public static $nombreProducto = '/[a-zA-Z0-9\xF1\xD1\_\-\.\/\+\(\)\s\#\<\>\=\%]+$/';
    public static $expRs = '/[a-zA-Z0-9\xF1\xD1\ñ\Ñ\_\-\.\s\#\&\(\)]+$/';
    public static $expNit = '/^[1-9]{1}\d{2}\.\d{3}\.\d{3}\-\d{1}$/';
    public static $expFecha = '/^[1-9]{1}\d{3}\-\d{2}\-\d{2}$/';
    public static $expFechaString = '/^[a-zA-Z]+\s\d/';
    public static $expNomUsu = '/[a-zA-Z0-9\xF1\xD1\ñ\Ñ\_\-\.\s]+$/';
    public static $ReCel = '/^[1-9]\d{2}\-\d{7}$/';
    public static $ReTel = '/^[1-9]{1}\d{6}$/';
    public static $expContacto = '/^[a-zA-Z\xF1\xD1\Ñ\ñ\_\-\.\s]+$/';
    public static $expOnlyAlfabetico='/^[a-zA-Z\xF1\xD1\_\-\.\s]+$/';
    public static $ReEmail = '/^(.{1,}\@.{1,}\..{2,})$/';
    public static $expEspWith = '/\s/';
    public static $expOnlyNum = '/^[0-9]+$/';
    public static $expOnlyNumDecimal = '/^[0-9]+([.][0-9]*)?$/';
    public static $expNumAndLet = '/^[a-zA-Z]{1}\d{1,4}$/';
    public static $expAlfanumerico = '/[[:alnum:]]/';
    public static $NoexpAlfanumerico = '/\W/';
    public static $nitCedula = '/[0-9\.\-]+$/';

   
    /**
     * esta funcion se utiliza para 
     * validar el id de una ficha tecnica
     * su finalidad es comprobar si esta comple con la 
     * expresion regular '/^[a-zA-Z]{1}\d/' , donde debe comenzar
     * por una letra y solo una, seguida de un numero
     * @param type String
     * @return boolean 
     */
    public function functionNumAndLet($param) {

       
        if (preg_match(self::$expNumAndLet, $param)) {
             

            return true;
        } else {
            return false;
        }
    }
    
    
    public function functionNitCedula($param) {

       
        if (preg_match(self::$nitCedula, $param)) {
             

            return true;
        } else {
            return false;
        }
    }
    
    
    
    /**
     * La funcion solo debe validar cadnas,
     * si por algun motivo la cadena contiene 
     * un valor numerico se concidera error
     * @param type $param
     * @return boolean
     */
    public function functionOnlyLetter($param) {

        if (preg_match(self::$expOnlyAlfabetico, $param)) {
            
            return true;
        } else {
            return false;
        }
    }

    /**
     *
     * @param type $param
     * funcion que comprueba si concuerda con la
     * expresion regular $expRs 
     */
    public function functionExpNit($param) {

        if (preg_match(self::$expNit, $param)) {

            return true;
        } else {
            return false;
        }
    }

    /**
     *Funcion que verifica si  se recibe un 
     * valor numerico
     * @param type $param
     * @return boolean 
     */
    public function functionOnlyNumber($param) {

        if (preg_match(self::$expOnlyNumDecimal, $param)) {

            return true;
        } else {
            return false;
        }
    }
    
    
    public function functionOnlyNumberCodigoResina($param) {

        if (preg_match(self::$expOnlyNum, $param)) {

            return true;
        } else {
            return false;
        }
    }
    
    /**
     *Funcion que verifica si  se recibe un 
     * 
     * 
     * 
     * valor numerico
     * @param type $param
     * @return boolean 
     */
    public function functionOnlyNumberDecimal($param) {

        if (preg_match(self::$expOnlyNumDecimal, $param)) {

            return true;
        } else {
            return false;
        }
    }

    /**
     *funcion que comprueba si una cadena contiene 
     * espacios en blanco
     * @param type $param
     * @return boolean 
     */
    public function functionComprubaEspacioEnBlanco($param) {

        if (preg_match(self::$expEspWith, $param)) {

            return true;
        } else {
            return false;
        }
    }

    /**
     *Esta funcion verifica que  una cadena
     * cumpla con el formato de un nombre
     * para  un articulo
     * @param type $param
     * @return boolean 
     */
    public function functionExNRP($param) {

        if ($this->compruebaEspacioEnBlanco($param)) {
            return false;
        } else {


            if (preg_match(self::$nombreProducto, $param)) {

                return true;
            } else {
                return false;
            }
        }
    }

    public function compruebaEspacioEnBlanco($param) {

        if (trim($param) == "") {
            return true;
        } else {
            false;
        }
    }

    /**
     *Funcion que comprueba que la  cadena
     * recibe la funciones cumple con el formato
     * para  registrar una Razon social
     * @param type $param
     * @return boolean 
     */
    public function functionExpRS($param) {

        if ($this->compruebaEspacioEnBlanco($param)) {
            return false;
        } else {

            if (preg_match(self::$expRs, $param)) {

                return true;
            } else {
                return false;
            }
        }
    }

    /**
     *Funcion que comprueba el formato 
     * de un  numero de telefono, que cumpla con el formato
     * para el territorio colombiano
     * @param type $param
     * @return boolean 
     */
    public function functionExpTel($param) {

        if (preg_match(self::$ReTel, $param)) {

            return true;
        } else {
            return false;
        }
    }

    /**
     *Funcion que comprueba el formato de un numero
     * de de telefono celular, para el territorio 
     * Colombiano
     * @param type $param
     * @return boolean 
     */
    public function functionExpCel($param) {

        if (preg_match(self::$ReCel, $param)) {

            return true;
        } else {
            return false;
        }
    }

    /**
     *Funcion que comprueba el formato de una cadena
     * para que concuerde con el nombre de un contacto
     * @param type $param
     * @return boolean 
     */
    public function functionExpContacto($param) {

        if ($this->compruebaEspacioEnBlanco($param)) {
            return false;
        } else {

            if (preg_match(self::$expContacto, $param)) {

                return true;
            } else {
                return false;
            }
        }
    }
    
    public function letrasYnumeros($param){

        if ($this->compruebaEspacioEnBlanco($param)) {
            return false;
        } else {

            if (preg_match(self::$expNomUsu, $param)) {

                return true;
            } else {
                return false;
            }
        }
    }

   
    /**
     *Funcion que comprueba el formta de un mail
     * @param type $param
     * @return boolean 
     */
    public function functionExpEmail($param) {

        if (preg_match(self::$ReEmail, $param)) {

            return true;
        } else {
            return false;
        }
    }

    /**
     *Funcion que comprueba
     * el formato de  fecha  asignado 
     * para la aplicacion
     * @param type $param
     * @return boolean 
     */
    public function functionExpFecha($param) {

        if (preg_match(self::$expFecha, $param) ||
                preg_match(self::$expFechaString, $param)) {

            return true;
        } else {

            return false;
        }
    }

    /**
    *Funcion que veririca si la cadena recibida es
     * alfanumerica
    * 
    * @param type $param
    * @return boolean 
    */
    public function funtionEXpAlfanumerico($param) {

        if (preg_match(self::$expAlfanumerico, $param)) {




            return true;
        } else {

            return false;
        }
    }
    
   /**
    *Esta funcion no reconoce las cadenas vacias como no alfanumericas
    * 
    * @param type $param
    * @return boolean 
    */
    public function funtionNoAlfanumerico($param) {

        if (preg_match(self::$NoexpAlfanumerico, $param)) {

            return true;
        } else {

            return false;
        }
    }
    
    
    public function funtionExpNomUs($param) {

        if (preg_match(self::$expNomUsu, $param)) {

            return true;
        } else {

            return false;
        }
    }
    
    static public function quitar_todos_blancos($cadena) {

        static $patter = '/\s\s+/';

        return preg_replace($patter, '', $cadena);
    }
    
    

}// fin de la clase






?>
