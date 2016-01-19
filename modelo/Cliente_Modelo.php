<?php




if (!isset($_SESSION)) {
    session_start();
}


require_once'Database.php';
require_once 'raiz_directorio_principal.php';

/**
 * esta clase  tiene el objetivo de
 * manejar todo lo relacionado con un cliente
 * en la aplicacion
 * registro
 * actualizacion
 * la eliminacion no se contempla
 * validando todos los datos recibidos
 * para  mantener  la integridad en todas las transacciones
 *  en caso de presentarse algun error en alguna peticion con respecto
 * a registro o actualizacion de datos de un cliente la clase mostrara
 * un mensaje al uusario del error, si las transacciones son exitosas
 * se muestran los datos registrados o de actualizacion en un formulario de
 * vizualizacion.
 * 
 *  
 */
class Cliente extends Database {

    private $nit; // 
    private $rs; // 
    private $tl; // 
    private $fax; //
    private $cel; //
    private $contacto; //
    private $email; //
    private $pais; ///
    private $departamento; //
    private $ciudad; //
    private $barrio; //
    private $domicilio; //
    private $consulta; // 
    public $cuentaErrorTransaccion;
   

    /**
     * el constructor esta encargado de
     * realizar la conexion a la bd 
     * a travez de la clase  heredada Database
     */
    function __construct() {
        parent::__construct($_SESSION['k_userName'], $_SESSION['k_userPass']);
    }

    /**
     * libera la memoria 
     * despues de destruir el objecto Cliente
     * cerrando toda conexion con la BD 
     */
    function __destruct() {
        parent::__destruct();
    }

    /**
     * esta funcion comprueba que los datos proveniente
     * del cliente cumplan con los  formatos establecidos para cada dato
     * @param type $nit
     * @param type $rs
     * @param type $tl
     * @param type $cel
     * @param type $fax
     * @param type $contacto
     * @param type $email
     * @param type $pais
     * @param type $depa
     * @param type $ciudad
     * @param type $barrio
     * @param type $domicilio 
     * @return void No value is returned.
     */
    public function cliente($nit, $rs, $tl, $cel, $fax, $contacto, $email, $pais, $depa, $ciudad, $barrio, $domicilio) {



        if ($this->getObjetoExrg()->functionNitCedula($nit)) {

            if ($this->GetObjetoExrg()->functionExpRS($rs)) {
                if ($this->GetObjetoExrg()->functionExpTel($tl)) {
                    if ($this->GetObjetoExrg()->functionExpCel($cel)) {
                        if ($this->GetObjetoExrg()->functionExpTel($fax)) {
                            if ($this->GetObjetoExrg()->functionExpContacto($contacto)) {

                                if ($this->GetObjetoExrg()->functionExpEmail($email)) {

                                    if ($this->GetObjetoExrg()->functionExpContacto($pais)) {

                                        if ($this->GetObjetoExrg()->functionExpContacto($depa)) {
                                            if ($this->GetObjetoExrg()->functionExpContacto($ciudad)) {

                                                if ($this->GetObjetoExrg()->functionExpRS($barrio)) {
                                                    if ($this->GetObjetoExrg()->functionExpRS($domicilio)) {



                                                        $this->establecerValores($nit, $rs, $tl, $cel, $fax, $contacto, $email, $pais, $depa, $ciudad, $barrio, $domicilio);
                                                    } else {
                                                        echo('<script>alert("Escriba una direccion  de domicilio valida valido ")</script>');
                                                       raiz();
                                                    }
                                                } else {
                                                    echo('<script>alert("Escriba un nombre de barrio valido ")</script>');
                                                   raiz();
                                                }
                                            } else {
                                                echo('<script>alert("Escriba un nombre de ciudad valido ")</script>');
                                               raiz();
                                            }
                                        } else {
                                            echo('<script>alert("Escriba un nombre de departamento valido ")</script>');
                                           raiz();
                                        }
                                    } else {
                                        echo('<script>alert("Escriba un nombre de pais valido ")</script>');
                                       raiz();
                                    }
                                } else {
                                    echo('<script>alert("Escriba un email valido o con el siguiente formato ej:\n nombre@servidor.com\n o que contenga el minimo de caracteres\nej: a@a.co ")</script>');
                                   raiz();
                                }
                            } else {
                                echo('<script>alert(" Escriba un nombre valido para el campo contacto")</script>');
                               raiz();
                            }
                        } else {
                            echo('<script>alert("FAX INVALIDO \npor favor ingrese un telefono fax valido\nej: 6123456\n que contenga 7 digitiso y que no comienze por cero")</script>');
                           raiz();
                        }
                    } else {
                        echo('<script>alert(" TELEFONO MOVIL INVALIDO \npor favor ingrese un telefono valido\nde 10 digitos  y con el siguiete formato ej: 300-3341608")</script>');
                       raiz();
                    }
                } else {
                    echo('<script>alert(" TELEFONO INVALIDO \npor favor ingrese un telefono valido\nej: 6123456\n que contenga 7 digitiso y que no comienze por cero")</script>');
                   raiz();
                }
            } else {
                echo('<script>alert(" RAZON SOCIAL ERRADA \npor favor ingrese un nombre valido")</script>');
               raiz();
            }
        } else {
            echo('<script>alert("NIT ERRADO \npor favor ingrese un formato de nit como el de este ejemplo\n800.800.800-X\n donde X es un digito")</script>');
            
            
           raiz();
        }
    }

