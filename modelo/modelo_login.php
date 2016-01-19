<?php


if (!isset($_SESSION)) {
    session_start();
}


require_once 'ExReg.php';
require_once 'raiz_directorio_principal.php';

function mi_autocargador($clase) {
    include  $clase . '.php';
}

spl_autoload_register('mi_autocargador');




/**
 *Esta clase es la encargada de validar
 * el inicio de sesion de los usuarios 
 */
class Validar extends Database {

    private $nombre; // variables que contendrarn un string
    private $pass; // variables que contendrarn un string
    private $row; // variable que contendra un array asociativo
    private $empresa;
    private $ExReg;// variable que almacenara la referencia de la clase expresiones regulares
   private $query; // variable que contendra un array asociativo
    
    
   
    

    /**
     *
     * @param type $param1 nombre
     * @param type $param2 clave
     * 
     * contructor que inicializa todas las variables, en un estado consistente
     * para evitar  futuros errores de asignacion
     */

    function __construct($param1, $param2,$empresa) {
        
        
        /*se crea una instancia  de la clase ExReg  que valida las cadenas a 
         * traves de expresiones regualres
         */
        $this->ExReg = new ExReg();
              
        if ( $this->ExReg->funtionExpNomUs($param1) && ($this->ExReg->funtionExpNomUs( $param2)) && ($this->ExReg->funtionExpNomUs( $empresa))) {
            
            
            /*  filtra los datos enviados por el susuario*/
            $this->nombre =((htmlentities($param1, ENT_QUOTES)));
            $this->pass    = ((htmlentities($param2, ENT_QUOTES)));
            $this->empresa    = ((htmlentities($empresa, ENT_QUOTES)));
            
            

            /*llama al constructor de la clase Heredada Database*/    
            parent::__construct($this->nombre, $this->pass);
            
            
            /*filtra los datos de injeccion sql*/
            $this->nombre = parent::real_escape_string($this->nombre);
            $this->pass = parent::real_escape_string($this->pass);
            $this->empresa = parent::real_escape_string($this->empresa);
            $this->empresa=$this->loginEmpresa($this->empresa); 
            $this->next_result();
            
            
            
            /*declara las variables como array*/
            $this->query = array();
            $this->row = array();
        } else {

            echo("<script>alert('Usuario o Contrase\u00f1a Incorrecta')</script>");
            unset($_SESSION['id_control']);
               raiz();
             exit();
        }
    }
    
    
     
    
    
    public function buscarUsuario(){
        
        return  $this->query(" CALL Usuario_buscarUsuario('$this->nombre','$this->pass','$this->empresa')");
        
        
       
        
    }
    
    
    
    
    
   /**
    * 
    * @param String $param
    * @return mixed <b>FALSE</b> on failure. For successful SELECT, SHOW, DESCRIBE or
    * EXPLAIN queries <b>mysqli_query</b> will return
    * a <b>mysqli_result</b> object. For other successful queries <b>mysqli_query</b> will
    * return <b>TRUE</b>.
    * Funcion que es utilizada para consultar el estado de un usuario
    * <b>Activado</b> puede ingresar a la aplicacion<br>
    * <b>No Activado</b> no puede ingresar a la aplicacion
    */
    public function consultaEstadoUsuario($param) { 
        return $this->query("CALL Usuario_consultaEstadoUsuario('$param','$this->empresa')"); 
        
       
        
    }
    
    
    
    
    public function loginEmpresa($empresa) {
       
        /**
         *verifica la existencia del usuario en la base de datos 
         */
        
        
        
        $consulta =$this->query("CALL loging_empresa('$empresa')");   
        
        
        
           
        
        
        $this->row = $consulta->fetch_array(MYSQLI_ASSOC);
        
         $_SESSION['k_empresa'] = $this->row['id_empresa'];
         
         
        
       
        
        
       
        /***
        * si hambas  consultas arrojan  resultado
         * se asigna el nombre de usuario a una variable
         * de session para mostrar el nombre durante toda
         * la session del usuario y para comparar privilegios
         * dentro de la aplicacion  
        */
        if ($this->row) {
            $_SESSION['k_empresa'] = $this->row['id_empresa'];
            
            
            
            

        } else {

            echo("<script>alert('Usuario o Contrase\u00f1a Incorrecta')</script>");
            unset($_SESSION['id_control']);
             raiz();
            exit();
        }
        
        return $_SESSION['k_empresa'];
    }



    /**
     * funcion que permite comprobar si 
     * el usuario esta registrado en la bd y posee
     * algun privilegio que le permita manipular el 
     * contenido.
     * sino no puede iniciar session
     */
    public function getUser() {
       
        /**
         *verifica la existencia del usuario en la base de datos 
         */
        
        $this->query[0] =$this->buscarUsuario();
        $this->row = $this->query[0]->fetch_array(MYSQLI_ASSOC);
        
        /***
        * si hambas  consultas arrojan  resultado
         * se asigna el nombre de usuario a una variable
         * de session para mostrar el nombre durante toda
         * la session del usuario y para comparar privilegios
         * dentro de la aplicacion  
        */
        if ($this->row) {
            $_SESSION['k_userName'] = $this->row['usuario'];
            $_SESSION['k_userPass'] = $this->pass;
            
           
            $this->next_result();
             raiz();
            

        } else {

            echo("<script>alert('Usuario o Contrase\u00f1a Incorrecta')</script>");
            unset($_SESSION['id_control']);
             raiz();
        }
    }

}






?>