    /**
     * Despues de comprobar los formatos se procede 
     * a establecer los valores
     * en memoria para guardarlos en la bd, dentro de esta funcion
     * se esterelizan los datos para evitar injeccion sql
     * @param type $nit
     * @param type $rs
     * @param type $tl
     * @param type $cel
     * @param type $fax
     * @param type $contacto
     * @param type $email
     * @param type $pais
     * @param type $depa
     * @param type $ciudad
     * @param type $barrio
     * @param type $domicilio 
     */
    private function establecerValores($nit, $rs, $tl, $cel, $fax, $contacto, $email, $pais, $depa, $ciudad, $barrio, $domicilio) {


        /**
         * filtrado de codigos html y sqlInjection tal como " '' or 1=1 :)
         * este filtrado evita ataques de redireccionamiento
         * tales como <script> href="http://www.direccionAtacante.com" </script> 
         */
        $this->nit = $this->desinfeccionDeVariables($nit);
        $this->rs = $this->desinfeccionDeVariables($rs);
        $this->tl = $this->desinfeccionDeVariables($tl);
        $this->cel = $this->desinfeccionDeVariables($cel);
        $this->fax = $this->desinfeccionDeVariables($fax);
        $this->contacto = $this->desinfeccionDeVariables($contacto);
        $this->email = $this->desinfeccionDeVariables($email);
        $this->pais = $this->desinfeccionDeVariables($pais);
        $this->departamento = $this->desinfeccionDeVariables($depa);
        $this->ciudad = $this->desinfeccionDeVariables($ciudad);
        $this->barrio = $this->desinfeccionDeVariables($barrio);
        $this->domicilio = $this->desinfeccionDeVariables($domicilio);
    }

    /** no es necesario filtrar los datos dado que previamente 
     * son filtrados
     * la funcion se encarga de mostrar
     * el cliente ingresado por el formulario registro de cliente
     * muestra los datos del cliente y junto con mostrar datos2 muestra
     * los datos de direccion de cliente
     * @return mixed <b>FALSE</b> on failure. For successful SELECT, SHOW, DESCRIBE or
     * EXPLAIN queries <b>mysqli_query</b> will return
     * a <b>mysqli_result</b> object. For other successful queries <b>mysqli_query</b> will
     * return <b>TRUE</b>.
     */
    public function mostrarDatos() {
        return $this->query("CALL Cliente_mostrar_datos_cliente('$this->nit','$this->id')");
        
        
    }
    
    
    
    public function mostrarDatosClienteNo($no) {
        return $this->query("CALL BuscarDAtoCliente('$no')");
        
    }

    /**
     * no es necesario filtrar los datos dado que previamente son filtrados
     * esta funcion muestra  crea una consulta MysQl para mostrar los 
     * datos  de  un cliente registrado
     * el cliente especifico ingresado
     * 
     * @return mixed <b>FALSE</b> on failure. For successful SELECT, SHOW, DESCRIBE or
     * EXPLAIN queries <b>mysqli_query</b> will return
     * a <b>mysqli_result</b> object. For other successful queries <b>mysqli_query</b> will
     * return <b>TRUE</b>.
     */
    public function mostrarDatos2() {
       //return $this->query("CALL Cliente_mostrar_direccion_cliente('$this->nit')");
        return $this->query("CALL Cliente_mostrar_direccion_cliente('$this->nit','$this->id')");
        
    }
    
    
    public function mostrarDatosDireccionCliente($no) {
        return $this->query("CALL BuscarDatosDireccionCliente('$no')");
        
    }

    /**
     * esta consulta no se filtran los valores 
     * dado que no es necesario
     * esta funcion comprueba si ya existe un cliente
     * registrado en la bd con los datos que ingresa
     * el usuario
     * @return mixed <b>FALSE</b> on failure. For successful SELECT, SHOW, DESCRIBE or
     * EXPLAIN queries <b>mysqli_query</b> will return
     * a <b>mysqli_result</b> object. For other successful queries <b>mysqli_query</b> will
     * return <b>TRUE</b>.
     */
    public function comprobarDatoduplicado() {


        $this->consulta = ("
       SELECT clientes.telefono_cliente.id_cliente,
       clientes.telefono_cliente.telefono,
       clientes.telefono_cliente.celular,
       clientes.telefono_cliente.fax,
       clientes.telefono_cliente.contacto,
       clientes.telefono_cliente.email
       from clientes.telefono_cliente
       WHERE clientes.telefono_cliente.id_cliente='$this->nit'
       and clientes.telefono_cliente.telefono='$this->tl'
       and clientes.telefono_cliente.celular='$this->cel'
       and clientes.telefono_cliente.fax='$this->fax'
       and clientes.telefono_cliente.contacto='$this->contacto'
       and clientes.telefono_cliente.email='$this->email';
               ");

        $consulta = $this->query($this->consulta);


        return $consulta;
    }

    /**
     * esta consulta no se filtran los valores 
     * dado que no es necesario
     * esta funcion comprueba si ya existe un cliente
     * registrado en la bd con los datos que ingresa
     * el usuario
     * @return mixed <b>FALSE</b> on failure. For successful SELECT, SHOW, DESCRIBE or
     * EXPLAIN queries <b>mysqli_query</b> will return
     * a <b>mysqli_result</b> object. For other successful queries <b>mysqli_query</b> will
     * return <b>TRUE</b>.
     */
    public function comprobarDireccionduplicado() {


        $this->consulta = ("
            select clientes.direccion_cliente.id_cliente,
      clientes.direccion_cliente.pais,
    clientes.direccion_cliente.ciudad,
    clientes.direccion_cliente.departamento,
    clientes.direccion_cliente.barrio,
    clientes.direccion_cliente.direccion_domicilio

from clientes.direccion_cliente
where clientes.direccion_cliente.id_cliente='$this->nit'
and clientes.direccion_cliente.ciudad='$this->ciudad'
and clientes.direccion_cliente.departamento='$this->departamento'
and clientes.direccion_cliente.barrio='$this->barrio'
and clientes.direccion_cliente.direccion_domicilio='$this->domicilio';
            
               ");

        $consulta = $this->query($this->consulta);


        return $consulta;
    }

    /**
     * Esta funcion muestra los datos de la direccion
     * de un cliente el $id es codigo de direccion 
     * ingresado por el usuario
     * @param long $id
     * @return mixed <b>FALSE</b> on failure. For successful SELECT, SHOW, DESCRIBE or
     * EXPLAIN queries <b>mysqli_query</b> will return
     * a <b>mysqli_result</b> object. For other successful queries <b>mysqli_query</b> will
     * return <b>TRUE</b>.
     */
    public function mostrarDatosDireccion($id) {

        return $this->query(" CALL Cliente_mostrarDireccion('$this->nit',$id)");

        
    }

    /**
     * muestra la direccion del cliente, pais, departamento, ciudad, barrio
     * direccion domicilio, esta funcion crea una consulta MySql tipo Like
     * por que es posible que no sepa el nombre o nit completo del cliente
     * que se esta consultando
     * @return mixed <b>FALSE</b> on failure. For successful SELECT, SHOW, DESCRIBE or
     * EXPLAIN queries <b>mysqli_query</b> will return
     * a <b>mysqli_result</b> object. For other successful queries <b>mysqli_query</b> will
     * return <b>TRUE</b>.
     */
    public function mostrarDatos3() {
        $consulta = $this->query("CALL Cliente_buscarDatosCliente2('$this->nit','$this->rs','$this->id')");
        $this->comprobarPriviligios($consulta);
        return $consulta;
    }
    
    /**
     * muestra la direccion del cliente, pais, departamento, ciudad, barrio
     * direccion domicilio, esta funcion crea una consulta MySql tipo Like
     * por que es posible que no sepa el nombre o nit completo del cliente
     * que se esta consultando
     * @return mixed <b>FALSE</b> on failure. For successful SELECT, SHOW, DESCRIBE or
     * EXPLAIN queries <b>mysqli_query</b> will return
     * a <b>mysqli_result</b> object. For other successful queries <b>mysqli_query</b> will
     * return <b>TRUE</b>.
     */
    public function mostrarDatos3Paginado($limit) {
        $consulta = $this->query("CALL ClienteBuscarClientes2Paginado('$this->nit','$this->rs','$limit','$this->id')");
        $this->comprobarPriviligios($consulta);
        return $consulta;
    }

    /**
     * muestra la informacion basica del cliente
     * nit, razon social, tel, fax, contacto email
     * Esta funcion  crea una consulta tipo Like%%
     * dado que en una consulta es posible que no se
     * sepa el nommbre o nit completo de un cliente
     * @param type $nit
     * @param type $rs
     * @return mixed <b>FALSE</b> on failure. For successful SELECT, SHOW, DESCRIBE or
    * EXPLAIN queries <b>mysqli_query</b> will return
    * a <b>mysqli_result</b> object. For other successful queries <b>mysqli_query</b> will
    * return <b>TRUE</b>. 
     */
    public function mostrarDatos4() {
        $consulta = $this->query("CALL Cliente_buscarDatosCliente('$this->nit','$this->rs','$this->id')");
        $this->comprobarPriviligios($consulta);
        return $consulta;
    }
    
    
     /**
     * muestra la informacion basica del cliente
     * nit, razon social, tel, fax, contacto email
     * Esta funcion  crea una consulta tipo Like%%
     * dado que en una consulta es posible que no se
     * sepa el nommbre o nit completo de un cliente
     * @param type $nit
     * @param type $rs
     * @return mixed <b>FALSE</b> on failure. For successful SELECT, SHOW, DESCRIBE or
    * EXPLAIN queries <b>mysqli_query</b> will return
    * a <b>mysqli_result</b> object. For other successful queries <b>mysqli_query</b> will
    * return <b>TRUE</b>. 
     */
     public function mostrarDatos4Paginado($limite) {

        $consulta = $this->query("CALL Cliente_buscarDatosClientePaginado('$this->nit','$this->rs','$limite','$this->id')");
        $this->comprobarPriviligios($consulta);
        return $consulta;
    }
    
    
    /**
     * Funcion que consulta cuantos
     * clientes estan registrados en la bd
     * @return type objeto resulset de mysql
     */
    public function  contarClientesRegistrados(){
        
        $consulta = $this->query("CALL Cliente_contarClientesRegistrados('$this->nit','$this->rs','$this->id')");
        $this->comprobarPriviligios($consulta);
        return $consulta;
        
    }

    

    /**
     * funcion interna  que  registra el cliente en la bd
     *   
     */
    public function registrarCliente() {

        /*
         * verificamos que el cliente no exita para poder guardar los datos
         */


        if (($this->CompruebaDuplicado()->num_rows) > 0) {


            echo('<script>alert("El cliente existe, verifique e intente nuevamente ")</script>');
           raiz();

            exit;
        } else {

            /*
             * comienza una transaccion en php con mysqli
             * 
             */
            $this->next_result();
            $this->procesaTransacciones($this->guardarTabla1(), $this->guardarTabla2(), $this->guardarTabla3());
        }//////
    }

    /**
     * Consulta  que verifica la existencia de un nit en la base de datos,
     * puede ser utilizada para determinar si un cliente esta duplicado o no
     * @return mixed <b>FALSE</b> on failure. For successful SELECT, SHOW, DESCRIBE or
    * EXPLAIN queries <b>mysqli_query</b> will return
    * a <b>mysqli_result</b> object. For other successful queries <b>mysqli_query</b> will
    * return <b>TRUE</b>.
     */
    public function CompruebaDuplicado() {


   return $this->query("CALL comprobar_nit_duplicado('$this->nit','$this->id')"); 


        
    }

    /**
     * esta funcion se encarga de generar una consulta Mysql tipo String
     * la cual se utilizara para guardar los datos del cliente
     * @return type  String
     */
    public function guardarTabla2() {

    return ("call Cliente_insertar_datos_contacto ('$this->nit','$this->tl','$this->cel',
        '$this->fax','$this->contacto','$this->email','$this->id')");
        
    }

    /**
     * esta funcion genera una consulta tipo String para ser
     * utilizada en la bd Mysql, para guardar los datos basicos de un cliente
     * @return type 
     */
    public function guardarTabla1() {        
                
       return ("CALL Cliente_insertar_nit_rs ('$this->nit','$this->rs','$this->id')"); 
        
    }

    /**
     * esta funcion se encarga de generar una peticiion Mysql tipo String
     * la cual se  utilizara para guardar los datos de Direccion de un cliente
     * @return type STring
     */
    public function guardarTabla3() {
        return(" call Cliente_insertar_direccion_cliente ('$this->nit','$this->pais','$this->ciudad','$this->departamento','$this->barrio','$this->domicilio','$this->id')");
        
    }

    /**
     * esta funcion crea una peticion MySql UpDate tipo String
     * para ser pasada al servidor de bd y actualizar los datos
     * de u cliente
     * @param type $param
     * @return type 
     */
    public function sentenciaUpdateDatoCliente($param) {





       return ("update  telefono_cliente set telefono_cliente.telefono = '$this->tl',
                                telefono_cliente.celular='$this->cel',
                                telefono_cliente.fax='$this->fax',
                                telefono_cliente.contacto='$this->contacto',
                                telefono_cliente.email='$this->email'
                                where telefono_cliente.id_telefono='$param'
                                and telefono_cliente.id_cliente='$this->nit';");



        
    }

    /**
     * actualiza los datos perteneciente a la direccion de un cliente
     * @param type $param
     * @return type  STring
     */
    public function sentenciaUpdateDireccionCliente($param) {



        /**
         * rocha depurando 
         */
      return ("update  direccion_cliente set direccion_cliente.pais='$this->pais',
                                direccion_cliente.ciudad='$this->ciudad',
                                direccion_cliente.departamento='$this->departamento',
                                direccion_cliente.barrio='$this->barrio',
                                direccion_cliente.direccion_domicilio='$this->domicilio'
                                where direccion_cliente.id_cliente='$this->nit'
                                and direccion_cliente.id_direccion='$param';
");

        
    }

   

    /**
     * Funcion que consulta si una razon social se encuentra registrada en la bd,
     * su resultado se puede utilizar para comprobar una razon social duplicada
     * @param type $rs
     * @return mixed <b>FALSE</b> on failure. For successful SELECT, SHOW, DESCRIBE or
    * EXPLAIN queries <b>mysqli_query</b> will return
    * a <b>mysqli_result</b> object. For other successful queries <b>mysqli_query</b> will
    * return <b>TRUE</b>. 
     */
    public function validarRsDuplicado($rs) {

        return $this->query("CALL Cliente_comprobar_rs_duplicada('$rs','$this->id')");
         
        
    }

    /**
     * Funcion que consulta el nombre de los clientes, pero a traves del nit
     * @param type $rs
     * @return mixed <b>FALSE</b> on failure. For successful SELECT, SHOW, DESCRIBE or
    * EXPLAIN queries <b>mysqli_query</b> will return
    * a <b>mysqli_result</b> object. For other successful queries <b>mysqli_query</b> will
    * return <b>TRUE</b>.
     */
    public function consultarNombreCliente($nit) {

        return $this->query(" CALL Cliente_consultaNombreCliente('$nit')");
        
    }

    /**
     * verifica si una consulta  devuelve  algun resultado
     * @param type $consulta
     * @param type $consulta2 
     */
    function validarCoincidencias($consulta, $consulta2) {
        if ($consulta->num_rows <= 0 || $consulta2->num_rows <= 0) {
            echo('<script>alert("No hubo coincidencia en la consulta ")</script>');
        } else {

            require_once '../vista/MostrarCliente_1.php';
        }
    }

    /**
     * $no representa el numero de registro asignado automaticamente
     * al momento registrar un cliente en la BD y es el parametro de 
     * busqueda, la funcion retornara El objeto de la clase mysqli_result que
     * representa el conjunto de resultados obtenidos a partir de una consulta 
     * en la base de datos.
     * 
     * esta funcion busca la informacion basica del cliente:
     * nit, razon social, tel, fax, contacto, email. 
     *
     * @link http://php.net/manual/es/mysqli.query.php
     * @link http://php.net/manual/es/class.mysqli-result.php
     * @param Integer $no
     * @return mixed <b>FALSE</b> on failure. For successful SELECT, SHOW, DESCRIBE or
    * EXPLAIN queries <b>mysqli_query</b> will return
    * a <b>mysqli_result</b> object. For other successful queries <b>mysqli_query</b> will
    * return <b>TRUE</b>.
     */
    public function mostrarNoRegistro($no) {

        $no = $this->desinfeccionDeVariables($no);


        $this->consulta = ("select telefono_cliente.id_telefono, 
cliente.id_cliente, cliente.razon_social,
telefono_cliente.telefono,
telefono_cliente.celular,telefono_cliente.fax,telefono_cliente.contacto,
telefono_cliente.email from cliente, telefono_cliente
where cliente.id_cliente = telefono_cliente.id_cliente
and telefono_cliente.id_telefono=$no");

        return $this->query($this->consulta);


        
    }
    
    
    /**
     * 
     * Funcion que consulta los datos de direccion de un cliente, pasando
     * como parametro el id=$no  que se le asigno dinamicamente al momento 
     * de registralo.
     * @param Integer $no
     * @return mixed <b>FALSE</b> on failure. For successful SELECT, SHOW, DESCRIBE or
    * EXPLAIN queries <b>mysqli_query</b> will return
    * a <b>mysqli_result</b> object. For other successful queries <b>mysqli_query</b> will
    * return <b>TRUE</b>.
     * 
     */

    public function mostrarNoRegistro2($no) {

        $no = $this->desinfeccionDeVariables($no);


        $this->consulta = ("select direccion_cliente.id_direccion, 
cliente.id_cliente, cliente.razon_social,
direccion_cliente.pais,
direccion_cliente.ciudad,
direccion_cliente.departamento,
direccion_cliente.barrio,
direccion_cliente.direccion_domicilio

from cliente, direccion_cliente

where cliente.id_cliente = direccion_cliente.id_cliente
and direccion_cliente.id_direccion=$no
");

       return $this->query($this->consulta);


        
    }

    /**
     * metodos accesores 
     */
    public function setNit($param) {


        
        /*comprueba formato de nit*/

        if ($this->GetObjetoExrg()->functionNitCedula($param)) {            
            $param = parent::desinfeccionDeVariables($param);

            $this->nit = $param;
        } else {

            return false;
        }
        return true;
    }

    public function setRs($param) {

        $param = parent::desinfeccionDeVariables($param);

        if ($this->GetObjetoExrg()->functionExpRS($param)) {
            $this->rs = $param;
            return true;
        }
        return false;
    }

    public function setTl($param) {


        $param = parent::desinfeccionDeVariables($param);

        if ($this->GetObjetoExrg()->functionExpTel($param)) {
            $this->tl = $param;

            return true;
        }

        return false;
    }

    public function setCel($param) {
        $param = parent::desinfeccionDeVariables($param);

        if ($this->GetObjetoExrg()->functionExpCel($param)) {
            $this->cel = ($param);

            return true;
        }
        return false;
    }

    public function setFax($param) {
        $param = parent::desinfeccionDeVariables($param);

        if ($this->GetObjetoExrg()->functionExpTel($param)) {
            $this->fax = $param;
            return true;
        }
        return false;
    }

    public function setContacto($param) {
        $param = parent::desinfeccionDeVariables($param);

        if ($this->GetObjetoExrg()->functionExpContacto($param)) {
            $this->contacto = $param;

            return true;
        }
        return false;
    }

    public function setEmail($param) {
        $param = parent::desinfeccionDeVariables($param);
        $param = strtolower($param);

        if ($this->GetObjetoExrg()->functionExpEmail($param)) {
            $this->email = $param;
            return true;
        }
        return false;
    }

    public function setPais($param) {
        $param = parent::desinfeccionDeVariables($param);

        if ($this->GetObjetoExrg()->functionExpContacto($param)) {
            $this->pais = $param;
            return true;
        }
        return false;
    }

    public function setDepartamento($param) {
        $param = parent::desinfeccionDeVariables($param);

        if ($this->GetObjetoExrg()->functionExpContacto($param)) {
            $this->departamento = $param;
            return true;
        }
        return false;
    }

    public function setCiudad($param) {
        $param = parent::desinfeccionDeVariables($param);

        if ($this->GetObjetoExrg()->functionExpContacto($param)) {
            $this->ciudad = $param;
            return true;
        }
        return false;
    }

    public function setBarrio($param) {
        $param = parent::desinfeccionDeVariables($param);

        if ($this->GetObjetoExrg()->functionExpRS($param)) {
            $this->barrio = $param;
            return true;
        }
        return false;
    }

    public function setDomicilio($param) {
        $param = parent::desinfeccionDeVariables($param);

        if ($this->GetObjetoExrg()->functionExpRS($param)) {
            $this->domicilio = $param;
            return true;
        }
        return false;
    }

    /**
     * Funcion que establece el codigo de una
     * Direccion para un cliente
     * @param type $param
     * @return boolean 
     */
    public function setCodigoDireccion($param) {

        $param = $this->desinfeccionDeVariables($param);

        /* si tiene espacios en blanco y si no es numero */
        if ($this->GetObjetoExrg()->functionComprubaEspacioEnBlanco($param)) {

            return false;
        }

        if (!$this->GetObjetoExrg()->functionOnlyNumber($param)) {

            return false;
        }

        return true;
    }

    /**
     * metodos accesores get
     */
    public function getNit() {

        return $this->nit;
    }

    public function getRs() {

        return $this->rs;
    }

    public function getTl() {

        return $this->tl;
    }

    public function getCel() {

        return $this->cel;
    }

    public function getFax() {

        return $this->fax;
    }

    public function getContacto() {

        return $this->contacto;
    }

    public function getEmail() {

        return $this->email;
    }

    public function getPais() {

        return $this->pais;
    }

    public function getDepartamento() {

        return $this->departamento;
    }

    public function getCiudad() {

        return $this->ciudad;
    }

    public function getBarrio() {

        return $this->barrio;
    }

    public function getDomicilio() {

        return $this->domicilio;
    }
    
    
    

    /* validacion asincrona */

    /**
     * <p>esta funcion  es la encargada de verificar 
     * si   el parametro pasado  a la funcion
     * esta registrado previamente en la base de datos</p>
     * <p>en este caso  el parametro  representa un nit de un cliente<br>
     * si el nit existe , la funcion notifica al usuario que el  nit 
     * se encuentra registrado y que no es posible registrar un nit duplicado.</p>
     * 
     * @param String $value 
     */
    public function validateUserName($value) {


        $value = $this->desinfeccionDeVariables($value);

        /**
         * comprueba  el formato de un nit 
         */
        if ($this->GetObjetoExrg()->functionExpNit($value)) {
            // realiza la accion
            // comprueba si el nombre de usuario existe en la base de datos
            $query = $this->validarNitDuplicado($value);


            // si el resultado es false es por que no puede realizarce
            // la consulta debido a problemas de privilegios de usuario
            // o que la cadena de consulta esta errada
            if (!$query == false) {

                // si la consulta arroja mas de una fila
                // es por que el nit ya esta registrado
                if ($query->num_rows > 0) {
                    // realiza la accion
                    echo 'Este Nit se encuentra  registrado en la base de datos, no es posible registrar dos clientes con un mismo NIT.';
                }
            } else {
                // la consulta no puede realizarce
                echo ('Error de Consulta: no se puede realizar la peticion a la Base de Datos o usted no cuenta con los privilegios para realizar esta accion');
            }
        } else {

            // no cumple con el formato por ende  no es valido
            echo 'Ingrese un formato de nit XXX.XXX.XXX-X donde X es un digito y no comience por cero(0) EJ: 800.800.800-5"';
        }
    }
    
    
    /**
     * Valida si un nit esta previamente registrado
     * en la BD
     * @global type $nitVP
     * @param type $nit
     * @return type 
     */
    public function validarNitDuplicado($nit) {


        $nit = $this->desinfeccionDeVariables($nit);

        $this->consulta = ('select clientes.cliente.id_cliente from cliente ' .
                'WHERE cliente.id_cliente ="' . $nit . '"');

        return  $this->query($this->consulta);

        

       
    }


    /**
     * funcion que permite verificar la existencia
     * de una Razon Social de un cliente
     * y comunicarle al usuario que intenta 
     * registrar un nombre  previamente registrado(duplicado)
     * @param String $value
     * 
     */
    public function validateRs($value) {


        /**
         * comprueba  el formato de una Razon Social
         */
        if ($this->GetObjetoExrg()->functionExpRS($value)) {

            $value = $this->desinfeccionDeVariables($value);


            if (!$value == null) {

                // comprueba si el nombre del cliente existe en la base de datos
                $query = $this->validarRsDuplicado($value);

                if (!$query == null) {
                    // si la consulta arroja mas de una fila
                    // es por que el nit ya esta registrado
                    if ($query->num_rows > 0) {
                        echo 'Esta razon social se encuentra registrara en la base de datos
                no es posible registrar dos clientes con el mismo nombre';
                    }
                } else {
                    echo ('Error de Consulta: no se puede realizar la peticion a la Base de Datos o usted no cuenta con los privilegios para realizar esta accion');
                }
            } else {
                return 0;
            }
        } else {
            echo((' RAZON SOCIAL ERRADA por favor ingrese un nombre valido'));
        }
    }

}

//fin de la clase Cliente_Modelo
/* @session_start();
  $_SESSION['k_userName'] = 'amd';
  $_SESSION['k_userPass'] = '12345678';
  $p = new Cliente();

 //echo ''. round(memory_get_usage()/1048576, 2);

//echo microtime();
//// 36640
//
//$p->cliente('800.800.800-5', "", "", $cel, $fax, $contacto, $email, $pais, $depa, $ciudad, $barrio, $domicilio)
//
$p->setNit('800.800.800-5');

$p->setRs('cosas');
$p->setIdEmpresa('20');

echo $p->mostrarDatos2();
exit();

$p->guardarTabla1();
$p->setTl('6534530');
$p->setCel('301-4647868');
$p->setFax('6534530');
$p->setContacto('Diego Nuñez');
$p->setEmail('dnunez@hotmail.com');


$p->setPais('colombia');
//echo $p->getPais();
$p->setDepartamento('bolivar');
$p->setCiudad('cartagena');
$p->setBarrio('13 de junio');
$p->setDomicilio('call segunda');

echo $p->guardarTabla3();
//
//$query1 = ($p->CompruebaDuplicado());
//$p->next_result();
//$query = $p->validarRsDuplicado($p->getRs());
//$p->next_result();
//
//
//
//if (!($query1 == false)){
//    
//    echo "entro";
//
//                    if (($query1->num_rows) <= 0) {
//                       
//                        echo "<br> no hay duplicados";
//
//                        if(!($query == false)) {
//                             echo "<br> con permisos";
//                             $nit= $p->getNit();
//                             $rs= $p->getRs();
//                             
//                           //  $p->query("CALL Cliente_insertar_nit_rs ('$nit','$rs')");
//                             $p->registrarCliente();
//                           //  $p->query($p->guardarTabla1());
//                             
//                             
//             echo ("<script>alert (\"Fallo CaLL : ($p->errno) $p->error \") </script>");
//            echo ("<script>alert (\"El usuario no cuenta  con los privilegios para realizar esta accion, consulte con el administrador \") </script>");
//                             //echo $p->guardarTabla1();
//                        }
//                    }
//}
  * 
  */
?>


